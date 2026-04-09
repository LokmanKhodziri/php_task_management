<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">{{ $project->name }}</h2>
            <a href="{{ route('projects.tasks.create', $project) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">+ New Task</a>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        {{-- Status filter --}}
        <div class="flex gap-2 mb-4 flex-wrap">
            <a href="{{ route('projects.show', $project) }}"
               class="px-3 py-1 rounded text-sm {{ !request('status') ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">All</a>
            @foreach(\App\Models\Task::STATUSES as $key => $label)
                <a href="{{ route('projects.show', [$project, 'status' => $key]) }}"
                   class="px-3 py-1 rounded text-sm {{ request('status') === $key ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Task table --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Due Date</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($tasks as $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            @if($task->description)
                                <p class="text-gray-400 text-xs mt-0.5">{{ Str::limit($task->description, 60) }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $badge = match($task->status) {
                                    'done' => 'bg-green-100 text-green-700',
                                    'in_progress' => 'bg-yellow-100 text-yellow-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $badge }}">
                                {{ \App\Models\Task::STATUSES[$task->status] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $task->due_date ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline"
                                        onclick="return confirm('Delete this task?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-400">No tasks yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('projects.index') }}" class="text-sm text-gray-500 hover:underline">← Back to projects</a>
        </div>
    </div>
</x-app-layout>
