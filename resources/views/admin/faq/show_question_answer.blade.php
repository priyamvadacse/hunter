@extends('admin.layout.layouts')
@section('extra_css')
<link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/summernote/summernote-bs4.css')}}" />


@endsection

@section('content')
    <section class="contact" style="background:none;">
        <section class="content" style="background:none;">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Add Question And Aswer
                        <a   href="{{route('admin.faqpage')}}"  class="btn btn-sm btn-primary text-white" >Add</a>
                    </div>
                </div>
               <table class="table">
                 <thead>
                    
                    <tr>
                        <th>S.No</th>
                        <th>Question</th>
                        <th>Active</th>
                        <th>Action</th>
                        
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($getdata as $key=> $item )
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->question}}</td>
                        <td><a href="" class="{{$item->status == 0 ? 'btn btn-success' : 'btn btn-danger'}} btn-sm fqclick"  data-status="{{($item->status == 1  ? '0' : '1' )}}" data-id="{{$item->id}}">{{$item->status == 0 ? 'Active' : 'Inactive'}}</a></td>
                        <td><a href="{{route('admin.editpage',$item->id)}}" class="btn btn-success btn-sm">Edit</a> <a href="{{route('admin.delatefaq', $item->id)}}" class="btn btn-success btn-sm">Delete</a></td>
                    </tr>
                    @endforeach
                 </tbody>
               </table>
               
              </div>
        </section>
    @endsection

    @section('extra_js')
    <script>
        $("body").on("click", ".fqclick", function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var status = $(this).data('status');
            // alert(id);
            // false;
            let fd = new FormData()
            fd.append('_token', "{{ csrf_token() }}");
            fd.append('status', status);
            fd.append('id', id);
            $.confirm({
                title: 'Confirm!',
                content: 'Sure you want to change status?',
                buttons: {
                    yes: function () {
                        $.ajax({
                            url: "{{ route('admin.change-status') }}",
                            type: 'POST',
                            data: fd,
                            dataType: "JSON",
                            contentType: false,
                            processData: false,
                        })
                            .done(function (result) {
                                if (result.status) {
                                    iziToast.success({
                                        title: '',
                                        message: result.msg,
                                        position: 'topRight'
                                        
                                    });
                                    // $('.fqclick').ajax.reload(null, false);
                                    setTimeout(function() {
                            window.location.reload();
                        }, 2000);


                                } else {
                                    iziToast.error({
                                        title: '',
                                        message: result.msg,
                                        position: 'topRight'
                                    });
                                }
                            })
                            .fail(function (jqXHR, exception) {
                                console.log(jqXHR.responseText);
                            })


                    },
                    no: function () {
                    },
                }
            })
        })
    </script>

@endsection





