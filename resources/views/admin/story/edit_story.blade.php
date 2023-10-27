@extends('admin.layout.layouts')
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.css') }}" />
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">

                    <h3 class="mb-1" style="color: #c8164e">Edit Story </h3>
                </div>
            </div>
            <div class="card">                
                <form class="edit_story" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Story Title" name="edit_title" value="{{$getStory->title}}">
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" value="{{$getStory->id}}">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Story Image</label>
                                <input type="file" class="form-control" name="story_image_edit" onchange="stocks(this);">
                            </div>                            
                        </div>
                        
                        
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Story Description</label>
                                <textarea name="story_description_edit" class="form-control" id="summernote" cols="30" rows="2" >{{ $getStory->story_description }}</textarea>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                               
                                <img src="{{url($getStory->story_image)}}" alt="Best Online Dating Sites India" class="img-fluid" id="previewImage" width="250px;">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>
    </section>
@endsection
@section('extra_js')
    <script src="{{ asset('assets/admin/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 200
        })

        function stocks(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('.edit_story').on('submit',function(e) {
                e.preventDefault();
                let fd = new FormData(this);
                fd.append('_token', "{{ csrf_token() }}");
                
                $.ajax({                    
                    url: "{{route('admin.update_story')}}",
                    type: "post",
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    
                    success: function(result) {
                        
                        if (result.status) {
                            iziToast.success({
                                title: '',
                                message: result.msg,
                                position: 'topRight'
                            });
                            setTimeout(function() {
                                window.location.href = result.location;
                            }, 500);
                        } else {
                            iziToast.error({
                                title: '',
                                message: result.msg,
                                position: 'topRight'
                            });
                        }
                    },
                    complete: function() {
                        $('.loader').hide();
                    },
                    error: function(jqXHR, exception) {
                        $('.loader').hide();
                        console.log(jqXHR.responseText);
                    }
                })
            });
        });
    </script>
@endsection
