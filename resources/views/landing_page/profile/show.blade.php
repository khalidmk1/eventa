@extends('master.landign_page_home')

@section('content')
    <style>
        .tab-content>.active {
            display: flex;
        }
    </style>


    <div class="container text-center">

        <div class="row">

            <div class="col-sm-4  mt-4 ">

                @if ($errors->updatePassword->any())
                    @foreach ($errors->updatePassword->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-regular fa-circle-check"></i> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow p-1 bg-body-tertiary">
                    <div class="card-body">

                        <img src="{{ asset('storage/avatars/' . $user->image) }}" id="avatar"
                            class="rounded-circle w-50 shadow p-1 bg-body-tertiary rounded " style="height: 180px;"
                            alt="Avatar">
                        <h5 class="card-title mt-3">{{ $user->first_name . ' ' . $user->last_name }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $user->organization_name }}</h6>
                        <p class="card-text"><i class="fa-solid fa-phone"></i> {{ $user->phone }}</p>
                        @if ($user->organization_link)
                            <p class="card-text"><a href="{{ $user->organization_link }}"
                                    class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    <i class="fa-solid fa-link"></i> website</a></p>
                        @endif
                        <ul class="nav nav-pills mb-3 justify-content-between" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Profile</button>
                            </li>
                            @auth
                                @if (auth()->user()->slug == $user->slug && $user->role == 'visiter')
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Edit</button>
                                    </li>
                                @endif
                            @endauth




                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-sm-8 tab-content" id="pills-tabContent">

                <div class="row shadow p-1 mt-4 bg-body-tertiary rounded  row-cols-1 row-cols-md-2 g-4 tab-pane fade show active"
                    id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    @foreach ($events as $index => $event)
                        <div class="col">
                            <div class="card h-100 shadow-lg border-0  mb-5 p-0 rounded">
                                <div class="position-relative">
                                    <span class="position-absolute price">Free</span>
                                    @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                                        <video class="card-img-top  about_vid w-100" autoplay loop muted>
                                            <source src="{{ asset('storage/event/video/' . $event->video) }}"
                                                type="video/mp4">
                                        </video>
                                    @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/event/image/' . $event->video) }}"
                                            class="card-img-top about_img" alt="Skyscrapers" />
                                    @endif

                                </div>
                                <div class="card-body ">
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <p class="card-text">
                                        {{ strlen($event->description) > 200 ? substr($event->description, 0, 200) . ' ...' : $event->description }}
                                    </p>
                                </div>

                                <div class="text-center">
                                    <a class="btn btn-info w-25 mb-2"
                                        href="{{ Route('home.detail', $event->slug) }}">detail -></a>
                                </div>

                                <div class="card-footer border-0 text-center">
                                    @foreach ($event->categorie as $index => $categorie)
                                        @if ($index == 3)
                                        @break
                                    @endif
                                    <small class="text-muted categorie-tag">{{ $categorie }}</small>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="row shadow p-1 mt-4 bg-body-tertiary rounded row-cols-1 row-cols-md-2 g-4 tab-pane fade "
                id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <form class="row" action="{{ route('home.update', $user->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="col-md ">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">choose image</label>
                                <input class="form-control form-control-sm" id="formFileSm" name="image"
                                    type="file">
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">First Name</label><input type="text"
                                        class="form-control" placeholder="first name" name="first_name"
                                        value="{{ $user->first_name }}">
                                </div>
                                <div class="col-md-6"><label class="labels">Last Name</label><input type="text"
                                        class="form-control" value="{{ $user->last_name }}" name="last_name"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Phone
                                        Number</label><input type="text" class="form-control" name="phone"
                                        placeholder="enter phone number" value="{{ $user->phone }}">
                                </div>

                                <div class="col-md-12"><label class="labels">Email</label><input type="email"
                                        class="form-control" name="email" placeholder="enter email "
                                        value="{{ $user->email }}">
                                </div>

                            </div>
                            <div class="col-md-12"><label for="city" class="labels">Country</label>
                                <select class="form-select form-select-sm" name="county"
                                    aria-label=".form-select-sm example" id="city">
                                    <option class="selected" value="{{ $user->county }}">{{ $user->county }}
                                    </option>
                                    @foreach ($city as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">Edit
                                    Profile</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form class="row" method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="col-md">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience">
                                <span>Edit Password</span>
                            </div><br>
                            <div class="col-md-12"><label class="labels">Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" class="form-control"
                                        placeholder="entre your current password" name="current_password">
                                    <i class="fa fa-eye  position-absolute p-2 toggle-password"
                                        style="right: 0px;"></i>
                                </div>

                            </div> <br>
                            <div class="col-md-12"><label class="labels">New Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" class="form-control" placeholder="enter your new password"
                                        name="password">
                                    <i class="fa fa-eye  position-absolute p-2 toggle-password"
                                        style="right: 0px;"></i>
                                </div>

                            </div>

                            <div class="col-md-12"><label class="labels">Confirme
                                    Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" class="form-control" placeholder="Confirme password"
                                        name="password_confirmation">
                                    <i class="fa fa-eye position-absolute p-2 toggle-password"
                                        style="right: 0px;"></i>
                                </div>

                            </div>

                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary text-right profile-button mt-3" type="submit">Edit
                                    Password</button>
                            </div>

                        </div>


                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
@endsection
