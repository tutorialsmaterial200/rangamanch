@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.News') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Update News') }}</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option value="">--{{ __('admin.Select') }}--</option>
                            @foreach ($languages as $lang)
                                <option {{ $lang->lang === $news->language ? 'selected' : '' }} value="{{ $lang->lang }}">
                                    {{ $lang->name }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Category') }}</label>
                        <select name="category" id="category" class="form-control select2">
                            <option value="">--{{ __('admin.Select') }}---</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id === $news->category_id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">{{ __('admin.Image') }}</label>
                        <div class="card">
                            <div class="card-body">
                                <!-- Upload Area -->
                                <div id="image-preview" class="image-preview mb-3" @if($news->image) style="display: none;" @endif>
                                    <label for="image-upload" id="image-label" class="d-flex flex-column align-items-center justify-content-center p-4 border-2 border-dashed rounded cursor-pointer" style="min-height: 200px; background-color: #f8f9fa; transition: all 0.3s ease;">
                                        <i class="fas fa-cloud-upload-alt fa-3x mb-2" style="color: #6c757d;"></i>
                                        <span class="text-muted">{{ __('admin.Choose File') }} or drag & drop</span>
                                        <small class="text-secondary mt-2">PNG, JPG, GIF up to 10MB</small>
                                    </label>
                                    <input type="file" name="image" id="image-upload" accept="image/*" style="display: none;">
                                </div>
                                
                                <!-- Existing Image Preview (if editing) -->
                                @if($news->image)
                                <div id="existing-image-container" class="mb-3">
                                    <div class="alert alert-info mb-2">
                                        <i class="fas fa-info-circle"></i> {{ __('Current Image') }}
                                    </div>
                                    <div class="position-relative d-inline-block" style="max-width: 100%;">
                                        <img id="existing-preview-img" src="{{ asset($news->image) }}" alt="Existing Image" class="img-fluid rounded" style="max-height: 300px; display: block;">
                                        <div style="position: absolute; top: 10px; right: 10px;">
                                            <span class="badge badge-success"><i class="fas fa-check"></i> Uploaded</span>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-warning" id="remove-existing-image-btn">
                                            <i class="fas fa-trash"></i> {{ __('Remove Current Image') }}
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary" id="change-to-new-image-btn">
                                            <i class="fas fa-images"></i> {{ __('Upload New Image') }}
                                        </button>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- New Image Preview -->
                                <div id="image-preview-container" style="display: none;" class="mb-3">
                                    <div class="alert alert-success mb-2">
                                        <i class="fas fa-check-circle"></i> {{ __('admin.New Image Selected') }}
                                    </div>
                                    <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-danger" id="remove-image-btn">
                                            <i class="fas fa-trash"></i> {{ __('Remove New Image') }}
                                        </button>
                                        <button type="button" class="btn btn-sm btn-secondary" id="change-image-btn">
                                            <i class="fas fa-images"></i> {{ __('Change Image') }}
                                        </button>
                                    </div>
                                </div>

                                <!-- Image Browser Buttons -->
                                <div class="btn-group btn-block" role="group" @if($news->image) style="display: none;" @endif>
                                    <button type="button" class="btn btn-info" id="browse-image-btn" style="flex: 1;">
                                        <i class="fas fa-folder-open"></i> {{ __('Browse Image') }}
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="gallery-image-btn" style="flex: 1;">
                                        <i class="fas fa-images"></i> {{ __('Image Gallery') }}
                                    </button>
                                </div>
                                
                                <!-- Hidden input for gallery image path -->
                                <input type="hidden" id="gallery-image-path" name="gallery_image_path" value="">
                            </div>
                        </div>
                        @error('image')
                            <p class="text-danger mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Ttile') }}</label>
                        <input name="title" value="{{ $news->title }}" type="text" class="form-control"
                            id="name">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Content') }}</label>
                        <div class="d-flex align-items-center mb-2">
                            <button type="button" class="btn btn-info btn-sm mr-2" id="generate-content-btn">
                                <i class="fas fa-magic"></i> Generate with AI
                            </button>
                        </div>
                        <textarea name="content" class="summernote">{{ $news->content }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="">{{ __('admin.Tags') }}</label>
                        <input name="tags" type="text"
                            value="{{ formatTags($news->tags()->pluck('name')->toArray()) }}"
                            class="form-control inputtags">
                        @error('tags')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Meta Title') }}</label>
                        <input name="meta_title" value="{{ $news->meta_title }}" type="text" class="form-control"
                            id="name">
                        @error('meta_title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin.Meta Description') }}</label>
                        <textarea name="meta_description" class="form-control">{{ $news->meta_description }}</textarea>
                        @error('meta_description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">{{ __('admin.Status') }}</div>
                                <label class="custom-switch mt-2">
                                    <input {{ $news->status === 1 ? 'checked' : '' }} value="1" type="checkbox"
                                        name="status" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>

                        @if (canAccess(['news status', 'news all-access']))
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="control-label">{{ __('admin.Is Breaking News') }}</div>
                                    <label class="custom-switch mt-2">
                                        <input {{ $news->is_breaking_news == 1 ? 'checked' : '' }} value="1"
                                            type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="control-label">{{ __('admin.Show At Slider') }}</div>
                                    <label class="custom-switch mt-2">
                                        <input {{ $news->show_at_slider === 1 ? 'checked' : '' }} value="1"
                                            type="checkbox" name="show_at_slider" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <div class="control-label">{{ __('admin.Show At Popular') }}</div>
                                    <label class="custom-switch mt-2">
                                        <input {{ $news->show_at_popular === 1 ? 'checked' : '' }} value="1"
                                            type="checkbox" name="show_at_popular" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        @endif

                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('admin.Update') }}</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Image Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">
                        <i class="fas fa-images"></i> {{ __('Image Gallery') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="gallery-loading" class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">{{ __('admin.Loading') }}</p>
                    </div>
                    <div id="gallery-container" style="display: none;">
                        <div class="row" id="gallery-images">
                            <!-- Gallery images will be loaded here -->
                        </div>
                    </div>
                    <div id="gallery-empty" style="display: none;" class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ __('admin.No Images Available') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Image Upload Functionality
            const imageUpload = $('#image-upload');
            const imageLabel = $('#image-label');
            const imagePreviewContainer = $('#image-preview-container');
            const previewImg = $('#preview-img');
            const browseImageBtn = $('#browse-image-btn');
            const galleryImageBtn = $('#gallery-image-btn');
            const removeImageBtn = $('#remove-image-btn');
            const changeImageBtn = $('#change-image-btn');
            const imagePreview = $('#image-preview');
            
            // Existing image elements
            const existingImageContainer = $('#existing-image-container');
            const removeExistingImageBtn = $('#remove-existing-image-btn');
            const changeToNewImageBtn = $('#change-to-new-image-btn');

            // Initialize: If existing image present, hide upload area and button
            function initializeImageDisplay() {
                if (existingImageContainer.length > 0 && existingImageContainer.is(':visible')) {
                    imagePreview.hide();
                    browseImageBtn.parent().hide();
                    imagePreviewContainer.hide();
                } else {
                    imagePreview.show();
                    browseImageBtn.parent().show();
                }
            }

            // Call initialization on page load
            initializeImageDisplay();

            // Browse button click
            browseImageBtn.on('click', function() {
                imageUpload.click();
            });

            // Gallery button click
            galleryImageBtn.on('click', function() {
                loadImageGallery();
                $('#galleryModal').modal('show');
            });

            // Load Image Gallery
            function loadImageGallery() {
                const galleryContainer = $('#gallery-container');
                const galleryImages = $('#gallery-images');
                const galleryLoading = $('#gallery-loading');
                const galleryEmpty = $('#gallery-empty');

                galleryLoading.show();
                galleryContainer.hide();
                galleryEmpty.hide();
                galleryImages.html('');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.gallery-images') }}",
                    success: function(data) {
                        galleryLoading.hide();
                        
                        if (data.images.length > 0) {
                            galleryContainer.show();
                            
                            $.each(data.images, function(index, image) {
                                const imageHtml = `
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="gallery-item position-relative" style="cursor: pointer; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.2s ease;">
                                            <img src="${image.url}" alt="${image.name}" style="width: 100%; height: 150px; object-fit: cover;">
                                            <div class="gallery-overlay position-absolute" style="top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s ease;">
                                                <i class="fas fa-check fa-2x text-white"></i>
                                            </div>
                                            <small class="position-absolute" style="bottom: 5px; left: 5px; background: rgba(0,0,0,0.6); color: white; padding: 3px 6px; border-radius: 4px; font-size: 10px;">
                                                ${image.size}
                                            </small>
                                        </div>
                                    </div>
                                `;
                                galleryImages.append(imageHtml);
                            });

                            // Add click handlers to gallery items
                            $('.gallery-item').on('mouseover', function() {
                                $(this).find('.gallery-overlay').css('opacity', '1');
                            }).on('mouseout', function() {
                                $(this).find('.gallery-overlay').css('opacity', '0');
                            }).on('click', function() {
                                const imageSrc = $(this).find('img').attr('src');
                                selectGalleryImage(imageSrc);
                                $('#galleryModal').modal('hide');
                            });
                        } else {
                            galleryEmpty.show();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        galleryLoading.hide();
                        galleryEmpty.show();
                    }
                });
            }

            // Select Gallery Image
            function selectGalleryImage(imageSrc) {
                // Extract the path from the URL (e.g., /uploads/filename.jpg)
                const urlParts = imageSrc.split('/');
                const filename = urlParts[urlParts.length - 1];
                const imagePath = 'uploads/' + filename;
                
                // Display the preview
                previewImg.attr('src', imageSrc);
                imagePreview.hide();
                browseImageBtn.parent().hide();
                existingImageContainer.hide();
                imagePreviewContainer.show();
                
                // Store the gallery image path in hidden input and data attribute
                $('#gallery-image-path').val(imagePath);
                imageUpload.data('gallery-image', imagePath);
            }

            // File input change
            imageUpload.on('change', function(e) {
                handleImageUpload(e);
            });

            // Drag & drop
            imageLabel.on('dragover', function(e) {
                e.preventDefault();
                $(this).css({
                    'background-color': '#e9ecef',
                    'border-color': '#0066cc'
                });
            });

            imageLabel.on('dragleave', function() {
                $(this).css({
                    'background-color': '#f8f9fa',
                    'border-color': '#dee2e6'
                });
            });

            imageLabel.on('drop', function(e) {
                e.preventDefault();
                $(this).css({
                    'background-color': '#f8f9fa',
                    'border-color': '#dee2e6'
                });
                
                const files = e.originalEvent.dataTransfer.files;
                imageUpload[0].files = files;
                handleImageUpload({ target: imageUpload[0] });
            });

            // Handle image upload
            function handleImageUpload(e) {
                const file = e.target.files[0];
                
                if (file) {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select an image file');
                        return;
                    }

                    // Validate file size (10MB)
                    if (file.size > 10 * 1024 * 1024) {
                        alert('Image size should be less than 10MB');
                        return;
                    }

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImg.attr('src', event.target.result);
                        imageUpload.removeData('gallery-image');
                        imagePreview.hide();
                        browseImageBtn.parent().hide();
                        existingImageContainer.hide();
                        imagePreviewContainer.show();
                    };
                    reader.readAsDataURL(file);
                }
            }

            // Remove new image
            removeImageBtn.on('click', function() {
                imageUpload.val('');
                imageUpload[0].files = new DataTransfer().items;
                imageUpload.removeData('gallery-image');
                $('#gallery-image-path').val('');
                previewImg.attr('src', '');
                imagePreviewContainer.hide();
                
                // Show existing image if available
                if (existingImageContainer.length > 0) {
                    existingImageContainer.show();
                    imagePreview.hide();
                    browseImageBtn.parent().hide();
                } else {
                    imagePreview.show();
                    browseImageBtn.parent().show();
                }
            });

            // Change image
            changeImageBtn.on('click', function() {
                imageUpload.click();
            });

            // Remove existing image
            removeExistingImageBtn.on('click', function() {
                if (confirm('Are you sure you want to remove the current image?')) {
                    existingImageContainer.hide();
                    imagePreview.show();
                    browseImageBtn.parent().show();
                    
                    // Create a hidden input to mark image as deleted
                    if ($('#delete-existing-image').length === 0) {
                        $('<input type="hidden" id="delete-existing-image" name="delete_image" value="1">').appendTo('form');
                    }
                }
            });

            // Change to new image from existing
            changeToNewImageBtn.on('click', function() {
                imageUpload.click();
            });

            // Language Select
            $('#language-select').on('change', function() {
                let lang = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.fetch-news-category') }}",
                    data: {
                        lang: lang
                    },
                    success: function(data) {
                        $('#category').html("");
                        $('#category').html(
                            `<option value="">---{{ __('admin.Select') }}---</option>`);

                        $.each(data, function(index, data) {
                            $('#category').append(
                                `<option value="${data.id}">${data.name}</option>`)
                        })

                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })

            // Generate Content with AI
            $('#generate-content-btn').on('click', function() {
                // Logic to generate content using AI
                // This is just a placeholder, implement the actual AI content generation logic
                let generatedContent = "This is the generated content from AI.";
                $('[name="content"]').val(generatedContent);
            });
        })
    </script>
@endpush
