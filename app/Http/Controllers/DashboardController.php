<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalProjects = $user->projects()->count();
        $totalTasks = Task::whereHas('project', fn ($q) => $q->where('user_id', $user->id))->count();
        $tasksByStatus = Task::whereHas('project', fn ($q) => $q->where('user_id', $user->id))
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('dashboard', compact('totalProjects', 'totalTasks', 'tasksByStatus'));
    }
}
