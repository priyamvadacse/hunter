@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">
        {{-- <div>
            <h2> --}}
                <center> Module permission</center>
            {{-- </h2>
        </div> --}}
        <div class="card-body"> 
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5> User Operation</h5>
                </div>
                <div class="col">
                   <center> <h5> Action</h5></center>
                </div>
            </div>

        </div>
        <form id="form_submit">
            <input type="hidden" name="id" id="id" value="{{$id}}">
            <table class="table">
                <thead>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>

                            <td>{{ $permission->module_name }}</td>
                            <td>
                           
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="permission" value="{{$permission->permission}}" name="{{$permission->module_name}}" {{ $permission->permission == 1 ? "checked" : '' }}/>                            
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> <br><br>
            
            <button type="submit" class="btn btn-primary">Save Permission</button>
        </form>
    </div >
    {{-- @endsection --}}
   
</section>
@endsection

@section('extra_js')
    <script>
        $(function() {

            $('#form_submit').on('submit', function(e) {
                e.preventDefault()
                let fd = new FormData(this)
                // var id = $('#id').val();
                fd.append('_token', "{{ csrf_token() }}");
                // fd.append('id',id)
                $.ajax({
                    url: "{{ route('admin.update_Permission') }}",
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
