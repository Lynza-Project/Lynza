<x-guest-layout>
    <div class="h-screen flex flex-col lg:flex-row bg-gray-50">
        <!-- Section image -->
        <div
            class="lg:w-1/2 lg:flex hidden justify-center items-center bg-cover bg-center"
            style="background-image: url('{{ asset('img/university.jpg') }}');"
        >
        </div>

        <!-- Section formulaire -->
        <div class="lg:w-1/2 flex justify-center items-center p-6">
            <form method="POST" action="{{ route('login') }}"
                  class="bg-white w-full md:w-3/4 lg:w-2/3 xl:w-1/2 p-8 shadow-lg rounded-md border">
                @csrf
                <h1 class="text-gray-800 font-bold text-2xl mb-1">Connexion</h1>
                <p class="text-sm font-normal text-gray-600 mb-6">Veuillez vous connecter pour continuer</p>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md" type="email"
                                  name="email" :value="old('email')" required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Mot de passe')"/>
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md" type="password"
                                  name="password" required autocomplete="current-password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center">
                    <!-- Button -->
                    <button type="submit"
                            class="bg-blue-500 w-full py-2 text-white rounded-md font-semibold hover:bg-blue-600 transition">
                        {{ __('Connexion') }}
                    </button>

                    <!-- Link to register -->
                    <p class="text-gray-600 text-sm mt-4 hover:underline">
                        Pas encore de compte ? Contactez nous !
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
