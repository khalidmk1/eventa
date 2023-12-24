@extends('master.dashboard')

@section('content')
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($events as $index => $event)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            <b>Price: </b> {{$event->price}} 
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{$event->title}}</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> {{$event->description}} </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                            Address: {{$event->adresse}}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: {{$event->user->phone}}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">   
                                    @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                                    <video id="myVideo_show" class="myVideo Myvideo_show rounded" autoplay loop muted>
                                        <source id="source_video"
                                            src="{{ asset('storage/event/video/' . $event->video) }}" type="video/mp4">
                                    </video>
                                @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                                  {{--   <img id="img_show" src="{{ asset('storage/event/image/' . $event->video) }}"
                                        alt="Event image"> --}}
                                        <img id="img_show" src="{{ asset('storage/event/image/' . $event->video) }}" alt="user-avatar"
                                        class="rounded img-fluid">
                                @endif

                                  
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="{{Route('dashboard.event.detail', $event->slug)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Event
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>

    </div>


   {{--  <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12">
                <div class="card">

                    <div class="card-body justify-content-center row m-auto ">

                        @foreach ($events as $index => $event)
                            <div class="item-container">
                                <div class="img-container">
                                    @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                                        <video id="myVideo_show" class="myVideo Myvideo_show" autoplay loop muted>
                                            <source id="source_video"
                                                src="{{ asset('storage/event/video/' . $event->video) }}" type="video/mp4">
                                        </video>
                                    @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                                        <img id="img_show" src="{{ asset('storage/event/image/' . $event->video) }}"
                                            alt="Event image">
                                    @endif


                                </div>

                                <div class="body-container">
                                    <div class="overlay"></div>

                                    <div class="event-info">
                                        <p class="title">{{ $event->title }}</p>
                                        <div class="separator_card"></div>
                                        <p class="info">Bellmore, NY</p>
                                        <p class="price">Free</p>

                                        <div class="additional-info">
                                            <p class="info">
                                                <i class="fas fa-map-marker-alt"></i>
                                                Grand Central Terminal
                                            </p>
                                            <p class="info" id="date">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ $event->date }}
                                            </p>

                                            <p class="info description">
                                                {{ strlen($event->description) > 110 ? substr($event->description, 0, 110) . ' ...' : $event->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ Route('dashboard.event.detail', $event->slug) }}" class="action">Detail</a>
                                </div>
                            </div>
                        @endforeach





                    </div><!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid --> --}}

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endsection
