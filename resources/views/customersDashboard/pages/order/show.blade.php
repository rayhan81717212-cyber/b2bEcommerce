@extends('customersDashboard.layouts.master')
@section('title', 'Order Tracking')

@section('content')

<div class="container py-4">

    {{-- ORDER INFO --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between">

            <div>
                <h5 class="mb-1">Order #{{ $order->order_number }}</h5>
                <small class="text-muted">
                    Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}
                </small>
            </div>

            <div>
                @if(strtolower($order->status) === 'cancelled')
                    <span class="badge bg-danger">Cancelled</span>
                @else
                    <span class="badge bg-dark">
                        {{ ucfirst($order->status) }}
                    </span>
                @endif
            </div>

        </div>
    </div>

    @php
        $steps = [
            'pending' => 'Order Placed',
            'confirmed' => 'Approved',
            'processing' => 'In Process',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered'
        ];

        $status = strtolower($order->status);
        $currentIndex = array_search($status, array_keys($steps));
        $currentIndex = $currentIndex === false ? 0 : $currentIndex;

        $isCancelled = $status === 'cancelled';
    @endphp


    {{-- TRACKING --}}
    @if($isCancelled)

        {{-- cancle --}}
        <div class="card shadow-sm p-4 mb-4 text-center">

            <div class="mb-3">
                <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                     style="width:70px;height:70px;font-size:28px;">
                    ✖
                </div>
            </div>

            <h5 class="text-danger">Order Cancelled</h5>

            <p class="text-muted mb-1">
                Your order has been cancelled.
            </p>

            <small class="text-muted">
                Cancelled at: {{ \Carbon\Carbon::parse($order->updated_at)->format('d M Y, h:i A') }}
            </small>

        </div>

    @else

        {{-- product truking --}}
        <div class="card shadow-sm p-4 mb-4">

            <div class="d-flex justify-content-between align-items-center">

                @foreach($steps as $key => $label)

                    @php
                        $stepIndex = $loop->index;
                        $isActive = $stepIndex <= $currentIndex;
                        $isCurrent = $key == $status;
                    @endphp

                    <div class="text-center flex-fill">

                        <div class="mx-auto mb-2 rounded-circle
                            d-flex align-items-center justify-content-center
                            {{ $isActive ? 'bg-success text-white' : 'bg-light text-muted' }}"
                            style="width:50px;height:50px;">

                            @if($isCurrent)
                                🚚
                            @elseif($isActive)
                                ✔
                            @else
                                {{ $loop->iteration }}
                            @endif

                        </div>

                        <small class="{{ $isActive ? 'fw-bold text-success' : 'text-muted' }}">
                            {{ $label }}
                        </small>

                    </div>

                    @if(!$loop->last)
                        <div class="flex-fill" style="height:4px;background:
                            {{ $stepIndex < $currentIndex ? '#28a745' : '#ddd' }};
                            margin-top:25px;">
                        </div>
                    @endif

                @endforeach

            </div>

        </div>

    @endif


    {{-- product details --}}
    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white">
            Product Details
        </div>

        <div class="card-body">

            <p><strong>Product Name:</strong> {{ $order->productName ?? 'N/A' }}</p>

            <p><strong>Quantity:</strong> {{ $order->quantity ?? 1 }}</p>

            <p><strong>Price:</strong> {{ number_format($order->price, 2) }}</p>

            @if($order->productPhoto)
                <img src="{{ asset('storage/' . $order->productPhoto) }}" width="100">
            @endif

        </div>

    </div>

</div>

@endsection