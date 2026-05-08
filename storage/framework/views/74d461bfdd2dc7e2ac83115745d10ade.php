<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Opeshis OS | <?php echo e($title); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #0f172a; --accent: #4f46e5; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #0f172a; padding: 0; margin: 0; -webkit-print-color-adjust: exact; }
        .page { width: 210mm; min-height: 297mm; padding: 20mm; margin: 40px auto; background: white; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); position: relative; border-radius: 2rem; }
        .header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #f1f5f9; padding-bottom: 25px; margin-bottom: 40px; }
        .brand h1 { margin: 0; font-weight: 800; letter-spacing: -1px; font-size: 28px; color: #0f172a; text-transform: uppercase; }
        .brand p { margin: 0; font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; }
        .meta { text-align: right; font-size: 11px; color: #64748b; line-height: 1.6; font-weight: 600; }
        .meta strong { color: #0f172a; font-weight: 800; }
        .strip { background: #f8fafc; padding: 25px; border-radius: 1.5rem; margin-bottom: 40px; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 30px; border: 1px solid #f1f5f9; }
        .group label { display: block; font-size: 9px; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 1px; }
        .group span { font-weight: 700; font-size: 14px; color: #0f172a; }
        h2 { font-size: 18px; font-weight: 800; text-transform: uppercase; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 25px; color: #1e293b; display: flex; align-items: center; gap: 10px; }
        h2::before { content: ''; display: block; width: 4px; height: 18px; background: var(--accent); border-radius: 2px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th { text-align: left; background: #f8fafc; padding: 12px 15px; font-size: 10px; font-weight: 800; text-transform: uppercase; color: #64748b; border-bottom: 2px solid #f1f5f9; }
        td { padding: 15px; font-size: 13px; border-bottom: 1px solid #f8fafc; vertical-align: top; font-weight: 600; }
        .footer { position: absolute; bottom: 20mm; left: 20mm; right: 20mm; border-top: 1px solid #f1f5f9; padding-top: 20px; font-size: 9px; color: #94a3b8; font-weight: 700; display: flex; justify-content: space-between; text-transform: uppercase; }
        @media print { .no-print { display: none; } body { background: white; } .page { margin: 0; box-shadow: none; width: 100%; border-radius: 0; } }
        .no-print { position: fixed; top: 20px; right: 20px; z-index: 1000; }
        .btn { background: #4f46e5; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 800; font-size: 11px; text-transform: uppercase; cursor: pointer; shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="btn" onclick="window.print()">Print Document</button>
    </div>

    <div class="page">
        <div class="header">
            <div class="brand">
                <h1>OPESHIS OS</h1>
                <p>Institutional Clinical Kernel</p>
            </div>
            <div class="meta">
                <div><strong>REF:</strong> #<?php echo e(strtoupper(substr($type, 0, 3))); ?>-<?php echo e(substr($data->id, 0, 8)); ?></div>
                <div><strong>DATE:</strong> <?php echo e(now()->format('d M Y, H:i')); ?></div>
                <div>Validated by Opeshis Core</div>
            </div>
        </div>

        <div class="strip">
            <div class="group">
                <label>Patient Identity</label>
                <span><?php echo e($data->full_name); ?></span>
            </div>
            <div class="group">
                <label>Medical ID</label>
                <span><?php echo e($data->medical_id); ?></span>
            </div>
            <div class="group">
                <label>Bio Stats</label>
                <span><?php echo e($data->gender); ?> / <?php echo e(\Carbon\Carbon::parse($data->dob)->age); ?> YRS</span>
            </div>
        </div>

        <h2><?php echo e($title); ?></h2>

        <table>
            <thead>
                <tr>
                    <th width="35%">Structural Property</th>
                    <th>Clinical Observation / Data Value</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = (array)$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($key, ['id', 'patient_id', 'full_name', 'medical_id', 'gender', 'dob', 'created_at', 'updated_at']) || empty($value)): ?> <?php continue; ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <tr>
                        <td><span style="text-transform: uppercase; font-size: 9px; color: #94a3b8;"><?php echo e(str_replace('_', ' ', $key)); ?></span></td>
                        <td><?php echo e($value); ?></td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </tbody>
        </table>

        <div class="footer">
            <div>Opeshis OS Document Gateway</div>
            <div>Institutional UUID: <?php echo e(strtoupper(Str::random(12))); ?></div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\opeshis\resources\views\print\layout.blade.php ENDPATH**/ ?>