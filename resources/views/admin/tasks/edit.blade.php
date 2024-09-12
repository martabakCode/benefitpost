<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">

                <!-- Display Validation Errors -->
                @if($errors->any())
                    <div class="px-5 py-3 w-full rounded-3xl bg-red-500 text-white mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.tasks.update', $task) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-y-3">
                        <input type="text" name="title" class="w-full p-3 border rounded" placeholder="Task Title" value="{{ old('title', $task->title) }}">
                        <textarea name="description" class="w-full p-3 border rounded" placeholder="Task Description">{{ old('description', $task->description) }}</textarea>
                        <button type="submit" class="font-bold py-4 px-6 bg-teal-700 text-white rounded-full">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
