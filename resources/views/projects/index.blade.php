<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">My Projects</h2>
            <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">+ New Project</a>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @forelse($projects as $project)
            <div class="bg-white rounded-lg shadow mb-3 p-5 flex justify-between items-center">
                <div>
                    <a href="{{ route('projects.show', $project) }}" class="font-semibold text-gray-800 hover:text-blue-600">
                        {{ $project->name }}
                    </a>
                    <p class="text-sm text-gray-500 mt-1">{{ $project->tasks_count }} task(s) · Created {{ $project->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex gap-3 items-center">
                    <a href="{{ route('projects.edit', $project) }}" class="text-sm text-blue-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('projects.destroy', $project) }}">
                        @csrf @method('DELETE')
                        <button class="text-sm text-red-500 hover:underline"
                            onclick="return confirm('Delete this project and all its tasks?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-400">
                No projects yet. <a href="{{ route('projects.create') }}" class="text-blue-600 hover:underline">Create one</a>.
            </div>
        @endforelse
    </div>
</x-app-layout>
