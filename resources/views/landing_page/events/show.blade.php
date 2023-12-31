@extends('master.landign_page_home')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <section class="slid-containe container">
        <div class="message_container"></div>
        <h1 class="mt-5">last Events</h1>
        <div class="swiper mySwiper container">
            <div class="swiper-wrapper content">

                @foreach ($events as $index => $event)
                    <div class="swiper-slide card-event">
                        <div class="card-content">
                            <div class="image">
                                @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                                    <video autoplay loop muted>
                                        <source src="{{ asset('storage/event/video/' . $event->video) }}" type="video/mp4">
                                    </video>
                                @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ asset('storage/event/image/' . $event->video) }}" alt="">
                                @endif


                            </div>
                            <div class="name-profession">
                                <span class="name">{{ $event->title }}</span>
                                <div>
                                    @foreach ($event->categorie as $index => $categorie)
                                        @if ($index == 2)
                                        @break
                                    @endif
                                    <span class="profession categorie-tag ">{{ $categorie }}</span>
                                @endforeach
                            </div>
                        </div>


                        <div class="button">
                            <a href="{{ Route('home.detail', $event->slug) }}" class="hireMe">More Info -></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</section>

<section class="container-fluid">
    <div class="text-center">
        <h2 class="p-3">Events</h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Search form -->
                        <form action="{{ Route('home.event') }}" method="GET" class="row" id="search_forme">
                            <div class="d-flex flex-column col-12 ">
                                <label for="Search" class="mb-2 text-start">Search by the title</label>
                                <div
                                    class=" form-inline d-flex align-items-center gap-2 justify-content-center md-form form-sm">
                                    <input
                                        class="form-control search_input border-0 border-bottom form-control-sm mr-3 w-75 bor"
                                        type="text" placeholder="Search" aria-label="Search" id="title">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="adresse" class="mb-2 text-start w-100">Choose by City</label>
                                <select id="city"
                                    class="form-select border-0 border-bottom search_input form-select-sm "
                                    aria-label=".form-select-sm example">
                                    <option selected>City</option>
                                    @foreach ($city as $citys)
                                        <option value="{{ $citys }}">{{ $citys }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="mb-2 text-start w-100" for="categories">Categories</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="categories">
                                            @foreach ($categories as $categorie)
                                                <li><input type="checkbox" name="categories[]"
                                                        class="checked_categorie checked" data-tag="{{ $categorie }}"
                                                        id="checkboxOne_{{ $categorie }}"
                                                        value="{{ $categorie }}"><label
                                                        for="checkboxOne_{{ $categorie }}">{{ $categorie }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- sport tag section --}}
                            <div class="col-12 mt-2" id="sport_tag">
                                <label class="mb-2 text-start w-100" for="sport_tags">Sport Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="sport_tags">
                                            @foreach ($sport_tags as $sport_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $sport_tag }}"
                                                        id="checkboxOne_{{ $sport_tag }}"
                                                        value="{{ $sport_tag }}"><label
                                                        for="checkboxOne_{{ $sport_tag }}">{{ $sport_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end sport tag section --}}

                            {{-- conference tag section --}}
                            <div class="col-12 mt-2" id="Conferences_tag">
                                <label class="mb-2 text-start w-100" for="Conferences_tags">Conferences Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="Conferences_tags">
                                            @foreach ($Conferences_tags as $Conferences_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $Conferences_tag }}"
                                                        id="checkboxOne_{{ $Conferences_tag }}"
                                                        value="{{ $Conferences_tag }}"><label
                                                        for="checkboxOne_{{ $Conferences_tag }}">{{ $Conferences_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end conference tag section --}}

                            {{-- expos tag section --}}
                            <div class="col-12 mt-2" id="expos_tag">
                                <label class="mb-2 text-start w-100" for="expos_tags">Expos Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="expos_tags">
                                            @foreach ($expos_tags as $expos_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $expos_tag }}"
                                                        id="checkboxOne_{{ $expos_tag }}"
                                                        value="{{ $expos_tag }}"><label
                                                        for="checkboxOne_{{ $expos_tag }}">{{ $expos_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end expos tag section --}}

                            {{-- concerts tag section --}}
                            <div class="col-12 mt-2" id="concerts_tag">
                                <label class="mb-2 text-start w-100" for="concerts_tags">Concerts Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="concerts_tags">
                                            @foreach ($concerts_tags as $concerts_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $concerts_tag }}"
                                                        id="checkboxOne_{{ $concerts_tag }}"
                                                        value="{{ $concerts_tag }}"><label
                                                        for="checkboxOne_{{ $concerts_tag }}">{{ $concerts_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end concerts tag section --}}

                            {{-- Festivals tag section --}}
                            <div class="col-12 mt-2" id="Festivals_tag">
                                <label class="mb-2 text-start w-100" for="Festivals_tags">Festivals Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="Festivals_tags">
                                            @foreach ($Festivals_tags as $Festivals_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $Festivals_tag }}"
                                                        id="checkboxOne_{{ $Festivals_tag }}"
                                                        value="{{ $Festivals_tag }}"><label
                                                        for="checkboxOne_{{ $Festivals_tag }}">{{ $Festivals_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end Festivals tag section --}}

                            {{-- Performing arts tags section --}}
                            <div class="col-12 mt-2" id="Performing_arts_tag">
                                <label class="mb-2 text-start w-100" for="Performing_arts_tags">Performing Arts
                                    Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="Performing_arts_tags">
                                            @foreach ($Performing_arts_tags as $Performing_arts_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $Performing_arts_tag }}"
                                                        id="checkboxOne_{{ $Performing_arts_tag }}"
                                                        value="{{ $Performing_arts_tag }}"><label
                                                        for="checkboxOne_{{ $Performing_arts_tag }}">{{ $Performing_arts_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end Performing arts tags section --}}

                            {{-- Community tag section --}}
                            <div class="col-12 mt-2" id="Community_tag">
                                <label class="mb-2 text-start w-100" for="Community_tags">Community Tag</label>
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="d-flex flex-row text-start">
                                        <ul class="ks-cboxtags" id="Community_tags">
                                            @foreach ($Community_tags as $Community_tag)
                                                <li><input type="checkbox" name="tags[]" class="checked checked_tag"
                                                        data-tag="{{ $Community_tag }}"
                                                        id="checkboxOne_{{ $Community_tag }}"
                                                        value="{{ $Community_tag }}"><label
                                                        for="checkboxOne_{{ $Community_tag }}">{{ $Community_tag }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- end Community tag section --}}

                            <button type="submit" class="btn btn-dark w-25 m-auto">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row row-cols-1 row-cols-md-3 g-4 event_conatine">
                    @foreach ($events as $index => $event)
                        <div class="col all_content">
                            <div class="card h-100 shadow-lg border-0  mb-5 p-0 rounded">
                                <div class="position-relative">
                                    <form action="{{ Route('home.folow', $event->slug) }}" method="post"
                                        data-id="{{ $event->id }}" class="event_folow">
                                        @csrf

                                        @if (auth()->check())
                                            @if ($confirmedFolows->has($event->id))
                                                <i class="fa-solid fa-heart position-absolute p-2"
                                                    id="heart_{{ $event->id }}"
                                                    style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                                            @else
                                                <i class="fa-regular fa-heart position-absolute p-2"
                                                    id="heart_{{ $event->id }}"
                                                    style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                                            @endif
                                        @else
                                            <i class="fa-regular fa-heart position-absolute p-2"
                                                id="heart_{{ $event->id }}"
                                                style="right: 0 ; font-size: 30px ; color: red ; z-index: 1000;"></i>
                                        @endif

                                    </form>
                                    @if ($event->price == 'free')
                                        <span class="position-absolute price">{{ $event->price }}</span>
                                    @else
                                        <span class="position-absolute price">{{ $event->price }} DH</span>
                                    @endif

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
        </div>
    </div>
</div>
</section>



<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // slider 
    var screenWidth = window.innerWidth;

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: screenWidth < 576 ? 1 : (screenWidth <= 768 ? 3 : 3),
        spaceBetween: 30,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@endsection
