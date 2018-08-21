@extends('layouts.app')

@section('content')
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="heading-block center">
                    <h1>{{ __('Hot Films') }}</h1>
                    <span>{{ __('Caption') }}</span>
                </div>
                @if (count($arrMovies)<6)
                    <div id="posts" class="post-grid grid-container grid-3 clearfix" data-layout="fitRows">
                        {{--Hot Films--}}
                        @foreach ($movies as $movie)
                            <div class="entry clearfix">
                                <div class="entry-image">
                                    <a href="{{ $movie->poster }}" data-lightbox="image"><img class="image_fade" src="{{ $movie->poster }}" alt="Standard Post with Image"></a>
                                </div>
                                <div class="entry-title">
                                    <h2><a href="#">{{ $movie->title }}</a></h2>
                                </div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> {{ $movie->realease_date }}</li>
                                </ul>
                                <div class="entry-content">
                                    <p>{{ $movie->overview }}</p>
                                    <a href="#" class="more-link">{{ __('Review This Film Now') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div id="carouselExampleIndicators" class="carousel slide margin-bottom-100" data-ride="carousel">
                        <div class="carousel-inner">
                            @for ($i = 0; $i < count($arrMovies); $i++)
                                @if ($i == 0)
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-4"><a href="#"><img class="d-block w-100" src="{{ $arrMovies[$i]['poster'] }}" alt="Second slide"></a></div>
                                            <div class="col-md-4"><a href="#"><img class="d-block w-100" src="{{ $arrMovies[$i+1]['poster'] }}" alt="Second slide"></a></div>
                                            <div class="col-md-4"><a href="#"><img class="d-block w-100" src="{{ $arrMovies[$i+2]['poster'] }}" alt="Second slide"></a></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-md-4"><a href="#"><img class="d-block w-100" src="{{ $arrMovies[$i]['poster'] }}" alt="Second slide"></a></div>
                                            <div class="col-md-4"><a href="#"><img class="d-block w-100" src="{{ $arrMovies[$i+1]['poster'] }}" alt="Second slide"></a></div>
                                            <div class="col-md-4"><a href="#"><img class="d-block w-100" src="{{ $arrMovies[$i+2]['poster'] }}" alt="Second slide"></a></div>
                                        </div>
                                    </div>
                                @endif
                                <?php $i += 2 ?>
                            @endfor
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @endif

                <div class="heading-block center">
                    <h1>{{ __('Hot Reviews') }}</h1>
                    <span>{{ __('Caption') }}</span>
                </div>
                <div id="posts" class="post-grid grid-container grid-3 clearfix" data-layout="fitRows">
                    {{--Hot Reviews--}}
                    @foreach ($reviews as $review)
                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="{{ $review->poster }}" data-lightbox="image"><img class="image_fade" src="{{ $review->poster }}" alt="Standard Post with Image"></a>
                            </div>
                            <div class="entry-title">
                                <h2><a href="{!! route('reviews.show', 1) !!}">{{ $review->title }}</a></h2>
                            </div>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i> {{ $review->created_at }}</li>
                                <li><a href="#"><i class="icon-comments"></i> 13</a></li>
                                <li><a href="#"><i class="icon-like"></i> {{ $review->like }}</a></li>
                            </ul>
                            <div class="entry-content fixed-height">
                                <p>
                                    {!! str_limit(strip_tags($review->content), 400) !!}
                                    <a href="{{ route('reviews.show', $review->id) }}" class="more-link">{{ __('Read More') }}</a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($sortReviews as $review)
                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="{{ $review['poster'] }}" data-lightbox="image"><img class="image_fade" src="{{ $review['poster'] }}" alt="Standard Post with Image"></a>
                            </div>
                            <div class="entry-title">
                                <h2><a href="{!! route('reviews.show', 1) !!}">{{ $review['title'] }}</a></h2>
                            </div>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i> {{ $review['created_at'] }}</li>
                                <li><a href="#"><i class="icon-comments"></i> 13</a></li>
                                <li><a href="#"><i class="icon-like"></i> {{ $review['like'] }}</a></li>
                            </ul>
                            <div class="entry-content fixed-height">
                                <p>
                                    {!! str_limit(strip_tags($review['content']), 400) !!}
                                    <a href="{{ route('reviews.show', $review['id']) }}" class="more-link">{{ __('Read More') }}</a>
                                </p>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{--Load more with scroll--}}
                <div id="loadMore"></div>
            </div>
        </div>
        </div>
    </section>

    <div id="gotoTop" class="icon-angle-up"></div>
@endsection

@section('script')
    <script type="text/javascript">
        function str_limit(value) {
            var str = '';
            if (value.length > 400) {
                str = value.substring(0,400);
            }
            return str;
        }
        var is_busy = false;
        var page = 0;
        var stopped = false;
        $(document).ready(function()
        {
            $(window).scroll(function()
            {
                if($(window).scrollTop() == $(document).height() - $(window).height())
                {
                    if (is_busy == true){
                        return false;
                    }
                    if (stopped == true){
                        return false;
                    }
                    is_busy = true;
                    page++;
                    $.ajax(
                        {
                            type: 'get',
                            url: '/loadMore',
                            data: {page : page},
                            success : function (result)
                            {
                                console.log(result);
                                var htmlResult = '<div id="posts" class="post-grid grid-container grid-3 clearfix" data-layout="fitRows">';
                                result.forEach(function (item) {
                                    htmlResult += '<div class="entry clearfix">';
                                    htmlResult += '<div class="entry-image"><a href="' + item['poster'] + '" data-lightbox="image">';
                                    htmlResult += '<img class="image_fade" src="' + item['poster'] + '" alt="Standard Post with Image"></a></div>';
                                    htmlResult += '<div class="entry-title"><h2><a href="#">' + item['title'] + '</a></h2></div>';
                                    htmlResult += '<ul class="entry-meta clearfix">';
                                    htmlResult += '<li><i class="icon-calendar3"></i>' + item['created_at'] + '</li>';
                                    htmlResult += '<li><a href="#"><i class="icon-comments"></i> 13</a></li>';
                                    htmlResult += '<li><a href="#"><i class="icon-like"></i>' + item['like'] + '</a></li></ul>';
                                    htmlResult += '<div class="entry-content fixed-height"><p>' + str_limit(item['content']) + '</p>';
                                    htmlResult += '<a href="/reviews/' + item['id'] + '" class="more-link">{{ __('Read More') }}</a></div>';
                                    htmlResult += '</div>';
                                });
                                htmlResult += '</div>';
                                $('#loadMore').append(htmlResult);
                            }
                        })
                        .always(function()
                        {
                            is_busy = false;
                        });
                    return false;
                }
            });
        });
    </script>
@endsection
