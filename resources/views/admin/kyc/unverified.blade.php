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
                <table class="table table-bordered table-striped" id="kyc_unverified_user">
                    <thead class="table-warning">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection


@section('libraries')
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
@endsection

@section('extra_js')

    <script>
        $(function() {
            
            $('#kyc_unverified_user').DataTable({
                "processing": true,
                pageLength: 10,
                "serverSide": true,
                "bDestroy": true,
                'checkboxes': {
                    'selectRow': true
                },
                "ajax": {
                    url: "{{ route('admin.kyc.unverified_listuser-ajax') }}",                    
                   
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
                        "name": "first_name",
                        'searchable': true,
                        'orderable': false
                    },
                    {
                        "targets": 2,
                        "name": "image",
                        'searchable': false,
                        'orderable': false
                    },
                    {
                        "targets": 3,
                        "name": "email",
                        'searchable': true,
                        'orderable': true
                    },

                    {
                        "targets": 4,
                        "name": "phone",
                        'searchable': true,
                        'orderable': true,
                    },
                  
                    {
                        "targets": 5,
                        "name": "status",
                        'searchable': false,
                        'orderable': false,
                    },

                ]
            })
        })
    </script>
@endsection
