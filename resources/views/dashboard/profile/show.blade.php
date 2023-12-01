@extends('master.dashboard')

@section('content')
    <div class="container-fluid">

        <div class="card card-primary card-outline">

            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                                role="tab" aria-controls="vert-tabs-home" aria-selected="true">Profile</a>
                            <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                                role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Edite</a>
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                                aria-labelledby="vert-tabs-home-tab">

                                <div class="row justify-content-center">
                                    <div class="col-md-5">

                                        <!-- Profile Image -->
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img  img-fluid img-circle"
                                                        src="{{asset('storage/avatars/'. $user->image)}}" alt="User profile picture">
                                                </div>

                                                <h3 class="profile-username text-center">{{$user->first_name.' '.$user->last_name}}</h3>

                                                <p class="text-muted text-center">{{$user->organization_name}}</p>

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

                                    
                                </div>



                            </div>
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                aria-labelledby="vert-tabs-profile-tab">
                                <form action="" method="post"></form>
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut
                                ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                                cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis
                                posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere
                                nec nunc. Nunc euismod pellentesque diam.
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
