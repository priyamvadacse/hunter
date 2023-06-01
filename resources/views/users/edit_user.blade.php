@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div class="">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    Edit Users
                </div>
            </div>
            <div class="card">
                {{-- <form class="add_user" method="POST" action="{{ route('admin.add.user') }}" enctype="multipart/form-data"> --}}
                <form class="edit_user" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" value="{{ $user->first_name }}"
                                    placeholder="Enter First Name" name="first_name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" value="{{ $user->last_name }}"
                                    placeholder="Enter Last Name" name="last_name">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Profile Pic</label>
                                <input type="file" class="form-control" name="pic1" onchange="stocks(this);">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row justify-content-left">
                                <div class="col-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <img class="img-thumbnail image-width mt-4 mb-3" id="previewImage"
                                            src="{{ asset($user->pic1) }}" width="150px;" alt="your image" />
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Location</label>
                        <input type="text" class="form-control" placeholder="Enter Address">
                      </div> --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" value="{{ $user->email }}" class="form-control"
                                    placeholder="Enter Email" name="email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="number" class="form-control" value="{{ $user->phone }}"
                                    placeholder="Enter Phone" name="phone">
                                <input type="hidden" class="form-control" value="{{ $user->id }}"
                                    placeholder="Enter Phone" name="id">
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">D.O.B</label>
                                <input type="date" class="form-control" value="{{ $user->dob }}"
                                    placeholder="Enter D.O.B" name="dob">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Select Gender*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="gender">

                                    <option value="Male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Status*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="status">
                                    <option value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Interested In*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select"
                                    name="interested_in">
                                    <option value="Male" {{ $user->interested_in == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="Female" {{ $user->interested_in == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="Other" {{ $user->interested_in == 'other' ? 'selected' : '' }}>Both
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Right Now I Am Looking For*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="relationship_type">
                                    <option value="0" {{ $user->relationship_type == '0' ? 'selected' : '' }}>Long-Term Partner</option>
                                    <option value="1" {{ $user->relationship_type == '1' ? 'selected' : '' }}>Long-Term Open To Short</option>
                                    <option value="2" {{ $user->relationship_type == '2' ? 'selected' : '' }}>Short-Term Open To Long</option>
                                    <option value="3" {{ $user->relationship_type == '3' ? 'selected' : '' }}>Short-Term Fun</option>
                                    <option value="4" {{ $user->relationship_type == '4' ? 'selected' : '' }}>New Friends</option>
                                    <option value="5" {{ $user->relationship_type == '5' ? 'selected' : '' }}>Still Figuring It Out</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


@section('extra_js')
    <script>

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

            $('.edit_user').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.update.user') }}",
                    type: "POST",
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#login-button').prop('disabled', true);
                        $('.loader').show();
                    },
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
                });
            })
        });
    </script>
@endsection
@endsection
