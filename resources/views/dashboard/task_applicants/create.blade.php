<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Applicant Submission') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="container max-w-[1130px] mx-auto my-4 flex flex-col gap-4 mt-[50px]">
                    <form action="{{ route('task_applicants.store') }}" method="POST">
                        @csrf
                        <!-- Input tersembunyi untuk task_id -->
                        <input type="hidden" name="task_id" value="{{ $task_id }}" required>

                        <label for="proof">Bukti pengerjaan</label>
                        <input class="w-full p-3 border rounded" type="text" name="proof" required>

                        <button class="my-4 font-bold py-4 px-6 bg-teal-700 text-white rounded-full" type="submit">Submit</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
