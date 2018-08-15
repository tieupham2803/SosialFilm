@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="postcontent nobottommargin clearfix">
                    <div class="single-post nobottommargin">

                        <div class="entry clearfix">

                            <div class="entry-title">
                                <h2>{{ $review->title }}</h2>
                            </div>

                            <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i> {{ $review->created_at }}</li>
                                <li><a href="#"><i class="icon-user"></i> {{ $username }}</a></li>
                                <li><i class="fa fa-film"></i> <a href="#">{{ $movie->title }}</a></li>
                                <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li>
                                <li><a href="#"><i class="icon-like"></i> {{ $like }} Likes</a></li>
                            </ul>
                            <div class="entry-image">
                                <a href="#"><img src="{{ asset($movie->poster) }}" alt="Blog Single"></a>
                            </div>

                            <div class="entry-content notopmargin">
                                <p>{!! $review->content !!}</p>
                                @if (!Auth::guest())
                                    @if (empty($likeUser))
                                    <div class="btn btn-outline-info clearfix bottommargin " id = "like-btn">
                                        <a href="{{ route('like', ['id' => $review->id]) }}">
                                            <span class="fa fa-thumbs-up">{{ trans('message.like') }}</span>
                                        </a>
                                    </div>
                                    @else
                                    <div class=" clearfix bottommargin btn btn-outline-danger  " id = "like-btn">
                                        <a href="{{ route('like', ['id' => $review->id]) }}">
                                            <span class="fa fa-thumbs-down">{{ trans('message.unlike') }}</span>
                                        </a>
                                    </div>
                                    @endif
                                @else
                                    <div class="btn btn-outline-info clearfix bottommargin " id = "like-btn">
                                        <a href="">
                                            <span class= "fa fa-thumbs-up">({{ $like }})</span>
                                        </a>
                                        <span> {{ trans('message.like') }}</span>
                                    </div>
                                    <div class="clearfix bottommargin alert alert-primary ">
                                        <span> {{ trans('message.likeforguest') }}</span>
                                    </div>
                                @endif
                                <div class="clear"></div>

                                <div class="si-share noborder clearfix">
                                    <span>Share this Post:</span>
                                    <div>
                                        <a href="#" class="social-icon si-borderless si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="#" class="social-icon si-borderless si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-navigation clearfix">
                            <div class="col_half nobottommargin">
                                <a href="#">&lArr; This is a Standard post with a Slider Gallery</a>
                            </div>
                            <div class="col_half col_last tright nobottommargin">
                                <a href="#">This is an Embedded Audio Post &rArr;</a>
                            </div>
                        </div>
                        <div class="line"></div>

                        <div class="card">
                            <div class="card-header"><strong>Posted by <a href="#">John Doe</a></strong></div>
                            <div class="card-body">
                                <div class="author-image">
                                    <img src="images/author/1.jpg" alt="" class="rounded-circle">
                                </div>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eveniet, eligendi et nobis neque minus mollitia sit repudiandae ad repellendus recusandae blanditiis praesentium vitae ab sint earum voluptate velit beatae alias fugit accusantium laboriosam nisi reiciendis deleniti tenetur molestiae maxime id quaerat consequatur fugiat aliquam laborum nam aliquid. Consectetur, perferendis?
                            </div>
                        </div>
                        <div class="line"></div>
{{--COMMENT BEGINS--}}
                        <div id="comments" class="clearfix">
                            {{--<h3 id="comments-title"><span>3</span> Comments</h3>--}}
                            <h3 id="comments-title"></h3>
                            @if (Auth::check())
                                <div id="respond" class="clearfix">
                                    <div class="container">
                                        {{ Form::open(['method' => 'POST', 'id' => 'comment_form', 'route' => 'comment.add', 'class' => 'clearfix']) }}
                                        <div class="form-group">
                                            {{ Form::text('content', null, ['id' => 'content', 'class' => 'form-control form-control-custom', 'placeholder' => 'Enter comment', 'autocomplete' => 'off', 'onfocus' => 'this.value=\'\'']) }}
                                            {{ Form::hidden('is_reply_to', 0, ['id' => 'is_reply_to']) }}
                                            {{ Form::hidden('review_id', $review->id, ['id' => 'review_id']) }}
                                            {{ Form::submit( __('Submit'), ['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-info display-none']) }}
                                        </div>
                                        {{ Form::close() }}
                                        <br />
                                    </div>
                                </div>
                            @else
                                <p>You need to <a href="{{ url('login') }}">login</a> to comment</p>
                            @endif

                            <ol class="commentlist clearfix" id="display-comment">
                                <li class="comment even thread-even depth-1" id="li-comment-1">
                                    <div id="comment-1" class="comment-wrap clearfix">
                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
