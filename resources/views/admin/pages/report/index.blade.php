@extends('admin.layout.master')

@section('content')

<div class="mx-md-4">
    <div class="container-fluid p-md-5 flex-grow-1 container-p-y">

    <h3>Analytics & Monthly Report</h3>

    {{-- FILTER --}}
    <form method="GET" action="{{ url('/report') }}" class="row g-2 mt-3">

        <div class="col-md-3">
            <select name="month" class="form-control">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-3">
            <input type="number" name="year" value="{{ $year }}" class="form-control">
        </div>

        <div class="col-md-3">
            <button class="btn btn-success w-100">Filter</button>
        </div>

        <div class="col-md-3">
            <a href="{{ url('/report/export/pdf?month='.$month.'&year='.$year) }}"
               class="btn btn-primary w-100">
                📄 Download PDF
            </a>
        </div>

    </form>

    {{-- TABLE --}}
    <div class="card mt-4 p-3">

        <h5>{{ $type }}</h5>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>৳ {{ $row->grand_total ?? 0 }}</td>
                        <td>{{ ucfirst($row->status) }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
</div>
@endsection