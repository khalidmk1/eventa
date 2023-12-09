@extends('master.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-12">
                <div class="card">

                    <div class="card-body justify-content-center row m-auto ">

                        @foreach ($events as $index => $event)
                            <div class="item-container">
                                <div class="img-container">
                                    @if (in_array($extensions[$index], ['mp4', 'avi', 'mov']))
                                        <video id="myVideo_show" class="myVideo Myvideo_show" autoplay loop muted>
                                            <source id="source_video" src="{{ asset('storage/compressed/' . $event->video) }}"
                                                type="video/mp4">
                                        </video>
                                    @elseif (in_array($extensions[$index], ['jpg', 'jpeg', 'png', 'gif']))
                                        <img id="img_show" src="{{ asset('storage/compressed/' . $event->video) }}"
                                            alt="Event image">
                                    @endif


                                </div>

                                <div class="body-container">
                                    <div class="overlay"></div>

                                    <div class="event-info">
                                        <p class="title">{{ $event->title }}</p>
                                        <div class="separator"></div>
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
    </div><!-- /.container-fluid -->

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{--  <script>
        //paly with image and video hide and show
        $(document).ready(function() {
            var vid_tag = $('#img_show');
            var img_tag = $('#myVideo_show');

            $('.media-item').each(function(index, element) {

                var $element = $(element);
                var extension = $element.attr('src').split('.').pop().toLowerCase();
                console.log(extension);

                var validImageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                var validVideoExtensions = ['mp4']


                if ($.inArray(extension, validImageExtensions) == -1) {
                    img_tag.hide();
                    vid_tag.show();
                  
                } else if ($.inArray(extension, validVideoExtensions) == -1) {
                    vid_tag.hide();
                    img_tag.show();
                }
            });
        });
    </script> --}}
@endsection
