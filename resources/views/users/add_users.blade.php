@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    
                    <h3 class="mb-1" style="color: #c8164e">Add User</h3>
                </div>
            </div>
            <div class="card">
                {{-- <form class="add_user" method="POST" action="{{ route('admin.add.user') }}" enctype="multipart/form-data"> --}}
                <form class="adduser" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="first_name">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="last_name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Profile Pic</label>
                                <input type="file" class="form-control" placeholder="Enter Name" name="pic1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" placeholder="Enter Email" name="email">
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
                                <label for="exampleInputEmail1">D.O.B</label>
                                <input type="date" class="form-control" placeholder="Enter D.O.B" name="dob">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="number" class="form-control" placeholder="Enter Phone" name="phone">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Select Gender*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="gender">

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Interested In*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="interested_in">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Both</option>
                                </select>
                            </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Status*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="status">
                                    <option value="ACTIVE">Active</option>
                                    <option value="INACTIVE">Inactive</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Right Now I Am Looking For*</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="relationship_type">
                                    <option value="0">Long-Term Partner</option>
                                    <option value="1">Long-Term Open To Short</option>
                                    <option value="2">Short-Term Open To Long</option>
                                    <option value="3">Short-Term Fun</option>
                                    <option value="4">New Friends</option>
                                    <option value="5">Still Figuring It Out</option>

                                </select>
                            </div>
                        </div>
                      </div>




                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                </form>
            </div>
        </div>
    </section>
@endsection
@section('extra_js')
    <script>
        $(function() {

            $('.adduser').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.add.user') }}",
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
                            showSuccessMsg(result.msg)
                            setTimeout(function() {
                                window.location.href = result.location;
                            }, 500);
                        } else {
                            showErrorMsg(result.msg)
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

