<x-guest-layout>
    <div class="w-full max-w-md mx-auto">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-indigo-600">
                Plateforme Workshops
            </h1>

            <p class="mt-2 text-gray-500">
                Create your account and join our workshops.
            </p>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" />

                    <x-text-input
                        id="name"
                        class="block mt-2 w-full rounded-xl"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name" />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-5">
                    <x-input-label for="email" :value="__('Email Address')" />

                    <x-text-input
                        id="email"
                        class="block mt-2 w-full rounded-xl"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="mt-5">
                    <x-input-label for="role" value="Role" />

                    <select
                        id="role"
                        name="role"
                        class="block mt-2 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                        <option value="participant">Participant</option>
                        <option value="formateur">Formateur</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input
                        id="password"
                        class="block mt-2 w-full rounded-xl"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-5">
                    <x-input-label
                        for="password_confirmation"
                        :value="__('Confirm Password')" />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-2 w-full rounded-xl"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />

                    <x-input-error
                        :messages="$errors->get('password_confirmation')"
                        class="mt-2" />
                </div>

                <div class="mt-8">
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-300">
                        Create Account
                    </button>
                </div>

                <div class="text-center mt-6">
                    <a
                        href="{{ route('login') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-800">
                        Already have an account? Sign in
                    </a>
                </div>

            </form>

        </div>
    </div>
</x-guest-layout>
```
