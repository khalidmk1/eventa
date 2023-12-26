{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('master.landing-page')

@section('content')
    <div id="ajax-errors-container">

    </div>    

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $error }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    <div class="card style_card centre_card mb-2" id="card_style">

        <div class="card-body ">
            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">Login</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Sing up</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <form action="{{ Route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label text-white">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control bg_form"
                                id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleInputPassword1" class="form-label text-white">Password</label>
                            <div class="d-flex position-relative">
                                <input type="password" name="password" class="form-control bg_form"
                                    id="exampleInputPassword1" required>
                                <i class="fa fa-eye text-white position-absolute p-2 toggle-password"
                                    style="right: 0px;"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label text-white" for="exampleCheck1 " name="remember">Remember
                                    Me</label>
                            </div>
                            <div class="mb-3 ">
                                @if (Route::has('password.request'))
                                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                        href="{{ route('password.request') }}">
                                        Forgot your password
                                    </a>
                                @endif
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <form action="{{ Route('register') }}" id="register_user" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('exemple/default-avatar-profile-icon-of-social-media-user-photo-image-vector.jpg') }}"
                                    id="avatar" class="rounded mx-auto d-block image_avatar" alt="avatar">
                                <div class="video_add_containe">
                                    <label for="add_file"><i class="fa fa-plus add_icon border border-dark"></i></label>
                                    <input type="file" id="add_file" name="image" aria-hidden="true" />
                                </div>

                                <div class="mb-3">
                                    <label for="first_name" class="form-label text-white">Name</label>
                                    <input type="text" value="{{ old('first_name') }}" name="first_name"
                                        class="form-control bg_form" id="irst_name" aria-describedby="emailHelp"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label text-white">Last Name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                                        class="form-control bg_form" id="last_name" aria-describedby="emailHelp"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label text-white">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control bg_form" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        required>
                                </div>
                                <div class="mb-3 ">
                                    <label for="exampleInputPassword1" class="form-label text-white">Password</label>
                                    <div class="d-flex position-relative">
                                        <input type="password" name="password" class="form-control bg_form"
                                            id="exampleInputPassword1" required>
                                        <i class="fa fa-eye text-white position-absolute p-2 toggle-password"
                                            style="right: 0px;"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword2" class="form-label text-white">Confirme
                                        Password</label>
                                    <div class="d-flex position-relative">
                                        <input type="password" class="form-control bg_form " name="password_confirmation"
                                            id="exampleInputPassword1" required>
                                        <i class="fa fa-eye text-white position-absolute p-2 toggle-password"
                                            style="right: 0px;"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="col d-flex flex-column justify-content-center">

                                <div class="mb-3">
                                    <label class="form-label text-white" for="roleSelect">Sing up as</label>
                                    <select name="role" class="form-select select_option" id="roleSelect">
                                        <option value="visiter">Visiter</option>
                                        <option value="organizer">organizare</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-white" for="phone">Phone Number</label>
                                    <input type="text" id="phone" class="form-control bg_form"
                                        placeholder="(00) 555-5555" required name="phone" />
                                </div>

                                <div class="mb-3 ">
                                    <label class="form-label text-white" for="inputGroupSelect01">County</label>
                                    <select class="form-select select_option" name="county" id="inputGroupSelect01">
                                        @foreach ($county as $countys)
                                            <option value="{{ $countys }}">{{ $countys }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3" id="Adresse_hd">
                                    <label for="Adresse" class="form-label text-white">Adresse</label>
                                    <input type="text" name="adresse" value="{{ old('Adresse') }}"
                                        class="form-control bg_form" id="Adresse" aria-describedby="emailHelp">
                                </div>

                                <div class="mb-3" id="organizationName">
                                    <label for="organization_name" class="form-label text-white">Name of
                                        Organization</label>
                                    <input type="text" value="{{ old('organization_name') }}"
                                        class="form-control bg_form" id="organization_name" name="organization_name">
                                </div>

                                <div class="mb-3" id="organizationLink">
                                    <label for="organization_link" class="form-label text-white">Link of
                                        Organization</label>
                                    <input type="url" value="{{ old('organization_link') }}"
                                        class="form-control bg_form" id="organization_link" name="organization_link">
                                </div>

                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection
