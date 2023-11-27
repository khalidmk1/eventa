{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('master.landing-page')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show w-25 m-auto mt-2" role="alert">
            <strong>{{ $error }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach

    <div class="card style_card centre_card mb-2  p-2" id="card_style">
        <div class="mb-4 text-sm text-white">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        {{-- <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
         <!-- Session Status -->
         @if(session('status'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>{{ session('status') }}</strong>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
     @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-white">Email address</label>
                <input type="email" value="{{ old('email') }}" class="form-control bg_form" id="exampleInputEmail1"
                    name="email" aria-describedby="emailHelp" required>
            </div>

            <div class="d-flex items-center justify-content-end mt-4">
                <button type="button" class="btn btn-primary" data-mdb-ripple-init>Email Password Reset Link</button>
            </div>
        </form>

    </div>
@endsection
