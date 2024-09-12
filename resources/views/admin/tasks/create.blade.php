<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <form method="POST" action="{{ route('admin.tasks.store') }}">
                    @csrf
                    <div class="flex flex-col gap-y-3">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="text" name="title" class="w-full p-3 border rounded" placeholder="Task Title" value="{{ old('title') }}">
                        <textarea name="description" class="w-full p-3 border rounded" placeholder="Task Description">{{ old('description') }}</textarea>
                        <button type="submit" class="font-bold py-4 px-6 bg-teal-700 text-white rounded-full">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
