@extends('admin.layout.layouts')
@section('extra_css')
@endsection


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


@section('content')
    <section class="content" style="background:none;">
        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>List</h3>
                        <a href="{{ route('admin.manage_employee')}}" class="btn btn-info" role="button" style="display: flex; justify-content: center; align-items: center;">Add New</a>
                      </div>

                      
                    {{-- <div class="d-flex justify-content-between">
                        List
                        <a class="btn btn-sm btn-primary text-white" href="{{ route('admin.manage_employee') }}">Add
                        New</a>
                    </div> --}}
                </div>

            </div>
        </div>



        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable" id="employee_list">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $index => $admin)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->role }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Info
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.show_permission', $admin->id) }}">Permission</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
