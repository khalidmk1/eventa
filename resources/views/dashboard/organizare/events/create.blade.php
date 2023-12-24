@extends('master.dashboard')

@section('content')
    <style>
        /* spiner charge */
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: #FF3D00;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="container-fluid">

        <div id="message_containe" class="row justify-content-center "></div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content bg-transparent border-0 shadow-none">
                    <div class="modal-body text-center">
                        <span class="loader"></span>
                    </div>
                </div>
            </div>
        </div>



        <div class="row justify-content-center ">

            <div class="col-md-9" id="form_containe">

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


                            <div class="row">
                                <!-- Date and time -->
                                <div class="form-group col-12 col-md-6">
                                    <label>Date start:</label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="date_start"
                                            data-target="#reservationdatetime" />
                                        <div class="input-group-append" data-target="#reservationdatetime"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Date and time -->
                                <div class="form-group col-12 col-md-6">
                                    <label>Date end:</label>
                                    <div class="input-group date" id="reservationdatetime_1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" name="date_end"
                                            data-target="#reservationdatetime_1" />
                                        <div class="input-group-append" data-target="#reservationdatetime_1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Price:</label>
                                        <input type="text" name="price" class="form-control" placeholder="price">
                                    </div>
                                </div>

                                <!-- /.form-group -->
                                <div class="form-group col-12 col-md-6">
                                    <label>City</label>
                                    <select class="form-control select2" name="city" style="width: 100%;">
                                        @foreach ($city as $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->

                            </div>


                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Adresse:</label>
                                    <input type="text" name="adresse" class="form-control" placeholder="Adresse">
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <label>Programme</label>
                                <div class="row" id="programmeContainer">
                                    <div class="col-4">
                                        <div class="card border-primary mb-3" style="max-width: 50rem;">
                                            <div class="card-header align-items-center justify-content-between d-flex ">
                                                <span>Day 1</span> <i
                                                    class="fa fa-plus card_add border border-dark add-programme"></i>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group ">
                                                    <textarea class="form-control " name="programme[]" id="exampleFormControlTextarea1" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
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
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

    <script>
        //create event
        $(document).ready(function() {

            $('#store_event').submit(function(e) {
                e.preventDefault();
                $('#exampleModalCenter').modal('show')
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setTimeout(function() {
                            $('#exampleModalCenter').modal('hide')
                            location.reload(); // Reload the page after success
                        }, 1000);

                        $('html, body').animate({
                            scrollTop: 0
                        }, 'slow');
                        $('.days').remove();

                        if ($('.days').length === 0) {
                            let addButton =
                                '<i class="fa fa-plus card_add border border-dark add-programme"></i>';
                            $('#programmeContainer .card-header').last().append(addButton);
                        }


                        $('#store_event')[0].reset();

                        var seccuss;
                        if (response.message === "The date is invalid") {
                            seccuss = `<div class="col-6 alert alert-danger alert-dismissible ml-2 text-center fade show danger_alert" role="alert">
                        <strong>${response.message}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`;
                        } else {
                            seccuss = `<div class="col-6 alert alert-success alert-dismissible ml-2 text-center fade show danger_alert" role="alert">
                        <strong>${response.message}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`;
                        }


                        $('#message_containe').append(seccuss);
                        console.log(response);
                    },
                    error: function(error) {

                        setTimeout(function() {
                            $('#exampleModalCenter').modal('hide')
                        }, 1000);

                        console.log(error);
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'slow');

                        if ($('#message_containe').children().length > 0) {
                            $('#message_containe').empty();
                        }


                        if (error.responseJSON.errors) {

                            $.each(error.responseJSON.errors, function(key, value) {
                                console.log(value);
                                var error = `<div class="col-6 alert alert-danger alert-dismissible ml-2 text-center fade show  danger_alert " role="alert">
                                        <strong>${value}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`;
                                $('#message_containe').append(error);
                            });
                        }

                       
                        


                    }

                });
            });




        });
    </script>
@endsection
