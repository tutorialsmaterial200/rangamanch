document.addEventListener('DOMContentLoaded', function() {
    // Video player functions
    window.playVideo = function(videoUrl, title) {
        let videoIframe = '';
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            const videoId = getYouTubeVideoId(videoUrl);
            videoIframe = `<iframe width="100%" height="500" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        } else if (videoUrl.includes('vimeo.com')) {
            const videoId = getVimeoVideoId(videoUrl);
            videoIframe = `<iframe width="100%" height="500" src="https://player.vimeo.com/video/${videoId}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
        } else {
            videoIframe = `<video width="100%" height="500" controls><source src="${videoUrl}" type="video/mp4">Your browser does not support the video tag.</video>`;
        }
        
        $('#playerModal .modal-title').text(title);
        $('#playerModal .modal-body').html(videoIframe);
        $('#playerModal').modal('show');
    };

    window.previewVideo = function(videoUrl, title) {
        $('#previewModal .modal-title').text(title);
        let thumbnail = '';
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            const videoId = getYouTubeVideoId(videoUrl);
            thumbnail = `<img src="https://img.youtube.com/vi/${videoId}/maxresdefault.jpg" class="img-fluid" alt="${title}">`;
        } else {
            thumbnail = '<div class="alert alert-info">Preview not available</div>';
        }
        $('#previewModal .modal-body').html(thumbnail);
        $('#previewModal').modal('show');
    };

    function getYouTubeVideoId(url) {
        let videoId = '';
        const pattern = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/;
        const match = url.match(pattern);
        if (match) {
            videoId = match[1];
            const ampersandPosition = videoId.indexOf('&');
            if (ampersandPosition !== -1) {
                videoId = videoId.substring(0, ampersandPosition);
            }
        }
        return videoId;
    }

    function getVimeoVideoId(url) {
        const match = url.match(/vimeo\.com\/(\d+)/);
        return match ? match[1] : '';
    }

    // Add event listeners to all preview and play buttons
    document.querySelectorAll('.preview-btn').forEach(button => {
        button.addEventListener('click', function() {
            const videoUrl = this.getAttribute('data-video-url');
            const title = this.getAttribute('data-video-title');
            previewVideo(videoUrl, title);
        });
    });

    document.querySelectorAll('.play-btn').forEach(button => {
        button.addEventListener('click', function() {
            const videoUrl = this.getAttribute('data-video-url');
            const title = this.getAttribute('data-video-title');
            playVideo(videoUrl, title);
        });
    });
});