<span class="comment-avatar clearfix">
<img alt='' src='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' class='avatar avatar-60 photo avatar-default' height='60' width='60' /></span>
                                            </div>
                                        </div>
                                        <div class="comment-content clearfix">
                                            <div class="comment-author">John Doe<span><a href="#" title="Permalink to this comment">April 24, 2012 at 10:46 am</a></span></div>
                                            <p>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                                            <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <ul class='children'>
                                        <li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">
                                            <div id="comment-3" class="comment-wrap clearfix">
                                                <div class="comment-meta">
                                                    <div class="comment-author vcard">
<span class="comment-avatar clearfix">
<img alt='' src='http://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=40&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D40&amp;r=G' class='avatar avatar-40 photo' height='40' width='40' /></span>
                                                    </div>
                                                </div>
                                                <div class="comment-content clearfix">
                                                    <div class="comment-author"><a href='#' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>
                                                    <p>Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">
                                    <div id="comment-2" class="comment-wrap clearfix">
                                        <div class="comment-meta">
                                            <div class="comment-author vcard">
<span class="comment-avatar clearfix">
<img alt='' src='http://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G' class='avatar avatar-60 photo' height='60' width='60' /></span>
                                            </div>
                                        </div>
                                        <div class="comment-content clearfix">
                                            <div class="comment-author"><a href='http://themeforest.net/user/semicolonweb' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>
                                            <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                                            <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                            </ol>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

                <div class="sidebar nobottommargin col_last clearfix">
                    <div class="sidebar-widgets-wrap">
                        <div class="widget widget-twitter-feed clearfix">
                            <h4>Facebook Feed</h4>
                            <ul class="iconlist twitter-feed" data-username="envato" data-count="2">
                                <li></li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-sm fright">Follow Us on Facebook</a>
                        </div>
                        <div class="widget clearfix">
                            <h4>Other Images</h4>
                            <div id="flickr-widget" class="flickr-feed masonry-thumbs" data-id="613394@N22" data-count="16" data-type="group" data-lightbox="gallery"></div>
                        </div>
                        <div class="widget clearfix">
                            <div class="tabs nobottommargin clearfix" id="sidebar-tabs">
                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1">Popular</a></li>
                                    <li><a href="#tabs-2">Recent</a></li>
                                    <li><a href="#tabs-3"><i class="icon-comments-alt norightmargin"></i></a></li>
                                </ul>
                                <div class="tab-container">
                                    <div class="tab-content clearfix" id="tabs-1">
                                        <div id="popular-post-list-sidebar">
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/magazine/small/3.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li><i class="icon-comments-alt"></i> 35 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/magazine/small/2.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li><i class="icon-comments-alt"></i> 24 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/magazine/small/1.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li><i class="icon-comments-alt"></i> 19 Comments</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-2">
                                        <div id="recent-post-list-sidebar">
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/magazine/small/1.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li>10th July 2014</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/magazine/small/2.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li>10th July 2014</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/magazine/small/3.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li>10th July 2014</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-3">
                                        <div id="recent-post-list-sidebar">
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/icons/avatar.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <strong>John Doe:</strong> Veritatis recusandae sunt repellat distinctio...
                                                </div>
                                            </div>
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/icons/avatar.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <strong>Mary Jane:</strong> Possimus libero, earum officia architecto maiores....
                                                </div>
                                            </div>
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="#" class="nobg"><img class="rounded-circle" src="images/icons/avatar.jpg" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <strong>Site Admin:</strong> Deleniti magni labore laboriosam odio...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <h4>Portfolio Carousel</h4>
                            <div id="oc-portfolio-sidebar" class="owl-carousel carousel-widget" data-items="1" data-margin="10" data-loop="true" data-nav="false" data-autoplay="5000">
                                <div class="oc-item">
                                    <div class="iportfolio">
                                        <div class="portfolio-image">
                                            <a href="#">
                                                <img src="images/portfolio/4/3.jpg" alt="Mac Sunglasses">
                                            </a>
                                            <div class="portfolio-overlay">
                                                <a href="http://vimeo.com/89396394" class="center-icon" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                            </div>
                                        </div>
                                        <div class="portfolio-desc center nobottompadding">
                                            <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>
                                            <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="oc-item">
                                    <div class="iportfolio">
                                        <div class="portfolio-image">
                                            <a href="portfolio-single.html">
                                                <img src="images/portfolio/4/1.jpg" alt="Open Imagination">
                                            </a>
                                            <div class="portfolio-overlay">
                                                <a href="images/blog/full/1.jpg" class="center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                            </div>
                                        </div>
                                        <div class="portfolio-desc center nobottompadding">
                                            <h3><a href="portfolio-single.html">Open Imagination</a></h3>
                                            <span><a href="#">Media</a>, <a href="#">Icons</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <h4>Tag Cloud</h4>
                            <div class="tagcloud">
                                <a href="#">general</a>
                                <a href="#">videos</a>
                                <a href="#">music</a>
                                <a href="#">media</a>
                                <a href="#">photography</a>
                                <a href="#">parallax</a>
                                <a href="#">ecommerce</a>
                                <a href="#">terms</a>
                                <a href="#">coupons</a>
                                <a href="#">modern</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="dark">
        <div class="container">

            <div class="footer-widgets-wrap clearfix">
                <div class="col_two_third">
                    <div class="col_one_third">
                        <div class="widget clearfix">
                            <img src="images/footer-widget-logo.png" alt="" class="footer-logo">
                            <p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp;
                                <strong>Flexible</strong> Design Standards.</p>
                            <div style="background: url('images/world-map.png') no-repeat center center; background-size: 100%;">
                                <address>
                                    <strong>Headquarters:</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                </address>
                                <abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
                                <abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
                                <abbr title="Email Address"><strong>Email:</strong></abbr> <span class="__cf_email__"
                                                                                                 data-cfemail="a6cfc8c0c9e6c5c7c8d0c7d588c5c9cb">[email&#160;protected]</span>
                            </div>
                        </div>
                    </div>
                    <div class="col_one_third">
                        <div class="widget widget_links clearfix">
                            <h4>Blogroll</h4>
                            <ul>
                                <li><a href="http://codex.wordpress.org/">Documentation</a></li>
                                <li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>
                                <li><a href="http://wordpress.org/extend/plugins/">Plugins</a></li>
                                <li><a href="http://wordpress.org/support/">Support Forums</a></li>
                                <li><a href="http://wordpress.org/extend/themes/">Themes</a></li>
                                <li><a href="http://wordpress.org/news/">WordPress Blog</a></li>
                                <li><a href="http://planet.wordpress.org/">WordPress Planet</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col_one_third col_last">
                        <div class="widget clearfix">
                            <h4>Recent Posts</h4>
                            <div id="post-list-footer">
                                <div class="spost clearfix">
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li>10th July 2014</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="spost clearfix">
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li>10th July 2014</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="spost clearfix">
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                        </div>
                                        <ul class="entry-meta">
                                            <li>10th July 2014</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col_one_third col_last">
                    <div class="widget clearfix" style="margin-bottom: -20px;">
                        <div class="row">
                            <div class="col-lg-6 bottommargin-sm">
                                <div class="counter counter-small"><span data-from="50" data-to="15065421"
                                                                         data-refresh-interval="80" data-speed="3000"
                                                                         data-comma="true"></span></div>
                                <h5 class="nobottommargin">Total Downloads</h5>
                            </div>
                            <div class="col-lg-6 bottommargin-sm">
                                <div class="counter counter-small"><span data-from="100" data-to="18465"
                                                                         data-refresh-interval="50" data-speed="2000"
                                                                         data-comma="true"></span></div>
                                <h5 class="nobottommargin">Clients</h5>
                            </div>
                        </div>
                    </div>
                    <div class="widget subscribe-widget clearfix">
                        <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp;
                            Inside Scoops:</h5>
                        <div class="widget-subscribe-form-result"></div>
                        <form id="widget-subscribe-form"
                              action="http://themes.semicolonweb.com/html/canvas/include/subscribe.php" role="form"
                              method="post" class="nobottommargin">
                            <div class="input-group divcenter">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="icon-email2"></i></div>
                                </div>
                                <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email"
                                       class="form-control required email" placeholder="Enter your Email">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="widget clearfix" style="margin-bottom: -20px;">
                        <div class="row">
                            <div class="col-lg-6 clearfix bottommargin-sm">
                                <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin"
                                   style="margin-right: 10px;">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#">
                                    <small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on
                                        Facebook
                                    </small>
                                </a>
                            </div>
                            <div class="col-lg-6 clearfix">
                                <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin"
                                   style="margin-right: 10px;">
                                    <i class="icon-rss"></i>
                                    <i class="icon-rss"></i>
                                </a>
                                <a href="#">
                                    <small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS
                                        Feeds
                                    </small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="copyrights">
            <div class="container clearfix">
                <div class="col_half">
                    Copyrights &copy; 2014 All Rights Reserved by Canvas Inc.<br>
                    <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
                </div>
                <div class="col_half col_last tright">
                    <div class="fright clearfix">
                        <a href="#" class="social-icon si-small si-borderless si-facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-twitter">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-gplus">
                            <i class="icon-gplus"></i>
                            <i class="icon-gplus"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-pinterest">
                            <i class="icon-pinterest"></i>
                            <i class="icon-pinterest"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-vimeo">
                            <i class="icon-vimeo"></i>
                            <i class="icon-vimeo"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-github">
                            <i class="icon-github"></i>
                            <i class="icon-github"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-yahoo">
                            <i class="icon-yahoo"></i>
                            <i class="icon-yahoo"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-linkedin">
                            <i class="icon-linkedin"></i>
                            <i class="icon-linkedin"></i>
                        </a>
                    </div>
                    <div class="clear"></div>
                    <i class="icon-envelope2"></i> <span class="__cf_email__"
                                                         data-cfemail="3c55525a537c5f5d524a5d4f125f5351">[email&#160;protected]</span>
                    <span class="middot">&middot;</span> <i class="icon-headphones"></i> +91-11-6541-6369 <span
                            class="middot">&middot;</span> <i class="icon-skype2"></i> CanvasOnSkype
                </div>
            </div>
        </div>
    </footer>

    <div id="gotoTop" class="icon-angle-up"></div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#comment_form').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ url('comment/store') }}",
                    method: 'POST',
                    data: form_data,
                    dataType: 'JSON',
                    success: function(data)
                    {
                        load_comment();
                        $('#comment_form')[0].reset();
                    }
                })
            });
            $('#reply_submit').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('comment/store') }}",
                    method: 'POST',
                    data: form_data,
                    dataType: 'JSON',
                    success: function(data)
                    {
                        load_comment();
                        $('#reply_form')[0].reset();
                    }
                })
            });

            load_comment();
            function load_comment()
            {
                var i;
                var html = '';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('comment/fetch') }}",
                    data:
                        {
                            review_id: window.location.pathname.split('/').slice(-1).pop(),
                        },
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(data)
                    {
                        //0 = email
                        //1 = created_at
                        //2 = content
                        //3 = comment_id
                        //4 = avatar
                        $('#comments-title').html('<span>'+ data.length + '</span> Comments');
                        for (i = 0; i < data.length; i++) {
                            html += '<li id="li-comment-' + data[i][3] + '">' +
                                '<div id="comment-' + data[i][3] + '" class="comment-wrap clearfix">' +
                                '<div class="comment-meta">' +
                                '<div class="comment-author vcard">' +
                                '<span class="comment-avatar clearfix">' +
                                '<img alt=\'\' src=\'' + data[i][4] + '\' class=\'avatar avatar-60 photo\' height=\'60\' width=\'60\' />' +
                                '</span>' +
                                '</div>' +
                                '</div>' +
                                '<div class="comment-content clearfix">' +
                                '<div class="comment-author"><a>' + data[i][0] + '</a><span><a>' + data[i][1] + '</a></span></div>' +
                                '<p>' + data[i][2] + '</p>' +
                                '<a class="comment-reply-link"><i id="' + data[i][3] + '" class="icon-reply"></i></a>' +
                                '</div>' +
                                '<div class="clear"></div>' +
                                '</div>' +
                                '<div id="display-reply-' + data[i][3] + '" class="display-none reply">' +
                                '</li>';
                        }
                        $('#display-comment').html(html);
                    }
                })
            }

            $(document).on('click', '.icon-reply', function (){
                var id = $(this).attr("id");
                var review_id = window.location.pathname.split('/').slice(-1).pop();
                var html = '';

                html += '<div class="container">' +
                    '    <form method="POST" action="{{ route('comment.add') }}" id="reply_form" class="clearfix">' +
                    '@csrf' +
                    '        <div class="form-group">' +
                    '            <input id="reply-content-' + id + '" class="form-control form-control-custom reply-box" autocomplete="off" placeholder="Enter reply" name="content" type="text">' +
                    '            <input id="is_reply_to" name="is_reply_to" type="hidden" value="' + id + '">' +
                    '            <input name="review_id" type="hidden" value="'+ review_id +'">' +
                    '            <input name="submit" id="reply_submit" class="btn btn-info display-none" type="submit" value="Reply">' +
                    '        </div>' +
                    '    </form>' +
                    '</div>';
                $('#display-reply-' + id).html(html).toggleClass('display-none');
                $('.reply-box:not(#reply-content-' + id + ')').hide();
            });
        });
    </script>
@endsection

