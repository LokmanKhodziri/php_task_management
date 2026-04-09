<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => bcrypt('password'),
        ]);

        $projects = [
            ['name' => 'Website Redesign'],
            ['name' => 'Mobile App MVP'],
            ['name' => 'API Integration'],
        ];

        foreach ($projects as $projectData) {
            $project = $user->projects()->create($projectData);

            $project->tasks()->createMany([
                ['title' => 'Setup project repo', 'status' => 'done', 'due_date' => now()->subDays(5)],
                ['title' => 'Design mockups', 'status' => 'in_progress', 'due_date' => now()->addDays(3), 'description' => 'Figma wireframes for all screens'],
                ['title' => 'Backend API endpoints', 'status' => 'todo', 'due_date' => now()->addDays(7)],
                ['title' => 'Write unit tests', 'status' => 'todo', 'due_date' => null],
            ]);
        }
    }
}
