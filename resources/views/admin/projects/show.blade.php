<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="px-5 py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                <div class="item-card flex flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-teal-950 text-xl font-bold">{{ $project->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $project->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('front.details', $project->slug) }}" class="font-bold py-4 px-6 bg-orange-500 text-white rounded-full">
                            Preview
                        </a>
                        <a href="{{ route('admin.projects.tools', $project) }}" class="font-bold py-4 px-6 bg-teal-700 text-white rounded-full">
                            Add Tools
                        </a>
                    </div>
                </div>

                <hr class="my-5">

                <h3 class="text-teal-950 text-xl font-bold">Tasks</h3>

                <!-- Button to redirect to task creation page -->
                <a href="{{ route('admin.tasks.create', ['project' => $project->id]) }}" class="font-bold py-4 px-6 bg-teal-700 text-white rounded-full">Add Task</a>


                <!-- Task list -->
                @foreach($project->tasks as $task)
                <div class="flex flex-row justify-between items-center py-2">
                    <div>
                        <h3 class="text-teal-950 text-lg font-bold">{{ $task->title }}</h3>
                        <p class="text-slate-500">{{ $task->description }}</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <!-- Button to redirect to task edit page -->
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="font-bold py-4 px-6 bg-orange-500 text-white rounded-full">Edit</a>
                        <form method="POST" action="{{ route('admin.tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-500 text-white rounded-full">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
