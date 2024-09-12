<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- 2-column grid layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Avatar -->
            <div>
                <x-input-label for="avatar" :value="__('Photo Avatar')" />
                <input id="avatar" name="avatar" type="file" class="mt-1 block w-full" accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>

            <!-- Gender -->
            <div>
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" class="mt-1 block w-full">
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <!-- Birthdate -->
            <div>
                <x-input-label for="birthdate" :value="__('Birthdate')" />
                <x-text-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" :value="old('birthdate', $user->birthdate)" required />
                <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
            </div>

            <!-- Phone Number -->
            <div>
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
            </div>

            <!-- Occupation -->
            <div>
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full" :value="old('occupation', $user->occupation)" />
                <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
            </div>

            <!-- Address -->
            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <!-- City -->
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <!-- Marital Status -->
            <div>
                <x-input-label for="status_marriage" :value="__('Marital Status')" />
                <select id="status_marriage" name="status_marriage" class="mt-1 block w-full">
                    <option value="single" {{ old('status_marriage', $user->status_marriage) == 'single' ? 'selected' : '' }}>{{ __('Single') }}</option>
                    <option value="married" {{ old('status_marriage', $user->status_marriage) == 'married' ? 'selected' : '' }}>{{ __('Married') }}</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status_marriage')" />
            </div>

            <!-- Instagram -->
            <div>
                <x-input-label for="ig" :value="__('Instagram')" />
                <x-text-input id="ig" name="ig" type="text" class="mt-1 block w-full" :value="old('ig', $user->ig)" />
                <x-input-error class="mt-2" :messages="$errors->get('ig')" />
            </div>

            <!-- TikTok -->
            <div>
                <x-input-label for="tiktok" :value="__('TikTok')" />
                <x-text-input id="tiktok" name="tiktok" type="text" class="mt-1 block w-full" :value="old('tiktok', $user->tiktok)" />
                <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
            </div>

            <!-- Twitter -->
            <div>
                <x-input-label for="twitter" :value="__('Twitter')" />
                <x-text-input id="twitter" name="twitter" type="text" class="mt-1 block w-full" :value="old('twitter', $user->twitter)" />
                <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
