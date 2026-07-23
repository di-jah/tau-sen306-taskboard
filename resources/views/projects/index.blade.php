<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            My Projects
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('projects.create') }}" class="inline-block px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                    + New Project
                </a>
            </div>

            <div class="bg-white dark:bg-[#3d2740] overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @forelse ($projects as $project)
                        <div class="flex justify-between items-center border-b py-4">
                            <div>
                                <a href="{{ route('projects.show', $project) }}" class="text-lg font-semibold text-pink-600 hover:underline">
                                    {{ $project->title }}
                                </a>
                                <p class="text-sm text-gray-500">{{ $project->description }}</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('projects.edit', $project) }}" class="text-sm text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No projects yet. Create your first one!</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>