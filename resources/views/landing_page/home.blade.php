@extends('master.landign_page_home')

@section('content')
    <section class="head mb-5">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                @foreach ($events as $index => $event)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                            <video class="slide_vid w-100" autoplay loop muted>
                                <source src="{{ asset('storage/compressed/' . $event->video) }}" type="video/mp4">
                            </video>
                        @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/compressed/' . $event->video) }}" class="d-block slide_img w-100"
                                alt="...">
                        @endif

                        <div class="carousel-caption d-none d-md-block shadow-lg p-3  rounded">
                            <h1>{{ $event->title }}</h1>
                            <p>{{ $event->date }}</p>
                            <p><a href=""
                                    class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">More
                                    Info <i class="fa-solid fa-arrow-right"></i></a></p>

                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="event_card p-3 mb-4 mt-5 container">
        <h1 class="text-center pb-3"><i class="fa-solid fa-hourglass-start"></i> Events to come</h1>
        <div class="text-end mb-2"  style="position: relative ; z-index: 1000;">
            <a href="{{Route('home.event')}}"
                class="link-offset-2  link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover "><i
                    class="fa-solid fa-calendar"></i> View all Event -></a>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($events as $index => $event)
                <div class="col">
                    <div class="card h-100 shadow-lg border-0  mb-5 p-0 rounded">
                        <div class="position-relative">
                            <span class="position-absolute price">Free</span>
                            @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                                <video class="card-img-top about_vid w-100" autoplay loop muted>
                                    <source src="{{ asset('storage/compressed/' . $event->video) }}" type="video/mp4">
                                </video>
                            @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/compressed/' . $event->video) }}" class="card-img-top about_img"
                                    alt="Skyscrapers" />
                            @endif

                        </div>
                        <div class="card-body ">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">
                                {{ strlen($event->description) > 200 ? substr($event->description, 0, 200) . ' ...' : $event->description }}
                            </p>
                        </div>
                        <div class="card-footer border-0 text-center">
                            @foreach ($event->categorie as $categorie)
                            <small class="text-muted categorie-tag">{{ $categorie }}</small>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <section class="container-fluid categories mt-5 mb-4"
        style="background-image: url({{ asset('exemple/pngtree-modern-double-color-futuristic-neon-background-image_351866.jpg') }})">

        <h1 class="text-center p-3 text-light"><i class="fa-solid fa-list"></i> Categorie</h1>
        <div class="bd-example m-0 border-0 text-center">
            @foreach ($categories as $categorie)
                <button type="button" class="btn randomcolor m-2">{{ $categorie }}</button>
            @endforeach
        </div>

    </section>

    <section class="container about mt-5 mb-4">
        <h6 class="text-center">How it works</h6>
        <h1 class="text-center"><i class="fa-solid fa-mask"></i> For Costumers</h1>
        <div class="row justify-content-center">
            <div class="card border-0 mt-5" style="width: 20rem;">
                <i class="fa-solid fa-calendar-days text-center" style="font-size: 88px;"></i>
                <div class="card-body">
                    <p>
                    <h3 class="text-center">1. Choose Event</h3>
                    </p>
                    <span class="text-center">Signup, choose your favorite event </span>
                </div>
            </div>
            <div class="card border-0 mt-5" style="width: 20rem;">
                <i class="fa-solid fa-ticket text-center" style="font-size: 88px;"></i>
                <div class="card-body">
                    <p>
                    <h3 class="text-center">2. Get Ticket</h3>
                    </p>
                    <span class="text-center">Get your Ticket from the Event page</span>
                </div>
            </div>
            <div class="card border-0 mt-5" style="width: 20rem;">
                <i class="fa-solid fa-person-walking text-center" style="font-size: 88px;"></i>
                <div class="card-body">
                    <p>
                    <h3 class="text-center">3. Attend Event</h3>
                    </p>
                    <span class="text-center">Go Attend the Event and have Fun</span>
                </div>
            </div>
        </div>

    </section>


    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
@endsection
