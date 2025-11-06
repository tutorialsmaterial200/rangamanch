@if(isset($singlePost) && $singlePost)
<section class="single-post-section ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapper__list__article">
                    <!-- Title section removed as requested -->
                </div>

                <!-- Single Post Card -->
                <div class="single-post-card">
                    <div class="row">
                        <!-- <div class="col-md-6">
                            <div class="single-post-image">
                                <a href="{{ route('news-details', $singlePost->slug) }}">
                                    <img src="{{ asset($singlePost->image) }}" class="img-fluid rounded" alt="{{ $singlePost->title }}">
                                </a>
                             
                            </div>
                        </div> -->


                        <div class="single-post-content">

                            <div class="single-post-title">
                                <h2 class="post-title">
                                    <a href="{{ route('news-details', $singlePost->slug) }}">
                                        {{ $singlePost->title }}
                                    </a>
                                </h2>

                            </div>
                            <div class="ok-title-info flx">
                                <div class="ok-news-author">
                                    <span class="author-icon">
                                    <img src="https://rangamanch.com/uploads/JQnPaT27iXEd4q3QegJTQlhrlRN7G3.png" alt="अनलाइनखबर">
                                            

                                        
                                    </span>
                                    <span>रंगमञ्च</span>
                                </div>
                                <!-- <div class="ok-news-post-hour">
                                    <img src="https://www.onlinekhabar.com/wp-content/themes/onlinekhabar-2021/img/clock-icon.png" alt="">
                                    <span>६ मिनेट अगाडि</span>
                                </div> -->

                            </div>
                        </div>
                        <div class="single-post-image">
                            <a href="{{ route('news-details', $singlePost->slug) }}">
                                <img src="{{ asset($singlePost->image) }}" class=" img-fluid object-fit-fill border rounded" alt="{{ $singlePost->title }}">
                            </a>
                        </div>
                        <div class="single-post-excerpt">
                            <p class="post-excerpt">
                                @php
                                // Strip HTML and decode HTML entities
                                $text = html_entity_decode(strip_tags($singlePost->content), ENT_QUOTES, 'UTF-8');

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
                        <!-- <div class="single-post-excerpt">
                                    <p class="post-excerpt">
                                        @php
                                            $words = str_word_count(strip_tags($singlePost->content), 1);
                                            $limitedWords = array_slice($words, 0, 15);
                                            $content = implode(' ', $limitedWords);
                                            if (count($words) > 15) {
                                                $content .= '...';
                                            }
                                        @endphp
                                        {!! $content !!}
                                    </p>
                                </div> -->


                        <div class="single-post-tags mt-3">
                            @if($singlePost->tags && is_string($singlePost->tags))
                            @foreach(json_decode($singlePost->tags, true) as $tag)
                            <span class="tag-item">
                                <i class="fa fa-tag"></i> {{ $tag }}
                            </span>
                            @endforeach
                            @endif
                        </div>


                    </div>

                </div>
            </div>
            <!-- End Single Post Card -->
        </div>
    </div>
    </div>
</section>

