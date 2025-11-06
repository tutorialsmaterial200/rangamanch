@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Video Gallery') }}</h1>
            <div class="section-header-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addVideoModal">
                    <i class="fas fa-plus"></i> {{ __('admin.Add New Video') }}
                </button>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Video List') }}</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Title') }}</th>
                                <th>{{ __('admin.Video URL') }}</th>
                                <th>{{ __('admin.Language') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                                <tr>
                                    <td>{{ $video->title }}</td>
                                    <td>
                                        <div class="video-preview">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-info preview-video" 
                                               data-url="{{ $video->video_url }}"
                                               data-toggle="modal" 
                                               data-target="#videoPreviewModal">
                                               <i class="fas fa-play"></i> Play Video
                                            </a>
                                            <a href="{{ $video->video_url }}" target="_blank" class="btn btn-sm btn-link">
                                                {{ Str::limit($video->video_url, 30) }}
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ $video->language->name }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input video-status" 
                                                id="status_{{ $video->id }}" 
                                                data-id="{{ $video->id }}" 
                                                {{ $video->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status_{{ $video->id }}">
                                                <span class="status-text">{{ $video->status ? __('admin.Active') : __('admin.Inactive') }}</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary edit-video" 
                                            data-id="{{ $video->id }}"
                                            data-title="{{ $video->title }}"
                                            data-url="{{ $video->video_url }}"
                                            data-language="{{ $video->language_id }}"
                                            data-toggle="modal" 
                                            data-target="#editVideoModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-video" data-id="{{ $video->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('admin.No videos found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="float-right">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Add Video Modal -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" role="dialog" aria-labelledby="addVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVideoModalLabel">{{ __('admin.Add New Video') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addVideoForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('admin.Title') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Video URL') }} <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="video_url" required>
                            <small class="text-muted">{{ __('admin.Enter YouTube or other video platform URL') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Language') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="language_id" required>
                                <option value="">{{ __('admin.Select Language') }}</option>
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Status') }}</label>
                            <select class="form-control" name="status">
                                <option value="1">{{ __('admin.Active') }}</option>
                                <option value="0">{{ __('admin.Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Video Modal -->
    <div class="modal fade" id="editVideoModal" tabindex="-1" role="dialog" aria-labelledby="editVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVideoModalLabel">{{ __('admin.Edit Video') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editVideoForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="video_id" id="edit_video_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('admin.Title') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="edit_title" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Video URL') }} <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="video_url" id="edit_video_url" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Language') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="language_id" id="edit_language_id" required>
                                <option value="">{{ __('admin.Select Language') }}</option>
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('admin.Status') }}</label>
                            <select class="form-control" name="status" id="edit_status">
                                <option value="1">{{ __('admin.Active') }}</option>
                                <option value="0">{{ __('admin.Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('admin.Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Video Preview Modal -->
    <div class="modal fade" id="videoPreviewModal" tabindex="-1" role="dialog" aria-labelledby="videoPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="videoPreviewFrame" class="embed-responsive-item" src="" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function getEmbedUrl(url) {
        // YouTube URL patterns
        var youtubeRegex = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var youtubeMatch = url.match(youtubeRegex);
        
        if (youtubeMatch && youtubeMatch[2].length == 11) {
            return 'https://www.youtube.com/embed/' + youtubeMatch[2];
        }
        
        // Vimeo URL patterns
        var vimeoRegex = /(?:vimeo)\.com.*(?:videos|video|channels|)\/([\d]+)/i;
        var vimeoMatch = url.match(vimeoRegex);
        
        if (vimeoMatch) {
            return 'https://player.vimeo.com/video/' + vimeoMatch[1];
        }
        
        // Return original URL if no patterns match
        return url;
    }

    $(document).ready(function() {
        // Add Video Form Submit
        $('#addVideoForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: "{{ route('admin.video.store') }}",
                type: "POST",
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(response) {
                    if(response.success) {
                        $('#addVideoModal').modal('hide');
                        form[0].reset();
                        Toast.fire({
                            icon: 'success',
                            title: '{{ __("admin.Video added successfully") }}'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.error;
                    $.each(errors, function(key, value) {
                        Toast.fire({
                            icon: 'error',
                            title: value[0]
                        });
                    });
                }
            });
        });

        // Edit Video
        $('.edit-video').click(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var url = $(this).data('url');
            var language = $(this).data('language');
            
            $('#edit_video_id').val(id);
            $('#edit_title').val(title);
            $('#edit_video_url').val(url);
            $('#edit_language_id').val(language);
        });

        // Update Video Form Submit
        $('#editVideoForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var id = $('#edit_video_id').val();
            
            $.ajax({
                url: "{{ url('admin/video') }}/" + id,
                type: "PUT",
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(response) {
                    if(response.success) {
                        $('#editVideoModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: '{{ __("admin.Video updated successfully") }}'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.error;
                    $.each(errors, function(key, value) {
                        Toast.fire({
                            icon: 'error',
                            title: value[0]
                        });
                    });
                }
            });
        });

        // Delete Video
        $('.delete-video').click(function() {
            var id = $(this).data('id');
            
            Swal.fire({
                title: '{{ __("admin.Are you sure?") }}',
                text: "{{ __('admin.You won\'t be able to revert this!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("admin.Yes, delete it!") }}',
                cancelButtonText: '{{ __("admin.Cancel") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/video') }}/" + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if(response.success) {
                                Toast.fire({
                                    icon: 'success',
                                    title: '{{ __("admin.Video deleted successfully") }}'
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            }
                        }
                    });
                }
            });
        });

        // Toggle Status
        $('.video-status').change(function() {
            var id = $(this).data('id');
            var status = $(this).prop('checked') ? 1 : 0;
            var label = $(this).siblings('.custom-control-label').find('.status-text');
            
            $.ajax({
                url: "{{ url('admin/video') }}/" + id,
                type: "PUT",
                data: {
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                success: function(response) {
                    if(response.success) {
                        label.text(status ? '{{ __("admin.Active") }}' : '{{ __("admin.Inactive") }}');
                        Toast.fire({
                            icon: 'success',
                            title: '{{ __("admin.Status updated successfully") }}'
                        });
                    }
                }
            });
        });

        // Video Preview
        $('.preview-video').click(function() {
            var videoUrl = $(this).data('url');
            var embedUrl = getEmbedUrl(videoUrl);
            $('#videoPreviewFrame').attr('src', embedUrl);
        });

        // Clear iframe src when modal is closed
        $('#videoPreviewModal').on('hidden.bs.modal', function () {
            $('#videoPreviewFrame').attr('src', '');
        });
    });
</script>
@endpush
