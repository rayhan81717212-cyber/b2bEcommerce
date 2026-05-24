<div style="text-align: center; margin-bottom: 20px;">
    <h2 style="margin: 0; font-size: 22px;">
        {{ strtoupper($type) }} REPORT
    </h2>
    <p style="margin: 5px 0; color: #666;">
        Generated on: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
    </p>
</div>

<table border="1" width="100%" cellspacing="0" cellpadding="10"
       style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

    <thead>
        <tr style="background: #f2f2f2; text-align: left;">
            <th style="width: 60px;">#</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>
                     {{ number_format($row->grand_total ?? $row->vendor_amount ?? 0, 2) }}
                </td>

                <td>
                    <span style="
                        padding: 3px 8px;
                        border-radius: 4px;
                        background: {{ ($row->status == 'paid' || $row->status == 'completed') ? '#d4edda' : '#fff3cd' }};
                        color: #333;
                        font-weight: bold;
                        font-size: 12px;
                    ">
                        {{ ucfirst($row->status ?? 'pending') }}
                    </span>
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 20px;">
                    No data found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>