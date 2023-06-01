@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Paid User List 
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
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Interested In</th>
                            <th scope="col">Date</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>




                        </tr>


                    </thead>



                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Himanshu</td>
                            <td>Pandey</td>
                            <td>himanshu@gmail.com</td>
                            <td>7896451263</td>
                            <td>M</td>
                            <td>F</td>
                            <td>25/05/2023</td>
                            <td>Paid</td>
                            <td>ACTIVE</td>
                            <td><button class="btn btn-success btn-sm ">Edit</button><button class="btn btn-success btn-sm ">Delete</button></td>
                            
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Golu</td>
                            <td>Dube</td>
                            <td>golu@gmail.com</td>
                            <td>9696451263</td>
                            <td>M</td>
                            <td>F</td>
                            <td>23/03/2023</td>
                            <td>Paid</td>
                            <td>ACTIVE</td>
                            <td><button class="btn btn-success btn-sm ">Edit</button><button class="btn btn-success btn-sm ">Delete</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Vikas</td>
                            <td>Mishra</td>
                            <td>vikas@gmail.com</td>
                            <td>9896451263</td>
                            <td>M</td>
                            <td>F</td>
                            <td>21/04/2023</td>
                            <td>Paid</td>
                            <td>ACTIVE</td>
                            <td><button class="btn btn-success btn-sm ">Edit</button><button class="btn btn-success btn-sm ">Delete</button></td>
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
