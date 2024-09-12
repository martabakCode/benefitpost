<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applicant Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="px-5 py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                @if($projectApplicant->project->has_finished)
                    <span class="text-white font-bold bg-green-500 rounded-2xl w-full p-5">
                        Projek telah selesai, Revenue sudah diberikan kepada Freelancer
                    </span>
                @endif

                <div class="item-card flex flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($projectApplicant->project->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-teal-950 text-xl font-bold">{{$projectApplicant->project->name}}</h3>
                            <p class="text-slate-500 text-sm">{{$projectApplicant->project->category->name}}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <h3 class="text-teal-950 text-xl font-bold">Applicants</h3>

                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($projectApplicant->freelancer->avatar)}}" alt="" class="rounded-full object-cover w-[70px] h-[70px]">
                        <div class="flex flex-col">
                            <h3 class="text-teal-950 text-xl font-bold">{{$projectApplicant->freelancer->name}}</h3>
                            <p class="text-slate-500 text-sm">{{$projectApplicant->freelancer->occupation}}</p>
                        </div>
                    </div>

                    @if($projectApplicant->status == 'hired')
                    <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                        hired
                    </span>
                    @elseif($projectApplicant->status == 'waiting')

                    <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                        waiting FOR APPROVAL
                    </span>
                    @elseif($projectApplicant->status == 'rejected')
                    <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-red-500 text-white">
                        rejected
                    </span>
                    @endif

                </div>

                <h3 class="text-teal-950 text-xl font-bold mt-5">Message</h3>
                <p>
                    {{$projectApplicant->message}}
                </p>

                @if($projectApplicant->status == 'hired')
                <hr class="my-5">
                <h3 class="text-teal-950 text-xl font-bold">Setup Meeting with Freelancer</h3>
                <div class="flex flex-row gap-x-4 items-center border border-slate-200 w-fit px-5 py-3 rounded-2xl">
                    <svg width="38" height="38" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.58" d="M24 0H0V24H24V0Z" fill="white"/>
                        <path opacity="0.4" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="#292D32"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.25 9.67976V12.4798C6.25 14.0198 7.50001 15.2598 9.04001 15.2498L12.72 15.2198C13.23 15.2198 13.64 14.7998 13.64 14.2998V11.5298C13.64 9.99977 12.4 8.75977 10.87 8.75977H7.17999C6.65999 8.75977 6.25 9.16976 6.25 9.67976Z" fill="#292D32"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.75 10.0196V13.9996C17.75 14.4296 17.27 14.6896 16.91 14.4496L14.99 13.1696C14.84 13.0696 14.75 12.8996 14.75 12.7196V11.2996C14.75 11.1196 14.84 10.9496 14.99 10.8496L16.91 9.56964C17.27 9.32964 17.75 9.58963 17.75 10.0196Z" fill="#292D32"/>
                        </svg>
                <p class="text-teal-950 text-lg font-bold">{{$projectApplicant->freelancer->email}}</p>

                </div>
                @elseif($projectApplicant->status == 'waiting')
                <form method="POST" action="{{route('admin.project_applicants.update', $projectApplicant->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="mt-2 w-full font-bold py-4 px-6 bg-teal-700 text-white rounded-full">
                        Approve & Hire Now
                    </button>
                </form>
                @endif

                @if($projectApplicant->project->has_started)
                    @if($projectApplicant->status == 'Hired')
                        @if(!$projectApplicant->project->has_finished)
                            <hr class="my-5">
                            <form method="POST" action="{{route('admin.complete_project.store', $projectApplicant->id)}}" enctype="multipart/form-data">
                                @csrf

                                <button type="submit" class="w-full font-bold py-4 px-6 bg-green-500 text-white rounded-full">
                                    Mark as Completed
                                </button>
                            </form>
                        @endif
                    @endif
                @endif

                <hr class="my-5">
                <div class="flex flex-row gap-x-3 items-center">
                    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5991 14.5101L13.0691 13.9801L13.5691 13.4801C13.8591 13.1901 13.8591 12.7101 13.5691 12.4201C13.2791 12.1301 12.7991 12.1301 12.5091 12.4201L12.0091 12.9201L11.4791 12.3901C11.1891 12.1001 10.7091 12.1001 10.4191 12.3901C10.1291 12.6801 10.1291 13.1601 10.4191 13.4501L10.9491 13.9801L10.3991 14.5301C10.1091 14.8201 10.1091 15.3001 10.3991 15.5901C10.5491 15.7401 10.7391 15.8101 10.9291 15.8101C11.1191 15.8101 11.3091 15.7401 11.4591 15.5901L12.0091 15.0401L12.5391 15.5701C12.6891 15.7201 12.8791 15.7901 13.0691 15.7901C13.2591 15.7901 13.4491 15.7201 13.5991 15.5701C13.8891 15.2801 13.8891 14.8101 13.5991 14.5101Z" fill="#292D32"/>
                        <path opacity="0.4" d="M21.8504 11.4099L21.2304 18.1899C21.0204 20.1899 20.2004 22.2299 15.8004 22.2299H8.18039C3.78039 22.2299 2.96039 20.1899 2.76039 18.1999L2.15039 11.6899C2.16039 11.6999 2.17039 11.7099 2.19039 11.7199C2.53039 11.9399 2.86039 12.1599 3.22039 12.3599C3.36039 12.4499 3.51039 12.5299 3.66039 12.6099C4.79039 13.2299 6.00039 13.7199 7.25039 14.0599C7.75039 14.2099 8.26039 14.3199 8.78039 14.4099C8.98039 16.0099 10.3504 17.2499 12.0004 17.2499C13.6704 17.2499 15.0504 15.9799 15.2304 14.3499V14.3399C15.7404 14.2399 16.2504 14.1099 16.7504 13.9599C18.0004 13.5699 19.2104 13.0499 20.3404 12.3899C20.4004 12.3599 20.4504 12.3299 20.4904 12.2999C20.9504 12.0499 21.3904 11.7599 21.8104 11.4599C21.8304 11.4499 21.8404 11.4299 21.8504 11.4099Z" fill="#292D32"/>
                        <path d="M21.0891 6.98002C20.2391 6.04002 18.8291 5.57002 16.7591 5.57002H16.5191V5.53002C16.5191 3.85002 16.5191 1.77002 12.7591 1.77002H11.2391C7.47906 1.77002 7.47906 3.85002 7.47906 5.53002V5.57002H7.23906C5.16906 5.57002 3.74906 6.04002 2.90906 6.98002C1.91906 8.09002 1.94906 9.56002 2.04906 10.57L2.05906 10.64L2.14906 11.69C2.15906 11.7 2.17906 11.71 2.19906 11.72C2.53906 11.94 2.86906 12.16 3.22906 12.36C3.36906 12.45 3.51906 12.53 3.66906 12.61C4.79906 13.23 6.00906 13.72 7.24906 14.06C7.27906 16.65 9.39906 18.75 11.9991 18.75C14.6191 18.75 16.7491 16.62 16.7491 14V13.96C18.0091 13.58 19.2191 13.05 20.3491 12.39C20.4091 12.36 20.4491 12.33 20.4991 12.3C20.9591 12.05 21.3991 11.76 21.8191 11.46C21.8291 11.45 21.8491 11.43 21.8591 11.41L21.8991 11.05L21.9491 10.58C21.9591 10.52 21.9591 10.47 21.9691 10.4C22.0491 9.40002 22.0291 8.02002 21.0891 6.98002ZM8.90906 5.53002C8.90906 3.83002 8.90906 3.19002 11.2391 3.19002H12.7591C15.0891 3.19002 15.0891 3.83002 15.0891 5.53002V5.57002H8.90906V5.53002ZM11.9991 17.25C10.3491 17.25 8.97906 16.01 8.77906 14.41C8.75906 14.28 8.74906 14.14 8.74906 14C8.74906 12.21 10.2091 10.75 11.9991 10.75C13.7891 10.75 15.2491 12.21 15.2491 14C15.2491 14.12 15.2391 14.23 15.2291 14.34V14.35C15.0491 15.98 13.6691 17.25 11.9991 17.25Z" fill="#292D32"/>
                        </svg>

                    <div>
                        <h3 class="text-teal-950 text-xl font-bold">Sorry, Client Rejected You.</h3>
                    <p class="text-slate-500 text-md">
                        Semoga Anda akan beruntung pada kesempatan selanjutnya!
                    </p>
                    </div>
                </div>
                <hr class="my-5">

                <h3 class="text-teal-950 text-xl font-bold">Tasks</h3>

                <!-- Task list -->
                @foreach($project->tasks as $task)
                <div class="flex flex-row justify-between items-center py-2">
                    <div>
                        <h3 class="text-teal-950 text-lg font-bold">{{ $task->title }}</h3>
                        <p class="text-slate-500">{{ $task->description }}</p>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        @php
                            $userHasCompletedSubmission = $task->task_applicants_submit
                                ->where('user_id', Auth::id())
                                ->where('status', 'complete')
                                ->isNotEmpty();
                        @endphp
                        @if($userHasCompletedSubmission)
                            <!-- Tombol Completed jika status completed -->
                            <button class="font-bold py-2 px-4 bg-green-500 text-white rounded" disabled>Completed</button>
                        @else
                            <!-- Tombol Bukti jika status belum completed -->
                            <a href="{{ route('task_applicants.create', $task) }}" class="font-bold py-2 px-4 bg-orange-500 text-white rounded">Bukti</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
