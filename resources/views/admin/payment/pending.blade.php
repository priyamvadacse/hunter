@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Pending List 
                        {{-- <a  href="{{route('admin.invoice')}}" class="btn btn-sm btn-primary text-white" >invoice
                        </a> --}}
                    </div>
                </div>

            </div>
            <div class="card">
                <table class="table table-bordered table-striped" id="kyc_verified_user">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Transaction Id</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Invoice</th>



                        </tr>


                    </thead>



                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Himanshu</td>
                            <td>Gold</td>
                            <td>25/05/2023</td>
                            <td>1496333332</td>
                            <td><button class="btn btn-danger btn-sm ">Pending</button></td>
                            <td><a  href="{{route('admin.invoice')}}" class="btn btn-sm btn-primary text-white" >View
                            </a></td>
                            
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Khushi</td>
                            <td>VIP</td>
                            <td>25/05/2023</td>
                            <td>1474123785</td>
                            <td><button class="btn btn-danger btn-sm ">Pending</button></td>
                            <td><a  href="{{route('admin.invoice')}}" class="btn btn-sm btn-primary text-white" >View
                            </a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Priyamvada</td>
                            <td>Silver</td>
                            <td>25/05/2023</td>
                            <td>1469874123</td>
                            <td><button class="btn btn-danger btn-sm ">Pending</button></td>
                            <td><a  href="{{route('admin.invoice')}}" class="btn btn-sm btn-primary text-white" >View
                            </a></td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
    <script>
        $(function() {
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
                    url: "{{ route('admin.kyc.verified-user-ajax') }}",
                    "type": "POST",
                    "data": function(d) {
                        d._token = "{{ csrf_token() }}";
                    },
                    dataFi
                    lter: function(data) {
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
                        'searchable': false,
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
                        'orderable': false,
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
