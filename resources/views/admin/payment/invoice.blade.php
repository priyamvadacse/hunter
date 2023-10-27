@extends('admin.layout.layouts')
@section('extra_css')
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .head {
            height: 70px;
            /* background-color: red; */
            /* border-bottom: 1px solid; */
            display: flex;
            box-shadow: 2px 2px rgb(228, 228, 228);
        }

        .logo {
            height: 70px;
            width: 25%;
            /* background-color: green; */
            text-align: center;
            line-height: 70px;
        }

        .navbar {
            height: 70px;
            width: 75%;
            /* background-color:gray; */
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border: 2px solid;
        }

        .color {
            background-color: #e5e5e5;
        }
    </style>
@endsection

@section('content')
    <section  class="content" style="background:none;">

        <div class="col-12">
            <div class="mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Invoice
                        <a href="#" class="btn btn-sm btn-primary text-white " id="printOut">print</a>
                    </div>
                </div>
            </div>
            <div id="pageToPrint" class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row p-5">
                                    <a href="#"><img src="http://127.0.0.1:8000/assets/fonts/logo2.png" width="160px"
                                            height="57px" alt="Real Dating Apps India"></a>
                                    <div class="header col-12 d-flex">
                                        <div class="col-md-7 mt-5">
                                            <h3 class="px-4 " style="font-weight: bold">J.M.D MARRIAGE BEURO PVT LTD.</h3>
                                        </div>

                                        <div class="col-md-5 text-start mt-5 ">
                                            <h3 class="px-4 " style="font-weight: bold">INVOICE</h3>

                                        </div>
                                    </div>

                                    <!-- <hr class="my-5"> -->
                                    <div class="container-fluid">
                                        <div class="row pb-5 p-5 ">
                                            <div class="header col-12 d-flex">
                                                <div class="col-md-7 col-lg-7">
                                                    <!-- <p class="font-weight-bold mb-4">Client Information</p> -->
                                                    <p class="mb-1"><span class="text-muted">Address: </span>
                                                        {{ $getiInvoice->address }}</p>

                                                        <p class="mb-1"><span class="text-muted">Payment Id:
                                                            </span>{{$getiInvoice->r_payment_id}}
                                                        </p>
                                                        <p class="mb-1"><span class="text-muted">Payment Status: </span> SUCCESS</p>

                                                </div>

                                                <div class="col-md-5 col-lg-5 text-start px-5">
                                                    <!-- <p class="font-weight-bold mb-4">Payment Details</p> -->
                                                    <p class="mb-1"><span class="text-muted">Date: </span>&nbsp;
                                                        {{ Carbon\Carbon::parse($getiInvoice->created_at)->format('d-m-Y') }}
                                                    </p>
                                                    {{-- <p class="mb-1"><span class="text-muted">Invoice No. : </span>
                                                        10253642
                                                    </p> --}}
                                                    <p class="mb-1"><span class="text-muted"> Name : </span>
                                                        {{ $getiInvoice->first_name . ' ' . $getiInvoice->last_name }}</p>
                                                    {{-- <p class="mb-1"><span class="text-muted">Customer: </span> RW00001</p> --}}
                                                    <p class="mb-1"><span class="text-muted"> Number : </span>
                                                        {{ $getiInvoice->phone }}
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container-fluid">
                                        <div class="row p-5">
                                            <div class="col-md-12">
                                                <table class="table" border="1">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-0 text-uppercase small font-weight-bold">
                                                                PACKAGE NAME</th>
                                                            <th
                                                                class="border-0 text-uppercase small font-weight-bold text-center">
                                                                TYPE</th>
                                                            <th
                                                                class="border-0 text-uppercase small font-weight-bold text-center">
                                                                CURRENCY</th>
                                                            <th
                                                                class="border-0 text-uppercase small font-weight-bold text-center">
                                                                RATE</th>
                                                            <th
                                                                class="border-0 text-uppercase small font-weight-bold text-center">
                                                                DISCOUNT </th>
                                                            <th
                                                                class="border-0 text-uppercase small font-weight-bold text-center">
                                                                AMOUNT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @php
                                                                $today = date('Y-m-d');
                                                                $getofferdata = \App\Models\Offer::where('package_id', $getiInvoice->package_id)->first();
                                                                
                                                            @endphp
                                                            @if($package->package)   
                                                                <td>{{ $packageName }}</td>
                                                            @else
                                                            <td>{{$packageName .' - '. $package->boost_package }}</td>
                                                            @endif
                                                            <td class="text-center">{{ $getiInvoice->method }}</td>
                                                            <td class="text-center">{{ $getiInvoice->currency }}</td>
                                                            @if ($getofferdata)
                                                                <td>
                                                                    {{ $package->monthly_price }}
                                                                </td>
                                                            @else
                                                                <td> {{ $package->price }}</td>
                                                            @endif

                                                            @if (isset($getofferdata->package_id))
                                                                @if ($getofferdata->type == 'pr')
                                                                    <td class="text-center">{{ (int)$getofferdata->price . '%' }}
                                                                    </td>
                                                                @else
                                                                    <td class="text-center">{{ $getofferdata->price }}</td>
                                                                @endif
                                                            @else
                                                                <td class="text-center">-</td>
                                                            @endif

                                                            @if ($getofferdata)
                                                                <td class="text-center">
                                                                    {{$getiInvoice->amount}}
                                                                    {{-- {{ $getofferdata->type == 'am' ? $package->monthly_price - $getofferdata->price : $package->monthly_price - ($package->monthly_price * $getofferdata->price) / 100 }} --}}
                                                                </td>
                                                            @else
                                                                <td class="text-center">
                                                                    {{ $package->price }}
                                                                </td>
                                                            @endif
                                                        </tr>

                                                    </tbody>

                                                </table>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse color text-dark p-4">
                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2">Grand Total</div>
                                        @if ($getofferdata)
                                        <div class="h2 font-weight-light">{{$getiInvoice->amount}}</div>
                                        @else
                                        <div class="h2 font-weight-light">{{$getiInvoice->amount}}</div>
                                        @endif
                                    </div>


                                    {{-- <div class="py-3 px-5 text-right">
                                        <div class="mb-2"> IGST(%)</div>

                                        <div class="h2 font-weight-light">18%</div>

                                    </div>

                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2"> SGST(%)</div>

                                        <div class="h2 font-weight-light">9%</div>

                                    </div>

                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2"> GST(%)</div>

                                        <div class="h2 font-weight-light">9%</div>

                                    </div> --}}


                                    <div class="py-3 px-5 text-right">
                                        <div class="mb-2">Sub - Total amount</div>
                                        <div class="h2 font-weight-light">{{$getiInvoice->amount}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Use jQuery to handle print functionality
    $(document).ready(function() {
            $('#printOut').on('click', function(e) {
                e.preventDefault();
                var printContents = $('#pageToPrint').html();
                var originalContents = $('body').html();
                $('body').empty().html(printContents);
                window.print();
                $('body').html(originalContents);
            });
        });
</script>
@endsection
