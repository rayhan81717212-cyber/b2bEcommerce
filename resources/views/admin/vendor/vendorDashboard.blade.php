@extends('admin.layout.master')
@section('title', 'dashboard')
@section('content')

<div class="mx-4 ">
        <div class="container-lg-fluid p-md-5 flex-grow-1 container-p-y">
        <div class="row g-4">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Congratulations {{Auth::user()->first_name ." " . Auth::user()->last_name}}! 🎉</h4>
                                <p class="mb-4">
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Count Today Orders --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" m-auto">
                                <i class="fa-solid fa-layer-group fs-2 text-primary"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-5">Today Orders</span>
                        <h5 class="card-title mb-2">{{ $todayOrders }}</h5>
                    </div>
                </div>
            </div>

            {{-- Count Yesterday Orders --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" m-auto">
                                <i class="fa-solid fa-credit-card fs-2 text-success"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-5">Yesterday Orders</span>
                        <h5 class="card-title mb-2">{{ $yesterdayOrders }}</h5>
                    </div>
                </div>
            </div>
            {{-- Count This Month Orders --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" m-auto">
                                <i class="fa-solid fa-chart-column fs-2 text-warning"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-5">This Month Orders</span>
                        <h5 class="card-title mb-2">{{ $thisMonthOrders }}</h5>
                    </div>
                </div>
            </div>
            {{-- Count Last Month Orders --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" m-auto">
                                <i class="fa-solid  fa-cart-shopping fs-2 text-info"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-5">Last Month Orders</span>
                        <h5 class="card-title mb-2">{{ $lastMonthOrders }}</h5>
                    </div>
                </div>
            </div>
        </div>
        {{-- Order Status --}}
        <div class="row g-4 mt-2">
             {{--  Orders --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" d-flex justify-content-center">
                                <span class="bg-warning p-3 rounded-circle">
                                    <i class="fa-solid fa-cart-shopping text-white fs-5"></i>
                                </span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-6"> Orders </span>
                        <h6 class="card-title mb-2">{{ $totalOrders }}</h6>
                    </div>
                </div>
            </div>

            {{--  Orders Pending--}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" d-flex justify-content-center">
                                <span class="bg-info p-3 rounded-circle">
                                    <i class="fa-solid fa-arrows-rotate text-white fs-5"></i>
                                    
                                </span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-6"> Orders Pending</span>
                        <h6 class="card-title mb-2">{{ $pending }}</h6>
                    </div>
                </div>
            </div>
            {{-- Order Processing --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" d-flex justify-content-center">
                                <span class="bg-success p-3 rounded-circle">
                                    <i class="fa-solid fa-truck text-white fs-5"></i>
                                    
                                </span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-6"> Orders Processing</span>
                        <h6 class="card-title mb-2">{{ $processing }}</h6>
                    </div>
                </div>
            </div>
            {{-- Order Delivered --}}
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <div class=" d-flex justify-content-center">
                                <span class="bg-primary p-3 rounded-circle">
                                    <i class="fa-solid fa-check text-white fs-5"></i>
                                    
                                </span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1 fs-6"> Orders Delivered</span>
                        <h6 class="card-title mb-2">{{ $delivered }}</h6>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card p-3" style="height: 350px;">
                        <canvas id="chart"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-3" style="height: 350px;">
                        <canvas id="incomeBarChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
   <script>

let data = @json($monthlySales);

new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: Object.keys(data),
        datasets: [{
            label: 'Order',
            data: Object.values(data),
            backgroundColor: 'rgba(99, 102, 241, 0.6)', 
            borderColor: 'rgba(99, 102, 241, 1)',
            borderWidth: 1,
            borderRadius: 8,
            barThickness: 35
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, 
        plugins: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Monthly Order Report'
            }
        },
        scales: {
            x: {
                ticks: {
                    font: {
                        size: 10 
                    }
                }
            },
            y: {
                ticks: {
                    font: {
                        size: 10
                    }
                },
                beginAtZero: true
            }
        }
    }
});


</script>
<script>
let incomeData = @json($monthlyIncome);

new Chart(document.getElementById('incomeBarChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(incomeData),
        datasets: [{
            label: 'Monthly Income',
            data: Object.values(incomeData),
            backgroundColor: 'rgba(75, 192, 75, 0.5)',
            borderColor: 'rgba(75, 192, 75, 1)',
            borderWidth: 1,
            borderRadius: 8,
            barThickness: 35
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Monthly Income Report'
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#eee'
                }
            }
        }
    }
});
</script>
@endsection