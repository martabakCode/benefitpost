<nav class="container max-w-[1130px] mx-auto flex items-center flex-wrap justify-between p-4 rounded-[20px] bg-white mt-[30px] gap-y-3 sm:gap-y-0">
    <a href="{{ route('front.index') }}" class="flex items-center text-3xl font-bold">
        <img src="{{ asset('assets/logos/logo.svg') }}" alt="logo">
        <span class="flex flex-col">
            BenefitPost
            <span class="text-sm font-normal">Brand</span>
        </span>
    </a>
    <ul class="flex items-center flex-wrap gap-x-[30px]">
        <li>
            <a href="{{ route('front.index') }}" class="hover:font-semibold hover:text-[#6635F1] transition-all duration-300 {{ request()->routeIs('front.index', ) }} ? 'text-[#6635F1] font-semibold' :  ''">Campaigns</a>
        </li>
        <li>
            <a href="{{ route('front.index') }}" class="hover:font-semibold hover:text-[#6635F1] transition-all duration-300">BenefitPost</a>
        </li>
    </ul>
    @auth
    <a href="{{ route('dashboard') }}">
        <div class="flex items-center gap-3">
            <p class="font-semibold">Holla, {{ Auth::user()->name }}</p>
            <div class="w-[50px] h-[50px] rounded-full overflow-hidden flex shrink-0">
                <img src="{{ asset(Storage::url(Auth::user()->avatar)) }}" class="w-full h-full object-cover" alt="photo">
            </div>
        </div>
    </a>
    @endauth
    @guest
    <div class="flex items-center gap-3">
        <a href="{{ route('login') }}" class="bg-[#030303] p-[14px_20px] rounded-full font-semibold text-white text-center w-fit text-nowrap">Sign In</a>
        <a href="{{ route('register') }}" class="bg-[#6635F1] p-[14px_20px] rounded-full font-semibold text-white text-center w-fit text-nowrap">Sign Up</a>
    </div>
    @endguest
  </nav>
