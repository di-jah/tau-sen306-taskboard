<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('task_done'))
                <div class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded font-semibold">
                    🎉 "{{ session('task_done') }}" was marked as Done!
                </div>
            @endif

            <div class="bg-white dark:bg-[#3d2740] overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $project->description }}</p>
                <a href="{{ route('projects.index') }}" class="text-sm text-pink-600 hover:underline">← Back to Projects</a>
            </div>

            <div class="bg-white dark:bg-[#3d2740] overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tasks</h3>
                    <a href="{{ route('tasks.create', $project) }}" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 text-sm">
                        + New Task
                    </a>
                </div>

                <div class="flex gap-2 mb-4">
                    <a href="{{ route('projects.show', $project) }}"
                        @class(['px-3 py-1 text-sm rounded', 'bg-pink-600 text-white' => !$status, 'bg-gray-200 text-gray-700' => $status])>
                        All
                    </a>
                    <a href="{{ route('projects.show', $project) }}?status=To Do"
                        @class(['px-3 py-1 text-sm rounded', 'bg-pink-600 text-white' => $status === 'To Do', 'bg-gray-200 text-gray-700' => $status !== 'To Do'])>
                        To Do
                    </a>
                    <a href="{{ route('projects.show', $project) }}?status=In Progress"
                        @class(['px-3 py-1 text-sm rounded', 'bg-pink-600 text-white' => $status === 'In Progress', 'bg-gray-200 text-gray-700' => $status !== 'In Progress'])>
                        In Progress
                    </a>
                    <a href="{{ route('projects.show', $project) }}?status=Done"
                        @class(['px-3 py-1 text-sm rounded', 'bg-pink-600 text-white' => $status === 'Done', 'bg-gray-200 text-gray-700' => $status !== 'Done'])>
                        Done
                    </a>
                </div>

                @forelse ($tasks as $task)
                    <div class="flex justify-between items-center border-b py-4">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                            <p class="text-sm text-gray-500">{{ $task->description }}</p>
                            <span @class([
                                'inline-block mt-1 px-2 py-1 text-xs rounded',
                                'bg-gray-200 text-gray-700' => $task->status === 'To Do',
                                'bg-yellow-200 text-yellow-800' => $task->status === 'In Progress',
                                'bg-green-200 text-green-800' => $task->status === 'Done',
                            ])>
                                {{ $task->status }}
                            </span>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-sm text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No tasks match this filter.</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>