<style>
    /* OK Title Info Styling */
    .ok-title-info {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .ok-news-author {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ok-news-author .author-icon {
        height: 45px;
        width: 45px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }

    .ok-news-author .author-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ok-news-author span:last-child {
        color: #2d3748;
        font-weight: 600;
        font-size: 14px;
    }

    .ok-news-post-hour {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4a5568;
        font-size: 14px;
    }

    .ok-news-post-hour img {
        height: 20px;
        width: 20px;
    }

    .single-post-title {
        color: "#102c57";
    }

    .single-post-section {

        padding: 2px 0;
        position: relative;
        overflow: hidden;
    }

    .single-post-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        pointer-events: none;
    }

    .single-post-card {



        overflow: hidden;
        margin-bottom: 20px;


        position: relative;
    }

    .single-post-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background: linear-gradient(145deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%); */
        pointer-events: none;
        z-index: 1;
    }



    .single-post-image {
        position: relative;
        overflow: hidden;
        height: 450px;


        background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .single-post-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        z-index: 1;
        pointer-events: none;
    }

    .single-post-image img {
        width: 100%;
        height: 100%;
        object-fit: fit;

        filter: saturate(1.1) contrast(1.05);
    }

    .single-post-image:hover img {

        filter: saturate(1.2) contrast(1.1);
    }

    /* Post overlay and category badge styles removed as requested */

    .single-post-content {
        padding: 10px;
        position: relative;
        z-index: 2;
        line-height: 1.3;
    }

    /* Post meta styles removed as requested */

    .post-title {
        font-size: 40px;
        font-weight: 800;
        line-height: 1.3;
        /* margin-bottom: 15px; */
        /* color: #1a202c;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); */
        text-align: center;
    }

    .post-title a {
        color: "#102c57";
        text-decoration: none;
        display: -webkit-box;
    
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 2.6em;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #102c57, rgb(0, 0, 0));

        background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% 200%;
        animation: gradient 3s ease infinite;
        font-family: 'Mukta', 'Arial', sans-serif;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .post-title a:hover {
        transform: translateY(-2px);
    }

    .post-excerpt {
        max-width: 95%;
        margin: 20px auto;
        color: #374151;
        line-height: 1.6;
        font-size: 18px;
        font-weight: 400;
        text-align: center;
        font-family: 'Mukta', 'Arial', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        display: -webkit-box;

        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 3.2em;
        /* background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.8) 100%); */
        padding: 8px 10px;
        border-radius: 8px;
        /* box-shadow: 0 2px 4px rgba(0,0,0,0.05); */
        transition: all 0.3s ease;
    }


    .tag-item {
        display: inline-block;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
        color: #2d3748;
        padding: 8px 15px;
        margin: 4px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }

    .tag-item:hover {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .tag-item i {
        margin-right: 6px;
    }

    .single-post-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 25px;
        border-top: 2px solid #e2e8f0;
        position: relative;
    }

    .single-post-actions::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: linear-gradient(to right, #667eea, #764ba2);
        border-radius: 1px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        border: none;
        padding: 15px 30px;
        border-radius: 35px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow:
            0 8px 25px rgba(102, 126, 234, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .social-share-buttons {
        display: flex;
        gap: 10px;
    }

    .social-share-buttons a {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        color: white;
        text-decoration: none;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }

    .social-share-buttons a:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .btn-facebook {
        background: linear-gradient(135deg, #3b5998, #4267B2);
    }

    .btn-twitter {
        background: linear-gradient(135deg, #1da1f2, #0084b4);
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #25d366, #128c7e);
    }

    /* Section header styles removed as requested */

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

    @media (max-width: 768px) {
        .single-post-section {
            padding: 20px 0;
        }

        .single-post-image {
            height: 300px;
            margin-bottom: 0;
            border-radius: 25px 25px 0 0;
        }

        .single-post-content {
            padding: 30px 25px;
        }

        .single-post-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 25px;
        }

        .post-title {
            font-size: 26px;
        }

        .post-title a {
          
            max-height: 2.6em;
            line-height: 1.3;
        }

        .social-share-buttons {
            justify-content: center;
        }

        /* Responsive styles for removed elements */

        .wrapper__list__article h4.border_section {
            font-size: 28px;
        }

        /* Post meta responsive styles removed */

        .btn-primary {
            padding: 12px 25px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .single-post-section {
            padding: 30px 0;
        }

        .single-post-card {
            border-radius: 20px;
            margin: 0 15px 30px;
        }

        .single-post-image {
            height: 250px;
            border-radius: 20px 20px 0 0;
        }

        .single-post-content {
            padding: 25px 20px;
        }

        .post-title {
            font-size: 22px;
            line-height: 1.3;
        }

        .post-title a {
       
            max-height: 2.6em;
        }

        .post-excerpt {
            font-size: 15px;
            line-height: 1.5;
            margin: 5px 0;
     
            max-height: 3em;
        }

        /* Responsive styles for removed title section */

        .wrapper__list__article h4.border_section {
            font-size: 24px;
        }

        /* Overlay responsive styles removed */

        .social-share-buttons a {
            width: 40px;
            height: 40px;
        }

        .tag-item {
            padding: 6px 12px;
            font-size: 12px;
            margin: 2px;
        }
    }

    @media (max-width: 480px) {
        .single-post-section {
            padding: 20px 0;
        }

        .single-post-card {
            margin: 0 10px 25px;
            border-radius: 15px;
        }

        .single-post-image {
            height: 220px;
            border-radius: 15px 15px 0 0;
        }

        .single-post-content {
            padding: 20px 15px;
        }

        .post-title {
            font-size: 20px;
        }

        /* Mobile responsive styles for removed elements */

        .wrapper__list__article h4.border_section {
            font-size: 22px;
        }

        /* Meta responsive styles removed */

        .btn-primary {
            padding: 10px 20px;
            font-size: 13px;
        }
    }
</style>
@endif