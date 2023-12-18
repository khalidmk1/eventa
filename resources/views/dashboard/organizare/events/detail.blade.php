@extends('master.dashboard')


@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12">
                <div class="card">

                    <div class="card-body justify-content-center m-auto ">

                        <h1><strong>{{$event->title}}</strong></h1>
                        {{--  <img src="{{asset('')}}" class="card-img-top" alt="..."> --}}
                        @if (in_array($extension, ['mp4', 'avi', 'mov']))
                            <video  class="myVideo Myvideo_detail " autoplay loop muted>
                                <source id="source_video" class="media-item"
                                    src="{{ asset('storage/compressed/' . $event->video) }}" type="video/mp4">
                            </video>
                        @else
                            <img height="900"  class="card-img-top media-item img_detail"
                               
                                src="{{ asset('storage/compressed/' . $event->video) }}" alt="">
                        @endif


                        <div class="card-body">
                            

                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>


                    </div><!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

     <!-- Date and time -->
     <div class="form-group">
        <label>Date and time:</label>
        <div class="input-group date" id="reservationdatetime_1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input"
                data-target="#reservationdatetime_1" />
            <div class="input-group-append" data-target="#reservationdatetime_1"
                data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>


   
@endsection
