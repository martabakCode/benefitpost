<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section id="categories" class="container max-w-[1130px] mx-auto my-4 flex flex-col gap-4 mt-[50px]">
                    <h2 class="font-bold text-xl">Browse Categories</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-5">
                        @forelse ($categories as $category)
                            <a href="{{ route('front.category', $category->slug) }}" class="card">
                                <div class="p-5 rounded-[20px] bg-white flex flex-col gap-[30px] hover:ring-2 hover:ring-[#6635F1] transition-all duration-300">
                                    <div class="w-[70px] h-[70px] flex shrink-0">
                                        <img src="{{Storage::url($category->icon)}}" alt="icon">
                                    </div>
                                    <div class="flex flex-col gap-[6px]">
                                        <p href="" class="font-semibold text-lg">{{ $category->name }}</p>
                                        <p class="text-sm text-[#545768]">{{ $category->projects->count() }} jobs available</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p>Belum ada kategory terbaru</p>
                        @endforelse
                    </div>
                </section>
                <section id="featured" class="container max-w-[1130px] mx-auto my-4 flex flex-col gap-4 mt-[50px]">
                    <h2 class="font-bold text-xl">Featured Projects</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">

                        @forelse ($projects as $project)
                            <a href="{{ route('front.details', $project) }}" class="card">
                                <div class="p-5 rounded-[20px] bg-white flex flex-col gap-5 hover:ring-2 hover:ring-[#6635F1] transition-all duration-300">
                                    <div class="w-full h-[140px] rounded-[20px] overflow-hidden relative">
                                        @if ($project->has_finished)
                                            <div class="font-bold text-xs leading-[18px] text-white bg-[#F3445C] p-[2px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">CLOSED</div>
                                        @else
                                            @if ($project->has_started)
                                                    <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">IN PROGRESS</div>
                                            @else
                                                <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit absolute top-[10px] left-[10px]">SUBMISSION OPEN</div>
                                            @endif
                                        @endif
                                        <img src="{{Storage::url($project->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                                    </div>
                                    <div class="flex flex-col gap-[10px]">
                                        <p class="title font-semibold text-lg min-h-[56px] line-clamp-2 hover:line-clamp-none">{{ $project->name }}</p>
                                        <div class="flex items-center gap-[6px]">
                                            <div>
                                                <img src="{{asset('assets/icons/dollar-circle.svg')}}" alt="icon">
                                            </div>
                                            <p class="font-semibold text-sm">Rp {{number_format($project->budget, 0, ',','.')}}</p>
                                        </div>
                                        <div class="flex items-center gap-[6px]">
                                            <div>
                                                <img src="{{asset('assets/icons/verify.svg')}}" alt="icon">
                                            </div>
                                            <p class="font-semibold text-sm">Payment Verified</p>
                                        </div>
                                        <div class="flex items-center gap-[6px]">
                                            <div>
                                                <img src="{{asset('assets/icons/crown.svg')}}" alt="icon">
                                            </div>
                                            <p class="font-semibold text-sm">{{ $project->skill_level }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <P>Belum ada data project terbaru</P>
                        @endforelse
                    </div>
                </section>
                <section id="newest" class="container max-w-[1130px] mx-auto my-4 flex flex-col sm:flex-row sm:flex-nowrap gap-5 mt-[50px]">
                    <div class="flex flex-col gap-4 w-full">
                        <h2 class="font-bold text-xl">Newest Projects</h2>
                        <div class="flex flex-col gap-5">
                            @forelse ($projects as $project)
                                <div class="card hover:ring-2 hover:ring-[#6635F1] transition-all duration-300 bg-white p-5 rounded-[20px] flex flex-col sm:flex-row sm:items-center gap-[18px] w-full">
                                    <a href="{{ route('front.details', $project) }}" class="w-full sm:w-[200px] h-[150px] flex shrink-0 rounded-[20px] overflow-hidden bg-[#D9D9D9]">
                                        <img src="{{Storage::url($project->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                                    </a>
                                    <div class="flex flex-col gap-[10px]">

                                        @if ($project->has_finished)
                                            <div class="font-bold text-xs leading-[18px] text-white bg-[#F3445C] p-[2px_10px] rounded-full w-fit">CLOSED</div>
                                        @else
                                            @if ($project->has_started)
                                                    <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit">IN PROGRESS</div>
                                            @else
                                                <div class="font-bold text-xs leading-[18px] text-white bg-[#2E82FE] p-[2px_10px] rounded-full w-fit">SUBMISSION OPEN</div>
                                            @endif
                                        @endif

                                        <a href="{{ route('front.details', $project) }}" class="font-semibold text-lg leading-[27px]">  </a>
                                        <p class="title font-semibold text-lg  line-clamp-2 hover:line-clamp-none">{{ $project->name }}</p>
                                        <p class="text-sm leading-7 line-clamp-2">{{ $project->about }}</p>
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                            <div class="flex items-center gap-[6px]">
                                                <div>
                                                    <img src="{{asset('assets/icons/dollar-circle.svg')}}" alt="icon">
                                                </div>
                                                <p class="font-semibold text-sm">RP {{number_format($project->budget, 0, ',','.')}}</p>
                                            </div>
                                            <div class="flex items-center gap-[6px]">
                                                <div>
                                                    <img src="{{asset('assets/icons/verify.svg')}}" alt="icon">
                                                </div>
                                                <p class="font-semibold text-sm">Payment Verified</p>
                                            </div>
                                            <div class="flex items-center gap-[6px]">
                                                <div>
                                                    <img src="{{asset('assets/icons/crown.svg')}}" alt="icon">
                                                </div>
                                                <p class="font-semibold text-sm">{{ $project->skill_level }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada project terbaru</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex flex-col sm:w-[300px] h-fit shrink-0 bg-white rounded-[20px] p-5 gap-[30px] sm:mt-[45px]">

                        @auth
                            <div class="flex flex-col gap-3">
                                <h3 class="font-semibold">Your Profile</h3>
                                <div class="flex items-center gap-3">
                                    <div class="w-[50px] h-[50px] rounded-full overflow-hidden flex shrink-0">
                                        <img src="{{Storage::url(Auth::user()->avatar)}}" class="w-full h-full object-cover" alt="photo">
                                    </div>
                                    <div class="flex flex-col gap-[2px]">
                                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                        @endauth
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
