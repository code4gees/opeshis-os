<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\SysDepartment;
use App\Models\SysFinancialTariff;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show the Institutional Control Plane
     */
    public function index(Request $request)
    {
        $tab = $request->query('subtab', 'users');
        $search = $request->query('q', '');

        $data = [
            'tab' => $tab,
            'search' => $search,
            'sysDepts' => SysDepartment::orderBy('name')->get(),
            'roles' => Role::orderBy('name')->get(),
        ];

        if ($tab === 'users') {
            $query = User::with('department');
            
            if ($search) {
                $query->where('name', 'ILIKE', "%$search%")->orWhere('email', 'ILIKE', "%$search%");
            }

            $data['users'] = $query->orderBy('created_at', 'desc')->paginate(15);

        } elseif ($tab === 'sys_finance') {
            $query = SysFinancialTariff::query();
            if ($search) {
                $query->where('service_name', 'ILIKE', "%$search%")->orWhere('category', 'ILIKE', "%$search%");
            }
            $data['tariffs'] = $query->orderBy('category')->orderBy('service_name')->paginate(15);
        } elseif ($tab === 'permissions') {
            $selectedRole = $request->query('role', 'Doctor');
            $data['selectedRole'] = $selectedRole;
            $data['permissions'] = Permission::orderBy('category')->orderBy('name')->get();
            $data['rolePerms'] = \App\Models\Role::where('name', $selectedRole)
                ->first()
                ->permissions()
                ->pluck('permission_code')
                ->toArray();
        } elseif ($tab === 'forensics') {
            $data['auditLogs'] = AuditLog::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            
            $data['health'] = [
                'db_size' => '1.2 GB',
                'storage_used' => '45%',
                'cpu_load' => '12%',
                'active_sessions' => \App\Models\UserSession::count(),
            ];
        }

        return view('admin', $data);
    }

    /**
     * Handle Admin Actions Protocol
     */
    public function action(
        Request $request,
        \App\Actions\Admin\AddUserAction $addUserAction,
        \App\Actions\Admin\TogglePermissionAction $togglePermissionAction,
        \App\Actions\Admin\TriggerBackupAction $triggerBackupAction
    ) {
        $action = $request->input('action');

        try {
            if ($action === 'add_user') {
                $addUserAction->execute(new \App\DTOs\UserDTO(
                    name: $request->input('name'),
                    email: $request->input('email'),
                    password: $request->input('password'),
                    role: $request->input('role'),
                    sysDeptId: $request->input('sys_dept_id')
                ));
                return redirect()->route('admin.index', ['subtab' => 'users'])->with('success', 'Personnel record established.');
            }

            if ($action === 'toggle_permission') {
                $togglePermissionAction->execute(
                    $request->input('role'),
                    $request->input('permission'),
                    $request->input('enabled') === 'true'
                );
                return response()->json(['success' => true]);
            }

            if ($action === 'trigger_backup') {
                $triggerBackupAction->execute();
                return redirect()->back()->with('success', 'Institutional backup initiated. Verification pending.');
            }
        } catch (\Exception $e) {
            if ($request->ajax()) return response()->json(['success' => false, 'error' => $e->getMessage()]);
            return redirect()->route('admin.index', ['subtab' => $action === 'add_user' ? 'users' : 'forensics'])->with('error', $e->getMessage());
        }

        return redirect()->route('admin.index');
    }

    /**
     * Export Forensics Log (CSV)
     */
    public function exportForensics()
    {
        $logs = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="opeshis_forensics_'.now()->format('YmdHis').'.csv"',
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Timestamp', 'Staff', 'Action', 'Target Entity', 'Details', 'IP Address']);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at, 
                    $log->user->name ?? 'System', 
                    $log->action, 
                    $log->table_name, 
                    $log->details, 
                    $log->ip_address
                ]);
            }
            fclose($file);
        };

        \App\Helpers\Opeshis::logAction('ADMIN_FORENSICS_EXPORT', 'sys_audit_log', null, 'Exported institutional forensic logs.');

        return response()->stream($callback, 200, $headers);
    }
}
