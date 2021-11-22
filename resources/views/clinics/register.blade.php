<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/extra.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
    <body class="antialiased">

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
                <div class="overflow-hidden sm:rounded-lg">
                    <x-jet-authentication-card>
                        <x-slot name="logo">
                            <span class="ml-4 mt-4 my-auto fw-bold text-title"><a class="text-aquablue text-decoration-none" href="{{route('home')}}"><i class="fas fa-tooth"></i> DCS</a></span>
                        </x-slot>

                        <x-jet-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('clinicregister') }}">
                            @csrf

                            <div>
                                <x-jet-label for="name" value="Nombre de la clinica" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="nameUser" value="Nombre de usuario" />
                                <x-jet-input id="nameUser" class="block mt-1 w-full" type="text" name="nameUser" :value="old('nameUser')" required autofocus autocomplete="nameUser" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="email" value="Correo electrónico" />
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="Contraseña" />
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <!--<div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>-->

                            {{--@if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms"/>

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                            @endif--}}

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('¿Ya esta registrado?') }}
                                </a>

                                <x-jet-button class="ml-4 bg-aquablue">
                                    {{ __('Registrarse') }}
                                </x-jet-button>
                            </div>
                        </form>
                    </x-jet-authentication-card>
                </div>
            </div>
        </div>
        @livewireScripts
</body>
</html>