@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Payment List
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
                        {{-- <tr>
                            <td>1</td>
                            <td>Himanshu</td>
                            <td>Gold</td>
                            <td>25/05/2023</td>
                            <td>1496333332</td>
                            <td><button class="btn btn-success btn-sm ">success</button></td>
                            <td><a href="{{ route('admin.invoice') }}" class="btn btn-sm btn-primary text-white">View
                                </a></td>

                        </tr> --}}

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('libraries')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
@endsection

@section('extra_js')
    {{-- <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script> --}}
    <script>
        $(function() {
            // alert('Hello');
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
                    url: "{{ route('admin.payment_ajax_list') }}",
                    "type": "GET",
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
                        'orderable': false
                    },
                    {
                        "targets": 1,
                        "name": "first_name",
                        'searchable': true,
                        'orderable': true
                    },
                    {
                        "targets": 2,
                        "name": "package_name",
                        'searchable': true,
                        'orderable': true
                    },
                    {
                        "targets": 3,
                        "name": "phone",
                        'searchable': false,
                        'orderable': false
                    },

                    {
                        "targets": 4,
                        "name": "from",
                        'searchable': false,
                        'orderable': false
                    },

                    {
                        "targets": 6,
                        "name": "To",
                        'searchable': false,
                        'orderable': false
                    },
                    {
                        "targets": 7,
                        "name": "status",
                        'searchable': false,
                        'orderable': false
                    },




                ]
            });
        })
    </script>
@endsection
