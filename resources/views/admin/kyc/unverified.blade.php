@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Unverified List
                        {{-- <a class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#usermodal">Verifide --}}
                            {{-- Offers</a> --}}
                    </div>
                </div>

            </div>
            <div class="card">
                <table class="table table-bordered table-striped" id="kyc_verified_user">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Aadhar</th>
                            <th scope="col">Pan</th>
                            <th scope="col">Isverified</th>



                        </tr>

                    </thead>
                    <tr>
                        <td>1</td>
                        <td>Vikas</td>
                        <td><img src="{{asset('front/images/kyc/aadhar.jpg')}}" alt="aadhar"></td>
                        <td><img src="{{asset('front/images/kyc/pan.jpg')}}" alt="Pan"></td>
                        <td>Unverified</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Ram</td>
                        <td><img src="{{asset('front/images/kyc/aadhar1.jpg')}}" alt="dfgh"></td>
                        <td><img src="{{asset('front/images/kyc/pan1.jpg')}}" alt="pan"></td>
                        <td>Unverified</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Himanshu</td>
                        <td><img src="{{asset('front/images/kyc/aadhar.jpg')}}" alt="aadher"></td>
                        <td><img src="{{asset('front/images/kyc/pan.jpg')}}" alt="pan"></td>
                        <td>Unverified</td>
                    </tr>


                    <tbody>
                        

                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

@section('extra_js')
<script>

$(function(){
    //alert('Hello');
    //kyc verified  datatable code
    $('#kyc_verified_user').DataTable({
               "processing": true,
                pageLength: 10,
                "serverSide": true,
                "bDestroy": true,
                'checkboxes': {
                    'selectRow': true
                },
                "ajax": {
                    url: "{{route('admin.kyc.verified-user-ajax')}}",
                    "type": "POST",
                    "data": function(d) {
                        d._token = "{{ csrf_token() }}";
                    },
                    dataFilter: function(data) {
                        var json = jQuery.parseJSON(data);
                        json.recordsTotal = json.recordsTotal;
                        json.recordsFiltered = json.recordsFiltered;
                        json.data = json.data;
                        return JSON.stringify(json); // return JSON string
                    }
                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "targets": 0,
                        "name": "id",
                        'searchable': false,
                        'orderable': true
                    },
                    {
                        "targets": 1,
                        "name": "user_id",
                        'searchable': true,
                        'orderable': false
                    },
                    {
                        "targets": 2,
                        "name": "aadhar",
                        'searchable':false,
                        'orderable': false
                    },
                    {
                        "targets": 3,
                        "name": "pan",
                        'searchable': false,
                        'orderable': false
                    },

                    {
                        "targets": 4,
                        "name": "is_verify",
                        'searchable': false,
                        'orderable':false,
                    },
                    // {
                    //     "targets": 5,
                    //     "name": "description",
                    //     'searchable': false,
                    //     'orderable': false
                    // },
                    // {
                    //     "targets": 6,
                    //     "name": "status",
                    //     'searchable': false,
                    //     'orderable': false
                    // },
                    // {
                    //     "targets": 7,
                    //     "name": "action",
                    //     'searchable': false,
                    //     'orderable': false
                    // },
                   


                ]
    })
})
</script>  
@endsection
