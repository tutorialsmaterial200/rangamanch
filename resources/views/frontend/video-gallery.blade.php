@extends('frontend.layouts.master')

@section('content')
<!-- Hero Banner with Breadcrumb -->
<section class="video-hero-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center" style="min-height: 300px;">
            <div class="col-md-12">
                <div class="hero-content text-center text-white">
                    <h1 class="hero-title mb-3" style="font-size: 3rem; font-weight: 700;">
                        <i class="fas fa-play-circle me-3"></i>{{ __('frontend.Video Gallery') }}
                    </h1>
                    <p class="hero-subtitle" style="font-size: 1.2rem; opacity: 0.95;">
                        {{ __('Explore our collection of engaging video content') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<section class="breadcrumb-section py-3" style="background-color: #f8f9fa;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <i class="fas fa-home"></i> {{ __('frontend.Home') }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-video"></i> {{ __('frontend.Video Gallery') }}
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Video Gallery Section -->
<section class="video-gallery-section py-5">
    <div class="container">
        @if($videos->count() > 0)
            <!-- Featured Video (First Video) -->
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="featured-video-card">
                        <div class="featured-badge">
                            <i class="fas fa-star"></i> FEATURED
                        </div>
                        <div class="featured-video-wrapper">
                            <div class="video-thumbnail-lg" onclick="playVideo('{{ $videos->first()->video_url }}', '{{ $videos->first()->title }}')">
                                <img src="https://img.youtube.com/vi/{{ extractYoutubeId($videos->first()->video_url) }}/maxresdefault.jpg" alt="{{ $videos->first()->title }}" class="img-fluid">
                                <div class="play-button-lg">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <div class="featured-video-content p-4">
                            <h2 class="featured-title mb-2">{{ $videos->first()->title }}</h2>
                            <div class="video-meta-featured">
                                <span class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    {{ $videos->first()->created_at->format('M d, Y') }}
                                </span>
                                <span class="meta-item ms-3">
                                    <i class="fas fa-eye"></i>
                                    Featured Video
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Grid -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="section-divider">
                        <h3 class="divider-text">More Videos</h3>
                    </div>
                </div>
            </div>

            <div class="row" id="video-grid">
                @forelse($videos->skip(1) as $video)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="video-card-item">
                            <div class="video-card-thumbnail" onclick="playVideo('{{ $video->video_url }}', '{{ $video->title }}')">
                                <img src="https://img.youtube.com/vi/{{ extractYoutubeId($video->video_url) }}/hqdefault.jpg" alt="{{ $video->title }}" class="img-fluid">
                                <div class="video-overlay-play">
                                    <div class="play-button">
                                        <i class="fas fa-play"></i>
                                    </div>
                                </div>
                                <span class="video-duration">
                                    <i class="fas fa-clock"></i>
                                </span>
                            </div>
                            <div class="video-card-content">
                                <h5 class="video-card-title">{{ $video->title }}</h5>
                                <div class="video-card-meta">
                                    <span class="meta-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $video->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <button class="btn btn-watch-now w-100 mt-3" onclick="playVideo('{{ $video->video_url }}', '{{ $video->title }}')">
                                    <i class="fas fa-play-circle me-2"></i>{{ __('frontend.Watch Now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>{{ __('frontend.No videos available') }}
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            {{ $videos->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning text-center py-5">
                        <i class="fas fa-video-slash" style="font-size: 3rem; opacity: 0.5;"></i>
                        <p class="mt-3">{{ __('frontend.No videos available at this moment') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Video Player Modal -->
<div class="modal fade video-modal" id="videoPlayerModal" tabindex="-1" role="dialog" aria-labelledby="videoPlayerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="videoPlayerLabel">Video Player</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="video-player-container">
                    <iframe id="videoPlayerIframe" 
                            width="100%" 
                            height="500" 
                            src="" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Hero Section */
    .video-hero-section {
        position: relative;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-weight: 700;
        animation: slideInDown 0.8s ease;
    }

    .hero-subtitle {
        animation: slideInUp 0.8s ease 0.2s both;
    }

    /* Breadcrumb */
    .breadcrumb-section {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .breadcrumb {
        margin-bottom: 0;
    }

    .breadcrumb-item a {
        color: #667eea;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: #764ba2;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    /* Video Gallery Section */
    .video-gallery-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    /* Section Divider */
    .section-divider {
        position: relative;
        text-align: center;
        margin: 3rem 0 2rem 0;
    }

    .divider-text {
        position: relative;
        z-index: 1;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 0 20px;
        color: #333;
        font-weight: 600;
        font-size: 1.5rem;
    }

    .section-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #ccc, transparent);
        z-index: 0;
    }

    /* Featured Video Card */
    .featured-video-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .featured-video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .featured-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 10;
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .featured-video-wrapper {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .video-thumbnail-lg {
        position: relative;
        height: 100%;
        cursor: pointer;
        overflow: hidden;
    }

    .video-thumbnail-lg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .video-thumbnail-lg:hover img {
        transform: scale(1.05);
    }

    .play-button-lg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #667eea;
        z-index: 5;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .video-thumbnail-lg:hover .play-button-lg {
        background: white;
        transform: translate(-50%, -50%) scale(1.1);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .featured-video-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .featured-title {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.4;
    }

    .video-meta-featured {
        display: flex;
        align-items: center;
        font-size: 0.95rem;
        opacity: 0.95;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Video Card Items */
    .video-card-item {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .video-card-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .video-card-thumbnail {
        position: relative;
        height: 200px;
        overflow: hidden;
        cursor: pointer;
        background: #f0f0f0;
    }

    .video-card-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .video-card-item:hover .video-card-thumbnail img {
        transform: scale(1.08);
    }

    .video-overlay-play {
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
        transition: all 0.3s ease;
        z-index: 2;
    }

    .video-card-thumbnail:hover .video-overlay-play {
        opacity: 1;
    }

    .play-button {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);
    }

    .video-card-thumbnail:hover .play-button {
        transform: scale(1.1);
        box-shadow: 0 12px 30px rgba(245, 87, 108, 0.4);
    }

    .video-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        z-index: 3;
    }

    .video-card-content {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .video-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.4;
        flex-grow: 1;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .video-card-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 12px;
    }

    .meta-date {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-watch-now {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .btn-watch-now:hover {
        background: linear-gradient(135deg, #5568d3 0%, #6a3a8f 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    /* Video Modal */
    .video-modal .modal-content {
        background-color: #1a1a1a;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
    }

    .video-modal .modal-header {
        padding: 16px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
    }

    .video-modal .modal-title {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .video-modal .btn-close-white {
        filter: brightness(0) invert(1);
    }

    .video-modal .modal-body {
        padding: 0;
        background: #000;
    }

    .video-player-container {
        position: relative;
        width: 100%;
        background: #000;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }

    .video-player-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Modal Backdrop */
    .modal-backdrop.show {
        opacity: 0.5;
        background-color: #000;
    }

    /* Pagination Styles */
    .pagination {
        justify-content: center;
        gap: 5px;
    }

    .page-link {
        color: #667eea;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        color: #fff;
        background-color: #667eea;
        border-color: #667eea;
    }

    .page-item.active .page-link {
        background-color: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        cursor: not-allowed;
    }

    /* Alert Styles */
    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .featured-video-wrapper {
            height: 250px;
        }

        .featured-title {
            font-size: 1.4rem;
        }

        .play-button-lg {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .divider-text {
            font-size: 1.2rem;
        }

        .video-card-thumbnail {
            height: 160px;
        }

        .featured-badge {
            font-size: 0.75rem;
            padding: 6px 12px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    /**
     * Extract YouTube video ID from various YouTube URL formats
     */
    function extractYoutubeId(url) {
        if (!url) return '';
        
        try {
            const patterns = [
                /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&?/]{11})/,
                /^([a-zA-Z0-9_-]{11})$/
            ];
            
            for (let pattern of patterns) {
                const match = url.match(pattern);
                if (match && match[1]) {
                    return match[1];
                }
            }
        } catch (e) {
            console.error('Error extracting YouTube ID:', e);
        }
        
        return '';
    }

    /**
     * Process video URL and get embed URL
     */
    function processVideoUrl(url) {
        if (!url) return null;
        
        try {
            // YouTube URLs
            if (url.includes('youtube.com') || url.includes('youtu.be')) {
                const match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
                if (match && match[1]) {
                    return {
                        type: 'youtube',
                        id: match[1]
                    };
                }
            }
            
            // Vimeo URLs
            if (url.includes('vimeo.com')) {
                const match = url.match(/(?:vimeo)\.com.*(?:videos|video|channels|)\/([\d]+)/i);
                if (match && match[1]) {
                    return {
                        type: 'vimeo',
                        id: match[1]
                    };
                }
            }
            
            // Direct video URLs
            if (url.match(/\.(mp4|webm|ogg)$/i)) {
                return {
                    type: 'direct',
                    url: url
                };
            }
            
            return null;
        } catch (e) {
            console.error('Error processing video URL:', e);
            return null;
        }
    }

    /**
     * Get embed URL for iframe
     */
    function getEmbedUrl(url, autoplay = false) {
        const videoInfo = processVideoUrl(url);
        if (!videoInfo) return null;
        
        switch (videoInfo.type) {
            case 'youtube':
                return `https://www.youtube.com/embed/${videoInfo.id}?rel=0&showinfo=0&modestbranding=1&controls=1${autoplay ? '&autoplay=1' : ''}`;
            case 'vimeo':
                return `https://player.vimeo.com/video/${videoInfo.id}?title=0&byline=0&portrait=0${autoplay ? '&autoplay=1' : ''}`;
            case 'direct':
                return videoInfo.url;
            default:
                return null;
        }
    }

    /**
     * Play video in modal
     */
    function playVideo(url, title) {
        if (!url) {
            console.error('No video URL provided');
            return;
        }

        const embedUrl = getEmbedUrl(url, true);
        
        if (!embedUrl) {
            console.error('Invalid video URL:', url);
            alert('Unable to load this video. The URL format is not supported.');
            return;
        }
        
        const modal = document.getElementById('videoPlayerModal');
        const iframe = document.getElementById('videoPlayerIframe');
        const titleElement = document.getElementById('videoPlayerLabel');
        
        if (!modal || !iframe) {
            console.error('Modal or iframe not found');
            return;
        }
        
        // Update modal title
        titleElement.textContent = title || 'Video Player';
        
        // Set iframe source
        iframe.src = embedUrl;
        
        // Show modal using Bootstrap
        const bootstrapModal = new bootstrap.Modal(modal, {
            backdrop: 'static',
            keyboard: false
        });
        
        bootstrapModal.show();
    }

    // Clean up video when modal is closed
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('videoPlayerModal');
        const iframe = document.getElementById('videoPlayerIframe');
        
        if (modal) {
            modal.addEventListener('hidden.bs.modal', function() {
                iframe.src = '';
            });
        }
    });
</script>

<!-- Helper function for Blade template -->
<script>
    // Make extractYoutubeId available for use in inline onclick handlers
    window.extractYoutubeId = function(url) {
        if (!url) return '';
        
        try {
            const patterns = [
                /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&?/]{11})/,
                /^([a-zA-Z0-9_-]{11})$/
            ];
            
            for (let pattern of patterns) {
                const match = url.match(pattern);
                if (match && match[1]) {
                    return match[1];
                }
            }
        } catch (e) {
            console.error('Error extracting YouTube ID:', e);
        }
        
        return '';
    };
</script>
@endpush
@endsection




