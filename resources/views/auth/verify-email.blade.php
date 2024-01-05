{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}


@extends('master.landing-page')


@section('content')
    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-6 mx-auto">
                <div class="card shadow border style_card border-0">
                    <div class="card-body d-flex flex-column align-items-center text-light">
                        <p class="card-text ">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <p class="card-text text-success">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </p>
                        @endif

                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <button type="submit"
                                    class="btn btn-primary">{{ __('Resend Verification Email') }}</button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                               
                                <button type="submit"
                                    class="border-0 bg-transparent link-offset-2 link-underline link-underline-opacity-100">{{ __('Log Out') }}</button>

                            </form>
                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
