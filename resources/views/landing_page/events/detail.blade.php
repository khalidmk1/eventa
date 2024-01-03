@extends('master.landign_page_home')

@section('content')
    <div class="container mt-3 text-center">

        <div class="row">

            <div class="col-sm-8 mb-3">
                <div class="message_container mb-2"></div>
                <div class="card shadow  bg-body-tertiary">
                    @if (in_array($extension, ['mp4', 'avi', 'mov']))
                        <video autoplay loop muted class="asset-detail">
                            <source src="{{ asset('storage/event/video/' . $event->video) }}" type="video/mp4">
                        </video>
                    @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                        <img src="{{ asset('storage/event/image/' . $event->video) }}" class="card-img-top asset-detail"
                            alt="event-asset">
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 d-flex align-items-center justify-content-between">
                                <h2 class="text-start">{{ $event->title }}
                                    @foreach ($event->categorie as $categorie)
                                        <span class="categorie-tag" style="font-size: 20px ">{{ $categorie }}</span>
                                    @endforeach
                                </h2>

                                <h4 class="m-0">{{ $event->price }} DH</h4>
                            </div>
                            <div class="col-md-12 col-sm-12 d-flex gap-2 justify-content-end">
                                @if (auth()->check())
                                    @if ($confirmedFolows->has($event->id) || $existsFolows === false)
                                        <form action="{{ Route('home.folow', $event->slug) }}" method="post"
                                            data-id="{{ $event->id }}" class="event_folow">
                                            @csrf
                                            <button type="button" class="btn btn-outline-dark folow_btn"><i
                                                    class="fa-solid fa-heart" id="heart_{{ $event->id }}"></i>
                                                suivi</button>
                                        </form>
                                    @endif
                                @else
                                    <form action="{{ Route('home.folow', $event->slug) }}" method="post"
                                        data-id="{{ $event->id }}" class="event_folow">
                                        @csrf
                                        <button type="button" class="btn btn-outline-dark"><i class="fa-solid fa-heart"
                                                id="heart_{{ $event->id }}"></i>
                                            suivi</button>
                                    </form>
                                @endif
                                <button type="button" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i>
                                    participate</button>
                            </div>

                        </div>

                        <p class="card-text">{{ $event->description }}</p>
                        <h4>Date : <span>{{ $event->date_start }}</span></h4>

                        <h4 class="text-start">Programme :</h4>
                        <div class="row gap-2">
                            @foreach ($event->programme as $index => $programme)
                                <div class="card border-primary mb-3 col-sm">
                                    <div class="card-header">Day : {{ $index + 1 }}</div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $programme }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <h4 class="text-start">Tags : </h4>
                        <div class="bd-example m-0 border-0 text-start">
                            @foreach ($event->categorie as $categorie)
                                <button type="button" class="btn randomcolor m-2 ">{{ $categorie }}</button>
                            @endforeach
                        </div>


                    </div>
                </div>

            </div>

            <div class="col-sm-4">
                <div class="message_container_user mb-2"></div>
                <div class="card shadow p-1 bg-body-tertiary">
                    <form action="{{ Route('home.folow.user', $event->user->slug) }}" method="post" class="user_folow"
                        data-id="{{ $event->user->id }}">
                        @csrf
                        @if (auth()->check())
                            @if ($confirmedFolowsuser)
                            <i class="fa-solid fa-heart position-absolute p-2" id="heart_{{ $event->user->id }}"
                                style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                            @else
                            <i class="fa-regular fa-heart position-absolute p-2" id="heart_{{ $event->user->id }}"
                                style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                            @endif
                        @else
                            <i class="fa-regular fa-heart position-absolute p-2" id="heart_{{ $event->user->id }}"
                                style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                        @endif
                    </form>
                    <div class="card-body">

                        <img src="{{ asset('storage/avatars/' . $event->user->image) }}"
                            class="rounded-circle w-50 shadow p-1 bg-body-tertiary rounded " style="height: 180px;"
                            alt="Avatar">
                        <h5 class="card-title mt-3">{{ $event->user->first_name . ' ' . $event->user->last_name }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $event->user->organization_name }}</h6>
                        <p class="card-text"><i class="fa-solid fa-phone"></i> {{ $event->user->phone }}</p>
                        <p class="card-text"><a href="{{ $event->user->organization_link }}"
                                class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                <i class="fa-solid fa-link"></i> website</a></p>

                        <a type="button" href="{{ Route('home.profile', $event->user->slug) }}"
                            class="btn btn-light btn-outline-secondary"> Profile</a>



                    </div>
                </div>
            </div>
        </div>
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    @endsection
