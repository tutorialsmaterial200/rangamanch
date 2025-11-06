<section>


    <div class="popular__section-news">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-12">
                    <div class="section-heading d-flex justify-content-between align-items-center mb-2">
                        <h2 class=" post-title">{{ __('frontend.recent post') }}</h2>

                        <!-- <a href="{{ route('video-gallery') }}" 
                        {{ __('frontend.view all') }}
                    </a> -->
                    </div>

                    <div class="row ">
                        @foreach ($recentNews as $news)
                        @if ($loop->index <= 1)
                            <div class="col-sm-12 col-md-6 mb-4">
                            <!-- Post Article -->
                            <div class="card__post ">
                                <div class="card__post__body card__post__transition">
                                    <a href="{{ route('news-details', $news->slug) }}">
                                        <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                    </a>
                                    <div class="card__post__content bg__post-cover">
                                        <div class="card__post__category">
                                            {{ $news->category->name }}
                                        </div>
                                        <div class="card__post__title">
                                            <h5>
                                                <a href="{{ route('news-details', $news->slug) }}">
                                                    {!! truncate($news->title) !!}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="card__post__author-info">
                                            <ul class="list-inline">
                                                <!-- <li class="list-inline-item">
                                                    <a href="blog_details.html">
                                                        {{ __('frontend.by') }} {{ $news->auther->name }}
                                                    </a>
                                                </li> -->
                                                <li class="list-inline-item">
                                                    <span>

                                                        {{ getNepaliShortDate($news->created_at) }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                    @endif
                    @endforeach

                </div>
                <div class="row ">
                    <div class="col-sm-12 col-md-6">
                        <div class="wrapp__list__article-responsive">
                            @foreach ($recentNews as $news)
                            @if ($loop->index > 1 && $loop->index <= 3)
                                <div class="mb-3">
                                <!-- Post Article -->
                                <div class="card__post card__post-list">
                                    <div class="image-sm">
                                        <a href="{{ route('news-details', $news->slug) }}">
                                            <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                        </a>
                                    </div>


                                    <div class="card__post__body ">
                                        <div class="card__post__content">

                                            <div class="card__post__author-info mb-2">
                                                <ul class="list-inline">
                                                    <!-- <li class="list-inline-item">
                                                        <span class="text-primary">
                                                            {{ __('frontend.by') }} {{ $news->auther->name }}
                                                        </span>
                                                    </li> -->
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                            {{ getNepaliShortDate($news->created_at) }}
                                                        </span>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="card__post__title">
                                                <h6>
                                                    <a href="{{ route('news-details', $news->slug) }}">
                                                        {!! truncate($news->title) !!}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <div class="wrapp__list__article-responsive">
                        @foreach ($recentNews as $news)
                        @if ($loop->index > 3 && $loop->index <= 5)
                            <div class="mb-3">
                            <!-- Post Article -->
                            <div class="card__post card__post-list">
                                <div class="image-sm">
                                    <a href="{{ route('news-details', $news->slug) }}">
                                        <img src="{{ asset($news->image) }}" class="img-fluid" alt="">
                                    </a>
                                </div>


                                <div class="card__post__body ">
                                    <div class="card__post__content">

                                        <div class="card__post__author-info mb-2">
                                            <ul class="list-inline">
                                                <!-- <li class="list-inline-item">
                                                    <span class="text-primary">
                                                        {{ __('frontend.by') }} {{ $news->auther->name }}
                                                    </span>
                                                </li> -->
                                                <li class="list-inline-item">
                                                    <span class="text-dark text-capitalize">
                                                        {{ getNepaliShortDate($news->created_at) }}
                                                    </span>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="card__post__title">
                                            <h6>
                                                <a href="{{ route('news-details', $news->slug) }}">
                                                    {!! truncate($news->title) !!}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!-- Right Sidebar -->

    <div>
        <aside class="wrapper__list__article">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading d-flex justify-content-between align-items-center mb-2">
                        <h2 class="post-title">समाचार</h2>
                        <a href="{{ route('news', ['category' => 'samacara']) }}" class="btn btn-outline-primary btn-sm">
                            {{ __('frontend.view all') }}
                        </a>
                        <!-- <a href="{{ route('video-gallery') }}" 
                        {{ __('frontend.view all') }}
                    </a> -->
                    </div>
                </div>
            </div>
            <div class="container my-2">
                <div class="row justify-content-start">
                    <div class="col-lg-10">

                        <!-- News Card -->
                        <div class="card news-card border-0">
                            <div class="row g-0 align-items-center">
                                @foreach($categorySectionOne as $news)
                                @if ($loop->index <= 0)
                                    <!-- Image Column (Left) -->
                                    <div class="col-md-6">
                                        <a href="{{ route('news-details', $news->slug) }}">
                                            <img src="{{ asset($news->image) }}" class="img-fluid" alt="{{ $news->title }}">
                                        </a>
                                    </div>

                                    <!-- Text Column (Right) -->
                                    <div class="col-md-6">
                                        <div class="card-body p-4 p-md-5">
                                            <h1 class="post-title">
                                                <a href="{{ route('news-details', $news->slug) }}">
                                                    {!! truncate($news->title,100) !!}
                                                </a>
                                            </h1>
                                            <p class="news-body">
                                                @php
                                                // Strip HTML and decode HTML entities
                                                $text = html_entity_decode(strip_tags($news->content), ENT_QUOTES, 'UTF-8');

                                                // Split text into words considering Unicode characters
                                                $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);

                                                // Get first 15 words
                                                $limitedWords = array_slice($words, 0, 30);

                                                // Join words with space and add ellipsis if needed
                                                $content = implode(' ', $limitedWords);
                                                if (count($words) > 15) {
                                                $content .= '...';
                                                }

                                                // Ensure proper UTF-8 encoding
                                                $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
                                                @endphp
                                                {!! $content !!}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if ($ad->home_middle_ad_status == 1)

            <div class="small_add_banner">
                <div class="small_add_banner_img">
                    <a href="{{ $ad->home_middle_ad_url }}">
                        <img src="{{ asset($ad->home_middle_ad) }}" alt="adds">
                    </a>
                </div>
            </div>
            @endif

            <div class="container px-0 mt-3">
                <div class="row g-3">
                    @foreach($categorySectionOne as $news)
                    @if ($loop->index > 1 && $loop->index <= 5)
                        <div class="col-6 col-md-4 col-lg-3">
                        <div class="card__post card__post-uniform">
                            <div class="card__post__thumb">
                                <a href="{{ route('news-details', $news->slug) }}">
                                    <img src="{{ asset($news->image) }}" class="img-fluid" alt="{{ $news->title }}">
                                </a>
                            </div>

                            <div class="text-primary">
                                <h5 class="text-primary">
                                    <a href="{{ route('news-details', $news->slug) }}" class="text-black text-decoration-none" style="display: block; font-size: 15px; color: black;">
                                        {!! truncate($news->title, 60) !!}
                                    </a>
                                </h5>
                                <ul class="list-inline">

                                    <li class="list-inline-item" style="display: block; font-size: 10px; color: black;">
                                        <span>
                                            {{ getNepaliShortDate($news->created_at) }}
                                        </span>
                                    </li>

                                </ul>


                            </div>
                        </div>
                </div>
                @endif
                @endforeach
            </div>
    </div>

    </div>
    </aside>

    </div>




    <!-- Post news carousel -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <aside class="section-heading d-flex justify-content-between align-items-center mb-3">
                    <h2 class="post-title">मनोरंजन</h2>
                </aside>
            </div>
            <div class="col-md-12">

                <div class="article__entry-carousel">
                    @foreach ($categorySectionTwo as $sectionOneNews)
                    <div class="item">
                        <!-- Post Article -->
                        <div class="article__entry">
                            <div class="article__image">
                                <a href="{{ route('news-details', $sectionOneNews->slug) }}">
                                    <img src="{{ asset($sectionOneNews->image) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="article__content">
                                <ul class="list-inline">
                                    <!-- <li class="list-inline-item">
                                        <span class="text-primary">
                                            {{ __('frontend.by') }} {{ $sectionOneNews->auther->name }}
                                        </span>
                                    </li> -->
                                    <li class="list-inline-item">
                                        <span>
                                            {{ getNepaliShortDate($news->created_at) }}
                                        </span>
                                    </li>

                                </ul>
                                <h5>
                                    <a href="{{ route('news-details', $sectionOneNews->slug) }}">
                                        {!! truncate($sectionOneNews->title, 40) !!}
                                    </a>
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach




                </div>
            </div>
        </div>
    </div>




    <div class="large_add_banner>
        <div class=" container">
        <div class="row">
            <div class="col-12">
                <div class="large_add_banner_img>
                      <img src=" {{ asset($ad->home_middle_ad) }}" alt="adds">
                </div>
            </div>
        </div>
    </div>
    </div>



    <!-- Video Gallery 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading d-flex justify-content-between align-items-center mb-4">
                    <h4 class="border_section mb-0">{{ __('frontend.Video Gallery') }}</h4>
                    <a href="{{ route('video-gallery') }}" class="btn btn-outline-primary btn-sm">
                        {{ __('frontend.view all') }}
                    </a>
                </div>
            </div>
        </div>

    <div class="video-carousel">
            @foreach($latestVideos as $video)
            <div class="item">
                <div class="video-card">
                    <div class="video-thumbnail position-relative">
                        <div class="video-overlay">
                            <div class="video-actions">
                                <button class="btn btn-light btn-sm preview-btn" 
                                        data-video-url="{{ $video->video_url }}"
                                        data-video-title="{{ $video->title }}"
                                        title="{{ __('frontend.Preview') }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-primary btn-sm play-btn" 
                                        data-video-url="{{ $video->video_url }}"
                                        data-video-title="{{ $video->title }}"
                                        title="{{ __('frontend.Watch Video') }}">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                            @php
                                $videoId = null;
                                if (strpos($video->video_url, 'youtube.com') !== false || strpos($video->video_url, 'youtu.be') !== false) {
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->video_url, $matches);
                                    $videoId = isset($matches[1]) ? $matches[1] : null;
                                }
                            @endphp
                            <img src="{{ $videoId ? 'https://img.youtube.com/vi/'.$videoId.'/maxresdefault.jpg' : asset('frontend/images/video-placeholder.jpg') }}" 
                                 class="img-fluid w-100" 
                                 alt="{{ $video->title }}">
                        </div>
                    </div>
                    <div class="video-content p-3">
                        <h5 class="video-title mb-2">{{ truncate($video->title, 40) }}</h5>
                        <div class="video-meta">
                            <span class="text-muted">
                                <i class="fas fa-calendar-alt"></i> {{ getNepaliShortDate($video->created_at) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div> 

       
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">{{ __('frontend.Video Preview') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="previewPlayer" class="embed-responsive-item" src="" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 


    <div class="modal fade" id="playerModal" tabindex="-1" role="dialog" aria-labelledby="playerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="playerModalLabel">{{ __('frontend.Video Player') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="videoPlayer" 
                                    class="embed-responsive-item" 
                                    src="" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
Section --> <!-- Modern Video Section with Hero Featured -->
    <div class="container-fluid video-section-modern mt-5 mb-5">
        <div class="container">



            <!-- Video Grid -->
            <section class="py-5 bg-dark text-white">
                <div class="container-fluid px-lg-5">
                    <h2 class="text-danger fw-bold mb-4">
                        भिडियो
                        <a href="#" class="float-end text-white text-decoration-none">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </h2>

                    <div class="row">
                        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                            <div class="card bg-dark border-0 p-0 position-relative overflow-hidden">
                                @foreach($categorybhadaya as $news)
                                @if ($loop->index <= 0)
                                    <div class="ratio ratio-16x9">
                                    <!-- <img src="path/to/image_a98c8f_main.jpg" class="img-fluid" alt="Featured Video Thumbnail" style="object-fit: cover;"> -->
                                    <a href="{{ route('news-details', $news->slug) }}">
                                        <img src="{{ asset($news->image) }}" class="img-fluid" alt="{{ $news->title }}">
                                    </a>
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);">

                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <div class="play-icon" style="width: 40px; flex-shrink: 0;">
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30.051 30.051" style="enable-background:new 0 0 30.051 30.051;" xml:space="preserve">
                                                    <g>
                                                        <path d="M19.982,14.438l-6.24-4.536c-0.229-0.166-0.533-0.191-0.784-0.062c-0.253,0.128-0.411,0.388-0.411,0.669v9.069
		c0,0.284,0.158,0.543,0.411,0.671c0.107,0.054,0.224,0.081,0.342,0.081c0.154,0,0.31-0.049,0.442-0.146l6.24-4.532
		c0.197-0.145,0.312-0.369,0.312-0.607C20.295,14.803,20.177,14.58,19.982,14.438z"></path>
                                                        <path d="M15.026,0.002C6.726,0.002,0,6.728,0,15.028c0,8.297,6.726,15.021,15.026,15.021c8.298,0,15.025-6.725,15.025-15.021
		C30.052,6.728,23.324,0.002,15.026,0.002z M15.026,27.542c-6.912,0-12.516-5.601-12.516-12.514c0-6.91,5.604-12.518,12.516-12.518
		c6.911,0,12.514,5.607,12.514,12.518C27.541,21.941,21.937,27.542,15.026,27.542z"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <a href="{{ route('news-details', $news->slug) }}" class="flex-grow-1">
                                                <h3 class="text-white fw-bold mb-0">{!! truncate($news->title, 100) !!}</h3>
                                            </a>
                                        </div>

                                        <p class="text-white-50 mb-0">मध्यरातसम्म चिया बेचिरहेका यी बालक, 'अंकल मलाई भाइरल नबनाउनु'</p>
                                    </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="d-flex flex-column gap-3">
                            @foreach($categorySectionOne as $news)
                            @if ($loop->index > 1 && $loop->index <= 5)
                                <div class="d-flex align-items-start">
                                <!-- <img src="path/to/image_a98c8f_thumb1.jpg" class="flex-shrink-0 me-3 rounded" style="width: 120px; height: 70px; object-fit: cover;" alt="Thumbnail">
                                  -->
                                <a href="{{ route('news-details', $news->slug) }}">
                                    <img src="{{ asset($news->image) }}" class="flex-shrink-0 me-3 rounded" style="width: 120px; height: 70px; object-fit: cover;" alt="Thumbnail" alt="{{ $news->title }}">
                                </a>
                                <div>
                                    <p class="mb-0 small">
                                        <a href="{{ route('news-details', $news->slug) }}" class="text-white text-decoration-none" style="display: block; font-size: 15px; color: white;">
                                            {!! truncate($news->title, 60) !!}
                                        </a>
                                    </p>
                                 <span class="video-duration"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30.051 30.051" style="enable-background:new 0 0 30.051 30.051;" xml:space="preserve">
    <g>
    <path d="M19.982,14.438l-6.24-4.536c-0.229-0.166-0.533-0.191-0.784-0.062c-0.253,0.128-0.411,0.388-0.411,0.669v9.069
		c0,0.284,0.158,0.543,0.411,0.671c0.107,0.054,0.224,0.081,0.342,0.081c0.154,0,0.31-0.049,0.442-0.146l6.24-4.532
		c0.197-0.145,0.312-0.369,0.312-0.607C20.295,14.803,20.177,14.58,19.982,14.438z"></path>
    <path d="M15.026,0.002C6.726,0.002,0,6.728,0,15.028c0,8.297,6.726,15.021,15.026,15.021c8.298,0,15.025-6.725,15.025-15.021
		C30.052,6.728,23.324,0.002,15.026,0.002z M15.026,27.542c-6.912,0-12.516-5.601-12.516-12.514c0-6.91,5.604-12.518,12.516-12.518
		c6.911,0,12.514,5.607,12.514,12.518C27.541,21.941,21.937,27.542,15.026,27.542z"></path>
    </g>
</svg> </span>
                                </div>
                        </div>
                        @endif
                        @endforeach
                        <hr class="text-secondary my-1">




                    </div>
                </div>
        </div>
    </div>
</section>
</div>
</div>



</div>
</div>



</section>
<div class="modal fade" id="videoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="videoPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="videoPreviewFrame" class="embed-responsive-item" src="{{ $video->embed_url }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="videoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="videoPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="videoPreviewFrame" class="embed-responsive-item" src="{{ $video->embed_url }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
<style>
    /* Modern Video Section Styles */
    .video-section-modern {
        background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);
        padding: 60px 0;
    }

    .video-section-header {
        border-bottom: 3px solid #dc3545;
        padding-bottom: 30px;
        margin-bottom: 40px;
    }

    .video-main-title {
        font-size: 3rem;
        font-weight: 900;
        color: #1a1a1a;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'Mukta', sans-serif;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .video-icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #dc3545, #ff6b6b);
        border-radius: 50%;
        color: white;
        font-size: 28px;
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
    }

    .video-subtitle {
        color: #666;
        font-size: 1.1rem;
        margin: 10px 0 0 75px;
        font-family: 'Mukta', sans-serif;
    }

    /* Featured Video Styles */
    .featured-video-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        transition: all 0.4s ease;
    }

    .featured-video-card:hover {
        box-shadow: 0 15px 40px rgba(220, 53, 69, 0.2);
        transform: translateY(-5px);
    }

    .featured-video-wrapper {
        position: relative;
        overflow: hidden;
        aspect-ratio: 16 / 9;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .featured-video-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .featured-video-card:hover .featured-video-img {
        transform: scale(1.05);
    }

    .featured-play-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
        z-index: 2;
    }

    .featured-video-card:hover .featured-play-overlay {
        opacity: 1;
    }

    .featured-play-btn {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dc3545, #ff6b6b);
        border: 4px solid white;
        color: white;
        font-size: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        padding: 0;
    }

    .featured-play-btn:hover {
        transform: scale(1.15);
        box-shadow: 0 12px 35px rgba(220, 53, 69, 0.6);
    }

    .featured-video-info {
        padding: 30px;
        background: white;
    }

    .featured-video-title {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.3;
        color: #1a1a1a;
        margin: 0 0 15px 0;
        font-family: 'Mukta', sans-serif;
    }

    .featured-video-meta {
        color: #666;
        font-size: 1rem;
        margin: 0;
    }

    /* Play Icon Styling */
    .play-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .play-icon svg {
        width: 100%;
        height: 100%;
        fill: #dc3545;
        transition: all 0.3s ease;
    }

    .play-icon:hover svg {
        fill: #ff6b6b;
        filter: drop-shadow(0 2px 4px rgba(220, 53, 69, 0.4));
    }

    /* Post Title Styling */
    .post-title {
        font-size: 45px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 10px;
        color: #2260bf;
        text-align: center;
    }

    .post-title a {
        color: #2260bf;
        text-decoration: none;
        font-family: 'Mukta', 'Arial', sans-serif;
    }

    /* Sidebar Videos */
    .sidebar-videos-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .sidebar-video-item {
        display: flex;
        gap: 15px;
        padding: 12px;
        background: white;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .sidebar-video-item:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-3px);
    }

    .sidebar-video-thumbnail {
        position: relative;
        overflow: hidden;
        width: 120px;
        height: 80px;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .sidebar-video-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .sidebar-video-item:hover .sidebar-video-thumbnail img {
        transform: scale(1.1);
    }

    .sidebar-video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }

    .sidebar-video-item:hover .sidebar-video-overlay {
        opacity: 1;
    }

    .sidebar-play-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #dc3545;
        border: 2px solid white;
        color: white;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .sidebar-play-btn:hover {
        transform: scale(1.2);
        background: #ff6b6b;
    }

    /* Sidebar Video Text Styling */
    .sidebar-video-item p a {
        color: white !important;
        text-decoration: none;
        transition: color 0.3s ease;
        font-weight: 500;
    }

    .sidebar-video-item p a:hover {
        color: #ff6b6b;
        text-decoration: underline;
    }

    /* Video Duration Icon Styling */
    .video-duration {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .video-duration svg {
        width: 100%;
        height: 100%;
        fill: #dc3545;
        transition: all 0.3s ease;
    }

    .video-duration:hover svg {
        fill: #ff6b6b;
        filter: drop-shadow(0 2px 4px rgba(220, 53, 69, 0.4));
    }

    /* Sidebar Styles */
    .wrapper__list__article {
        position: relative;
        padding-top: 5rem;
        padding-bottom: 2rem;
    }

    .wrapper__list__article h4.border_section {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 40px;
        position: relative;
        text-align: center;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
    }

    .wrapper__list__article h4.border_section::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 6px;
        background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
        border-radius: 3px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    /* Section header styles removed */

    .border_section {
        position: relative;
        display: inline-block;
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #1a1a1a 0%, #363636 50%, #1a1a1a 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
    }

    .border_section::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg,
                rgba(102, 126, 234, 0) 0%,
                rgba(102, 126, 234, 0.8) 50%,
                rgba(102, 126, 234, 0) 100%);
    }

    .border_section:hover {
        text-shadow: none;
    }



    /* Gradient background effect */
    .wrapper__list__article::before {
        content: '';
        position: absolute;
        top: -20px;
        left: -20px;
        right: -20px;
        bottom: -20px;
        background: radial-gradient(circle at center,
                rgba(102, 126, 234, 0.05) 0%,
                rgba(118, 75, 162, 0.05) 25%,
                transparent 60%);
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .wrapper__list__article:hover::before {
        opacity: 1;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .border_section {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .border_section {
            font-size: 1.75rem;
        }
    }

    .large_add_banner {
        position: relative;
        width: 100%;
        margin: 2rem 0;
        overflow: hidden;
        border-radius: 0.5rem;
    }

    .large_add_banner_img {
        position: relative;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .post-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, #2260bf, #3b82f6);
        border-radius: 2px;
    }

    .card__post-uniform {
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
        background: #fff;
    }

    .card__post-uniform:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .card__post-uniform .card__post__thumb {
        position: relative;
        width: 100%;
        padding-top: 66.66%;
        overflow: hidden;
        background: #f0f0f0;
    }

    .card__post-uniform .card__post__thumb img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card__post-uniform:hover .card__post__thumb img {
        transform: scale(1.05);
    }

    .card__post-uniform .card__post__content {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 1rem;
        background: #fff;
    }

    .card__post-uniform .card__post__title {
        flex: 1;
        margin: 0;
    }

    .card__post-uniform .card__post__title a {
        color: rgb(0, 0, 0);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.3s ease;
        font-family: 'Mukta', 'Arial', sans-serif;
    }

    .card__post-uniform .card__post__title a:hover {
        color: rgb(0, 0, 0);
    }

    .card__post-uniform small {
        font-size: 0.8rem;
        color: #495057;
        margin-top: auto;
        padding-top: 0.5rem;
        border-top: 1px solid #e9ecef;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card__post-uniform .card__post__content {
            padding: 0.75rem;
        }

        .card__post-uniform .card__post__title a {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .card__post-uniform .card__post__content {
            padding: 0.6rem;
        }

        .card__post-uniform .card__post__title a {
            font-size: 0.85rem;
        }

        .card__post-uniform small {
            font-size: 0.75rem;
        }
    }
</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
        var videoPlayer = $('#videoPlayer');
        var videoPreviewModal = $('#videoPreviewModal');

        // 1. EVENT: When a "Play Video" button is clicked
        $('.preview-video').on('click', function() {
            // Get the embed URL from the data attribute of the clicked button
            var videoSrc = $(this).data('video-src');

            // Set the iframe's src to play the video
            videoPlayer.attr('src', videoSrc);
        });

        // 2. EVENT: When the modal is closed (hidden)
        videoPreviewModal.on('hidden.bs.modal', function() {
            // Stop the video from playing in the background by clearing the src
            videoPlayer.attr('src', '');
        });
    });
</script>
@endpush