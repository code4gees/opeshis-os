<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\TrainingCourses;
use Illuminate\Support\Facades\Auth;

class CreateTrainingCourseAction
{
    public function execute(array $data): TrainingCourses
    {
        return TrainingCourses::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'mandatory' => ($data['mandatory'] ?? 'no') === 'yes',
            'target_role' => $data['target_role'] ?? null,
            'created_by' => Auth::id(),
        ]);
    }
}
