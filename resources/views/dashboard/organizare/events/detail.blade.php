@extends('master.dashboard')


@section('content')

   {{--  <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12">
                <div class="card">

                    <div class="card-body justify-content-center  ">

                        <h1><strong>{{$event->title}}</strong></h1>
                        
                        @if (in_array($extension, ['mp4', 'avi', 'mov']))
                            <video  class="myVideo Myvideo_detail " autoplay loop muted>
                                <source id="source_video" class="media-item"
                                    src="{{ asset('storage/event/video/' . $event->video) }}" type="video/mp4">
                            </video>
                        @else
                            <img  class="card-img-top media-item img_detail"
                               
                                src="{{ asset('storage/event/image/' . $event->video) }}" alt="">
                        @endif


                        <div class="card-body">
                            <h4><p>Categorie :</p></h4> 


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
    </div><!-- /.container-fluid --> --}}





    
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Event Detail</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
          <div class="row">
            <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Number of Participted</span>
                  <span class="info-box-number text-center text-muted mb-0">2300</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Number of Folowers</span>
                  <span class="info-box-number text-center text-muted mb-0">2000</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Estimated project duration</span>
                  <span class="info-box-number text-center text-muted mb-0">20</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <h4></h4>
                <div class="post">
                    @if (in_array($extension, ['mp4', 'avi', 'mov']))
                    <video  class="myVideo Myvideo_detail " autoplay loop muted>
                        <source id="source_video" class="media-item"
                            src="{{ asset('storage/event/video/' . $event->video) }}" type="video/mp4">
                    </video>
                @else
                    <img  class="card-img-top media-item img_detail"
                       
                        src="{{ asset('storage/event/image/' . $event->video) }}" alt="">
                @endif
                </div>

                
               
                <div class="post d-flex flex-column" >
                    <h3 class="card-title mb-3">Programme : </h3>
                    <div class="d-flex" style="gap: 10px"> 
                        @foreach ($event->programme as $index => $programme )
                        <div class="card" style="width: 18rem;">
                          <div class="card-body">
                            <h5 class="card-title">Day {{$index + 1}}</h5>
                            <p class="card-text">{{$programme}}</p>
                          </div>
                        </div>
                        @endforeach
                    </div>
                 
                </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
          <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Description</h3>
          <p class="text-muted">{{$event->description}}</p>
          <br>
          <div class="text-muted">
            <p class="text-sm">Categories : 
                <span class="d-flex ">
                    @foreach ($event->categorie as $categorie )
                    <b class="ml-2">{{$categorie}}</b>
                    @endforeach
                </span>
              
            </p>
            <p class="text-sm">Tags : 
                <span class="d-flex ">
                    @foreach ($event->tags as $tag )
                    <b class="ml-2">{{$tag}}</b>
                    @endforeach
                </span>
            </p>
            <p class="text-sm">Price : 
                <span class="d-flex ">
                    <b class="ml-2">{{$event->price}}</b> 
                </span>
            </p>
            <p class="text-sm">Adresse : 
                <span class="d-flex ">
                    <b class="ml-2">{{$event->adresse}}</b> 
                </span>
            </p>
            <p class="text-sm">City : 
                <span class="d-flex ">
                    <b class="ml-2">{{$event->city}}</b> 
                </span>
            </p>
            <p class="text-sm">Date start : 
                <span class="d-flex ">
                    <b class="ml-2">{{ \Carbon\Carbon::parse($event->date_start)->isoFormat('dddd DD MMMM YYYY H:mm') }}</b> 
                </span>
            </p>
            <p class="text-sm">Date end : 
                <span class="d-flex ">
                    <b class="ml-2">{{ \Carbon\Carbon::parse($event->date_end)->isoFormat('dddd DD MMMM YYYY H:mm') }}</b> 
                </span>
            </p>
          </div>

          <div class="text-center mt-5 mb-3">
            <a href="{{Route('home.detail' , $event->slug)}}" class="btn btn-sm btn-primary">look to event in the </a>
            <a href="" class="btn btn-sm btn-warning">Update</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->



   
@endsection
