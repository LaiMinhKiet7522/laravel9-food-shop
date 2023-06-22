@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Admin Dashboard
@endsection
@php
    $monday = strtotime('last monday');
    $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;

    $sunday = strtotime(date('Y-m-d', $monday) . ' +6 days');

    $this_week_start = date('Y-F-d', $monday);
    $this_week_end = date('Y-F-d', $sunday);

    $date_explode_start = explode('-', $this_week_start);
    $date_explode_end = explode('-', $this_week_end);

    $start_day = $date_explode_start[2];
    $start_month = $date_explode_start[1];
    $start_year = $date_explode_start[0];

    $end_day = $date_explode_end[2];
    $end_month = $date_explode_end[1];
    $end_year = $date_explode_end[0];

    $sales_week = \App\Models\Order::where('order_year', '=', $start_year)
        ->where('order_year', '=', $end_year)
        ->where('order_month', '=', $start_month)
        ->where('order_month', '=', $end_month)
        ->where('order_day', '>=', $start_day)
        ->where('order_day', '<=', $end_day)
        ->where('return_order_status', 0)
        ->where('cancel_order_status', 0)
        ->where('status', 'delivered')
        ->sum('amount');

    $date = date('d F Y');
    $date_format = explode(' ', $date);
    $date_day = $date_format[0];
    $date_month = $date_format[1];
    $date_year = $date_format[2];

    $sales_today = \App\Models\Order::where('order_year', '=', $date_year)
        ->where('order_month', '=', $date_month)
        ->where('order_day', '=', $date_day)
        ->where('return_order_status', 0)
        ->where('cancel_order_status', 0)
        ->where('status', 'delivered')
        ->sum('amount');

    $month = date('F');
    $sales_month = \App\Models\Order::where('order_month', $month)
        ->where('return_order_status', 0)
        ->where('cancel_order_status', 0)
        ->where('status', 'delivered')
        ->sum('amount');

    $year = date('Y');
    $sales_year = \App\Models\Order::where('order_year', $year)
        ->where('return_order_status', 0)
        ->where('cancel_order_status', 0)
        ->where('status', 'delivered')
        ->sum('amount');

    $pending_orders = \App\Models\Order::where('status', 'pending')
        ->where('cancel_order_status', 0)
        ->count();

    $success_orders = \App\Models\Order::where('status', 'delivered')
        ->where('cancel_order_status', 0)
        ->where('return_order_status', 0)
        ->count();

    $vendor_active = \App\Models\User::where('role', 'vendor')
        ->where('status', 'active')
        ->count();

    $user_active = \App\Models\User::where('role', 'user')
        ->where('status', 'active')
        ->count();
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-moonlit">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $sales_today }} USD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">SALES TODAY</p>
                        {{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $sales_week }} USD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">SALES THIS WEEK</p>
                        {{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $sales_month }} USD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">SALES THIS MONTH</p>
                        {{-- <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $sales_year }} USD</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">SALES THIS YEAR</p>
                        {{-- <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-lush">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $success_orders }}</h5>
                        <div class="ms-auto">
                            <i class='bx bxs-wallet fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">ALL ORDER SUCCESSFUL DELIVERY</p>
                        {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-kyoto">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $pending_orders }}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">ALL PENDING ORDERS</p>
                        {{-- <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $vendor_active }}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-user-pin fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">ALL VENDORS ARE ACTIVE</p>
                        {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-cosmic">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $user_active }}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-group fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">ALL USERS ARE ACTIVE</p>
                        {{-- <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $orders = \App\Models\Order::where('status', 'pending')
            ->where('cancel_order_status', 0)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
    @endphp
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">ORDERS SUMMARY</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Order Date</th>
                            <th>Invoice Number</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->invoice_number }}</td>
                                <td>${{ $order->amount }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td> <span class="badge rounded-pill bg-warning" style="font-size: 13px;">
                                        Pending</span></td>
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Order Date</th>
                            <th>Invoice Number</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Site Traffic</h6>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #14abef"></i>New Visitor</span>
                        <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                style="color: #ade2f9"></i>Old Visitor</span>
                    </div>
                    <div class="chart-container-1">
                        <canvas id="chart1"></canvas>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">45.87M</h5>
                            <small class="mb-0">Overall Visitor <span> <i
                                        class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">15:48</h5>
                            <small class="mb-0">Visitor Duration <span> <i
                                        class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3">
                            <h5 class="mb-0">245.65</h5>
                            <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                                    5.62%</span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 col-xl-4 d-flex">
            <div class="card radius-10 overflow-hidden w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Weekly sales</h6>
                        </div>
                        <div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <div class="chart-container-2 my-3">
                        <canvas id="chart2"></canvas>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <tr>
                                <td><i class="bx bxs-circle me-2" style="color: #14abef"></i> Direct</td>
                                <td>$5856</td>
                                <td>+55%</td>
                            </tr>
                            <tr>
                                <td><i class="bx bxs-circle me-2" style="color: #02ba5a"></i>Affiliate</td>
                                <td>$2602</td>
                                <td>+25%</td>
                            </tr>
                            <tr>
                                <td><i class="bx bxs-circle me-2" style="color: #d13adf"></i>E-mail</td>
                                <td>$1802</td>
                                <td>+15%</td>
                            </tr>
                            <tr>
                                <td><i class="bx bxs-circle me-2" style="color: #fba540"></i>Other</td>
                                <td>$1105</td>
                                <td>+5%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->

    <div class="row row-cols-1 row-cols-lg-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="w_chart easy-dash-chart1" data-percent="60">
                            <span class="w_percent"></span>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Facebook Followers</h6>
                            <small class="mb-0">22.14% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last
                                Week</small>
                        </div>
                        <div class="ms-auto fs-1 text-facebook"><i class='bx bxl-facebook'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="w_chart easy-dash-chart2" data-percent="65">
                            <span class="w_percent"></span>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Twitter Tweets</h6>
                            <small class="mb-0">32.15% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last
                                Week</small>
                        </div>
                        <div class="ms-auto fs-1 text-twitter"><i class='bx bxl-twitter'></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="w_chart easy-dash-chart3" data-percent="75">
                            <span class="w_percent"></span>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Youtube Subscribers</h6>
                            <small class="mb-0">58.24% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last
                                Week</small>
                        </div>
                        <div class="ms-auto fs-1 text-youtube"><i class='bx bxl-youtube'></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-6">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">World Selling Region</h6>
                        </div>
                        <div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <div id="dashboard-map" style="height: 330px;"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-items-center">
                        <thead class="table-light">
                            <tr>
                                <th>Country</th>
                                <th>Income</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="flag-icon flag-icon-ca me-2"></i> USA</td>
                                <td>$4,586</td>
                                <td><span id="trendchart1"></span></td>
                            </tr>
                            <tr>
                                <td><i class="flag-icon flag-icon-us me-2"></i>Canada</td>
                                <td>$2,089</td>
                                <td><span id="trendchart2"></span></td>
                            </tr>

                            <tr>
                                <td><i class="flag-icon flag-icon-in me-2"></i>India</td>
                                <td>$3,039</td>
                                <td><span id="trendchart3"></span></td>
                            </tr>

                            <tr>
                                <td><i class="flag-icon flag-icon-gb me-2"></i>UK</td>
                                <td>$2,309</td>
                                <td><span id="trendchart4"></span></td>
                            </tr>

                            <tr>
                                <td><i class="flag-icon flag-icon-de me-2"></i>Germany</td>
                                <td>$7,209</td>
                                <td><span id="trendchart5"></span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-12 col-xl-6">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card radius-10 overflow-hidden">
                        <div class="card-body">
                            <p>Page Views</p>
                            <h4 class="mb-0">8,293 <small class="font-13">5.2% <i
                                        class="zmdi zmdi-long-arrow-up"></i></small></h4>
                        </div>
                        <div class="chart-container-2">
                            <canvas id="chart3"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card radius-10 overflow-hidden">
                        <div class="card-body">
                            <p>Total Clicks</p>
                            <h4 class="mb-0">7,493 <small class="font-13">1.4% <i
                                        class="zmdi zmdi-long-arrow-up"></i></small></h4>
                        </div>
                        <div class="chart-container-2">
                            <canvas id="chart4"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <p class="mb-4">Total Downloads</p>
                            <input class="knob" data-width="190" data-height="190" data-readOnly="true"
                                data-thickness=".2" data-angleoffset="90" data-linecap="round"
                                data-bgcolor="rgba(0, 0, 0, 0.08)" data-fgcolor="#843cf7" data-max="15000"
                                value="8550" />
                            <hr>
                            <p class="mb-0 small-font text-center">3.4% <i class="zmdi zmdi-long-arrow-up"></i> since
                                yesterday</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card radius-10">
                        <div class="card-body">
                            <p>Device Storage</p>
                            <h4 class="mb-3">42620/50000</h4>
                            <hr>
                            <div class="progress-wrapper mb-4">
                                <p>Documents <span class="float-right">12GB</span></p>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-success" style="width:80%"></div>
                                </div>
                            </div>

                            <div class="progress-wrapper mb-4">
                                <p>Images <span class="float-right">10GB</span></p>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-danger" style="width:60%"></div>
                                </div>
                            </div>

                            <div class="progress-wrapper mb-4">
                                <p>Mails <span class="float-right">5GB</span></p>
                                <div class="progress" style="height:5px;">
                                    <div class="progress-bar bg-primary" style="width:40%"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Row-->

    <div class="row">
        <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card radius-10 overflow-hidden w-100">
                <div class="card-body">
                    <p>Total Earning</p>
                    <h4 class="mb-0">$287,493</h4>
                    <small>1.4% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>
                    <hr>
                    <p>Total Sales</p>
                    <h4 class="mb-0">$87,493</h4>
                    <small>5.43% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>
                    <div class="mt-5">
                        <div class="chart-container-4">
                            <canvas id="chart5"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header border-bottom bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Customer Review</h6>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('adminbackend/assets/images/avatars/avatar-1.png') }}"
                                alt="user avatar" class="rounded-circle" width="55" height="55">
                            <div class="ms-3">
                                <h6 class="mb-0">iPhone X <small class="ms-4">08.34 AM</small></h6>
                                <p class="mb-0 small-font">Sara Jhon : This is svery Nice phone in low
                                    budget.</p>
                            </div>
                            <div class="ms-auto star">
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-light-4'></i>
                                <i class='bx bxs-star text-light-4'></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('adminbackend/assets/images/avatars/avatar-2.png') }}"
                                alt="user avatar" class="rounded-circle" width="55" height="55">
                            <div class="ms-3">
                                <h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
                                <p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
                            </div>
                            <div class="ms-auto star">
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-light-4'></i>
                                <i class='bx bxs-star text-light-4'></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('adminbackend/assets/images/avatars/avatar-3.png') }}"
                                alt="user avatar" class="rounded-circle" width="55" height="55">
                            <div class="ms-3">
                                <h6 class="mb-0">Mackbook Pro <small class="ml-4">06.45 AM</small></h6>
                                <p class="mb-0 small-font">Jhon Doe : Excllent product and awsome quality
                                </p>
                            </div>
                            <div class="ms-auto star">
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-light-4'></i>
                                <i class='bx bxs-star text-light-4'></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('adminbackend/assets/images/avatars/avatar-4.png') }}"
                                alt="user avatar" class="rounded-circle" width="55" height="55">
                            <div class="ms-3">
                                <h6 class="mb-0">Air Pod <small class="ml-4">08.34 AM</small></h6>
                                <p class="mb-0 small-font">Christine : The brand apple is original !</p>
                            </div>
                            <div class="ms-auto star">
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-light-4'></i>
                                <i class='bx bxs-star text-light-4'></i>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('adminbackend/assets/images/avatars/avatar-7.png') }}"
                                alt="user avatar" class="rounded-circle" width="55" height="55">
                            <div class="ms-3">
                                <h6 class="mb-0">Mackbook <small class="ml-4">08.34 AM</small></h6>
                                <p class="mb-0 small-font">Michle : The brand apple is original !</p>
                            </div>
                            <div class="ms-auto star">
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-warning'></i>
                                <i class='bx bxs-star text-light-4'></i>
                                <i class='bx bxs-star text-light-4'></i>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--End Row-->

</div>
@endsection
