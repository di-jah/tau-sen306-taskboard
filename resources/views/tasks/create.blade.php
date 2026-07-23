<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            New Task — {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('tasks.store', $project) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" rows="4"
                            class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                            <option value="To Do" {{ old('status') === 'To Do' ? 'selected' : '' }}>To Do</option>
                            <option value="In Progress" {{ old('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ old('status') === 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                            Add Task
                        </button>
                        <a href="{{ route('projects.show', $project) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>