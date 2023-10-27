@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
           <div class="mb-4">
                <div class="card-header">
                    <h3 class="mb-1" style="color: #c8164e">Add Employee</h3>
                </div>
            </div>
            <div class="card">
                <form class="addEmployee" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" placeholder="Enter Your Name" name="name"
                                    required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Your Email " name="email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Enter Your Password"
                                    name="password" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" required
                                    name="role">
                                    <option value="">Select Role</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
    <script>
        $(function() {

            $('.addEmployee').on('submit', function(e) {
                e.preventDefault()

                let fd = new FormData(this)
                fd.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('admin.store_employee') }}",
                    type: "POST",
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#login-button').prop('disabled', true);
                        $('.loader').show();
                    },
                    success: function(data) {
                        // console.log(success.location);
                        window.location.href = data.location;
                           
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
