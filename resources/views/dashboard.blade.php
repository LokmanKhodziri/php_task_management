<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Stat cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5 text-center">
                <p class="text-3xl font-bold text-gray-800">{{ $totalProjects }}</p>
                <p class="text-sm text-gray-500 mt-1">Total Projects</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 text-center">
                <p class="text-3xl font-bold text-gray-800">{{ $totalTasks }}</p>
                <p class="text-sm text-gray-500 mt-1">Total Tasks</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 text-center">
                <p class="text-3xl font-bold text-yellow-500">{{ $tasksByStatus['in_progress'] ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-1">In Progress</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 text-center">
                <p class="text-3xl font-bold text-green-500">{{ $tasksByStatus['done'] ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-1">Done</p>
            </div>
        </div>

        {{-- Status breakdown --}}
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h3 class="font-semibold text-gray-700 mb-4">Tasks by Status</h3>
            <div class="flex gap-6">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-gray-400 inline-block"></span>
                    <span class="text-sm text-gray-600">To Do: <strong>{{ $tasksByStatus['todo'] ?? 0 }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-yellow-400 inline-block"></span>
                    <span class="text-sm text-gray-600">In Progress: <strong>{{ $tasksByStatus['in_progress'] ?? 0 }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span>
                    <span class="text-sm text-gray-600">Done: <strong>{{ $tasksByStatus['done'] ?? 0 }}</strong></span>
                </div>
            </div>
        </div>

        <a href="{{ route('projects.index') }}" class="text-blue-600 text-sm hover:underline">→ View all projects</a>
    </div>
</x-app-layout>
