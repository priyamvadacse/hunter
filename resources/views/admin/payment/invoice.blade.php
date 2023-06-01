@extends('admin.layout.layouts')
@section('extra_css')
@endsection

@section('content')
    <section class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Invoice
                        <a href="{{ route('admin.payment') }}" class="btn btn-sm btn-primary text-white">Back</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
               <h1 class="text-center">Invoice Page</h1>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
   <script></script>
    @endsection
