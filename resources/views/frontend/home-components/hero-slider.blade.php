<link rel="stylesheet" href="{{ asset('frontend/css/sidebar-thumb.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/main-article.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/hero-post.css') }}">
<section>


    <div class="container ">
        <div class="row  ">

            <!-- Main Article (Left Column) -->
            <div class="col-md-8">
                @foreach ($heroSlider as $slider)
                @if ($loop->index <= 0)

                    <!-- Post Article -->
                    <div class="row justify-content-start">
                        
                        <div class="justify-content-start">
                            <a href="{{ route('news-details', $slider->slug) }}">
                                <img src="{{ asset($slider->image) }}" class="img-fluid" alt="{{ $slider->title }}">
                            </a>
                            <div class="card__post__content bg__post-cover">
                                <!-- <div class="card__post__category">
                                    {{ $slider->category->name }}
                                </div> -->
                               <div class="card__post__title">
                                    <h2>
                                        <a href="{{ route('news-details', $slider->slug) }}">
                                            {!! truncate($slider->title, 100) !!}
                                        </a>
                                    </h2>
                                </div>
                                <div class="card__post__author-info">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="javascript:;">
                                                <!-- {{ __('frontend.by') }} {{ $slider->auther->name }} -->
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>

                                                {{ getNepaliShortDate($slider->created_at) }}
                                            </span>
                                        </li>
                                    </ul>

                                </div>
                            </div>


                        </div>
                    </div>
                    @endif
                    @endforeach

            </div>

            <!-- Sidebar (Right Column) -->
            <div class="col-lg-4">
                <div class="sidebar-items-grid">
                    @foreach ($heroSlider as $slider)
                    @if ($loop->index > 0 && $loop->index <= 5)
                        <div class="card sidebar-card border-0 shadow-sm mb-3">
                            <a href="{{ route('news-details', $slider->slug) }}" class="card-link-wrapper">
                                <div class="card-body d-flex align-items-start p-3">
                                    <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" class="sidebar-thumb me-3 flex-shrink-0" />
                                    <div class="flex-grow-1">
                                        <h6 class="sidebar-title mb-0">
                                            {!! truncate($slider->title, 80) !!}
                                        </h6>
                                        <small class="text-muted d-block mt-2">
                                            {{ getNepaliShortDate($slider->created_at) }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    <!-- End Popular news header--
      .my-custom-padding {
      padding-top: 2em;
    }
</section>
