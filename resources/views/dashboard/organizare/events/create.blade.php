@extends('master.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-9">
                <div class="card ">

                    <div class="card-body m-auto ">
                        <form action="{{ Route('dashboard.event.store') }}" id="store_event" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Exemple for user --}}

                            <div class="scene">
                                <div class="card">
                                    <div
                                        class="card__face card__face--front d-flex justify-content-center align-items-center">
                                        <div
                                            class="position-absolute paragraphe bg-dark shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                                            u can chose image flyer for u event </div>
                                        <img id="Myimage_scene" class="Myimage_scene"
                                            src="{{ asset('exemple\Black Party Night Club Dj Flyer.png') }}" />
                                    </div>
                                    <div
                                        class="card__face card__face--back d-flex justify-content-center align-items-center">
                                        <div
                                            class="position-absolute paragraphe bg-dark shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                                            Or u can chose video flyer for u event </div>
                                        <video id="myVideo_scene" class="myVideo_scene" autoplay loop muted>
                                            <source
                                                src="{{ asset('exemple\videos1700571747_podcast talk show - Made with PosterMyWall.mp4') }}"
                                                type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            {{-- end Exemple for user --}}

                            <img height="900" id="Myimage"
                                style="  object-fit: fill;
                            width: 100%;
                            border-radius:10px; "
                                src="{{ asset('storage/originals/image/1700574639_16-169348_user-icon-user-white-icon-transparent-clipart.jpg') }}"
                                alt="">
                            <video id="myVideo" class="myVideo Myvideo_create" height="900" autoplay loop muted>
                                <source
                                    src="{{ asset('storage/compressed/videos1700571747_podcast talk show - Made with PosterMyWall.mp4') }}"
                                    type="video/mp4">
                            </video>

                            <div class="video_add_containe">
                                <label for="add_file"><i class="fa fa-plus add_icon border border-dark"></i></label>
                                <input type="file" id="add_file" name="video" aria-hidden="true" />
                            </div>


                            <div class="col-md-12 mt-4">
                                <div class="card card-default">
                                    <div class="card-header text-center">
                                        <h3 class="card-title"><strong>Categories your event</strong></h3>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="bs-stepper">
                                            <div class="bs-stepper-header" role="tablist">
                                                <div class="d-flex flex-row justify-content-center">
                                                    <ul class="ks-cboxtags">
                                                        @foreach ($categories as $categorie)
                                                            <li><input type="checkbox" name="categories[]" class="checked"
                                                                    data-tag="{{ $categorie }}"
                                                                    id="checkboxOne_{{ $categorie }}"
                                                                    value="{{ $categorie }}"><label
                                                                    for="checkboxOne_{{ $categorie }}">{{ $categorie }}</label>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div>



                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="sport_tag">
                                                <div class="form-group">

                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select sport tag"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($sport_tags as $sport_tag)
                                                                <option>{{ $sport_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="Conferences_tag">
                                                <div class="form-group">

                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select a Conferences tag"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($Conferences_tags as $Conferences_tag)
                                                                <option>{{ $Conferences_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="expos_tag">
                                                <div class="form-group">
                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select a expos tag"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($expos_tags as $expos_tag)
                                                                <option>{{ $expos_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="concerts_tag">
                                                <div class="form-group">
                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select a concerts tag"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($concerts_tags as $concerts_tag)
                                                                <option>{{ $concerts_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="Festivals_tag">
                                                <div class="form-group">
                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select a Festivals tag"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($Festivals_tags as $Festivals_tag)
                                                                <option>{{ $Festivals_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="Performing_arts_tag">
                                                <div class="form-group">
                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select a Performing arts tag"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($Performing_arts_tags as $Performing_arts_tag)
                                                                <option>{{ $Performing_arts_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                            <div class="col-12 col-sm-12" id="Community_tags">
                                                <div class="form-group">
                                                    <div class="select2-purple">
                                                        <select class="select2" name="tags[]" multiple="multiple"
                                                            data-placeholder="Select a Community tags"
                                                            data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                            @foreach ($Community_tags as $Community_tag)
                                                                <option>{{ $Community_tag }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->


                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>



                            </div>
                            <!-- /.col -->

                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <!-- Date and time range -->
                                <div class="form-group">
                                    <label>start and end of the event:</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" name="date" class="form-control float-right"
                                            id="reservationtime">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>

                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Date and time:</label>
                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#reservationdatetime" />
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>




                            <!-- /.form group -->
                            {{--     <!-- Date and time -->
                <div class="form-group">
                    <label>Date and time:</label>
                      <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime_1"/>
                          <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                  <!-- /.form group --> --}}

                            <div class="col-sm-12">
                                <label>Programme</label>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home"
                                            aria-selected="true">Day 1</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="p-1"><i class="fa fa-plus-square " style="float: left" id="addTabBtn"
                                            aria-hidden="true"></i></div>
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <button class="close close-tab" type="button" aria-label="Close">
                                            <span aria-hidden="true">
                                            </span>
                                        </button>
                                        <div class="form-group pt-3">
                                            <textarea class="form-control" name="programme[]" rows="3" placeholder="Programme of the day"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" style="float: right"
                                    class="btn btn-block btn-outline-primary mt-3 w-25 ">create</button>
                            </div>

                        </form>
                    </div><!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
