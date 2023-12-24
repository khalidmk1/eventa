@extends('master.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="card card-primary card-outline">

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show w-50 m-auto mt-2" role="alert">
                    Your Profile has been Updated with <strong>Success</strong> .
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('status') === 'password-updated')
                <div class="alert alert-success alert-dismissible fade show w-50 m-auto mt-2" role="alert">
                    Your Password has been Updated with <strong>Success</strong> .
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show w-50 m-auto mt-2" role="alert">
                        <strong>{{ $error }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif

            <div class="card-body">


                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="edit-tab" data-toggle="tab" data-target="#edit" type="button"
                            role="tab" aria-controls="profile" aria-selected="false">Edit</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="row justify-content-center">
                            <div class="col-md-4 m-2">

                                <!-- Profile Image -->
                                <div class="card card-primary ">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img  img-fluid img-circle"
                                                src="{{ asset('storage/avatars/' . $user->image) }}"
                                                alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">
                                            {{ $user->first_name . ' ' . $user->last_name }}</h3>

                                        <p class="text-muted text-center">{{ $user->organization_name }}</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Followers</b> <a class="float-right">1,322</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Following</b> <a class="float-right">543</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Friends</b> <a class="float-right">13,287</a>
                                            </li>
                                        </ul>

                                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-4 m-2">
                                <!-- About Me Box -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <strong><i class="fas fa-book mr-1"></i> City</strong>

                                        <p class="text-muted">
                                            {{ $user->county }}
                                        </p>

                                        <hr>

                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Adresse</strong>

                                        <p class="text-muted">{{ $user->adresse }}</p>

                                        <hr>



                                        <strong><i class="fas fa-phone mr-1"></i> Phone</strong>


                                        <p class="text-muted">{{ $user->phone }}</p>


                                        <hr>

                                        <strong><i class="fa fa-link mr-1"></i> Link</strong> <br>

                                        <a href="{{ $user->organization_link }}"
                                            class="text-muted">{{ $user->organization_link }}</a>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                            </div>





                        </div>

                    </div>
                    <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">

                        <div class="card card-primary  m-2">

                            <div class="card-body">

                                <form class="row" action="{{ route('profile.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="col-md-3 border-right">
                                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                            <img class="rounded mx-auto d-block" name="image"
                                                style="width: 100% ; height:200px"
                                                src="{{ asset('storage/avatars/' . $user->image) }}" id="avatar">
                                            <div class="edit_profile_image ">
                                                <label for="add_file"><i
                                                        class="fa fa-plus add_icon border border-dark"></i></label>
                                                <input type="file" id="add_file" name="image" id="add_file"
                                                    aria-hidden="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md ">
                                        <div class="p-3 py-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="text-right">Profile Settings</h4>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6"><label class="labels">First Name</label><input
                                                        type="text" class="form-control" placeholder="first name"
                                                        name="first_name" value="{{ $user->first_name }}">
                                                </div>
                                                <div class="col-md-6"><label class="labels">Last Name</label><input
                                                        type="text" class="form-control"
                                                        value="{{ $user->last_name }}" name="last_name"
                                                        placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12"><label class="labels">Phone
                                                        Number</label><input type="text" class="form-control"
                                                        name="phone" placeholder="enter phone number"
                                                        value="{{ $user->phone }}">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Company
                                                        Name</label><input type="text" class="form-control"
                                                        name="organization_name" placeholder="enter Company name"
                                                        value="{{ $user->organization_name }}">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Email</label><input
                                                        type="email" class="form-control" name="email"
                                                        placeholder="enter email " value="{{ $user->email }}">
                                                </div>
                                                <div class="col-md-12"><label class="labels">Company
                                                        Link</label><input type="text" class="form-control"
                                                        name="organization_link" placeholder="enter Comapny link"
                                                        value="{{ $user->organization_link }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6"><label class="labels">Country</label><input
                                                        type="text" class="form-control" placeholder="country"
                                                        value="{{ $user->county }}" name="county">
                                                </div>
                                                <div class="col-md-6"><label class="labels">Adresse</label><input
                                                        type="text" class="form-control" value="{{ $user->adresse }}"
                                                        placeholder="Adresse" name="adresse">
                                                </div>
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
                                                    <input type="password" class="form-control"
                                                        placeholder="enter your new password" name="password">
                                                    <i class="fa fa-eye  position-absolute p-2 toggle-password"
                                                        style="right: 0px;"></i>
                                                </div>

                                            </div>

                                            <div class="col-md-12"><label class="labels">Confirme
                                                    Password</label>
                                                <div class="d-flex position-relative">
                                                    <input type="password" class="form-control"
                                                        placeholder="Confirme password" name="password_confirmation">
                                                    <i class="fa fa-eye position-absolute p-2 toggle-password"
                                                        style="right: 0px;"></i>
                                                </div>

                                            </div>

                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-primary text-right profile-button mt-3"
                                                    type="submit">Edit
                                                    Password</button>
                                            </div>

                                        </div>


                                    </div>
                                </form>







                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <!-- /.card -->
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
