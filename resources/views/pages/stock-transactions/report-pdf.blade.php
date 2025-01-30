<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        s th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .type-in {
            color: green;
            font-weight: bold;
        }

        .type-out {
            color: red;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #d3b4eb;
            padding: 10px;
            border-top: 3px solid #4b0082;
            border-top: 3px solid #4b0082;
        }

        .report-info {
            margin: 20px 0;
            font-size: 14px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <header>
        <div style="text-align: center; font-family: Arial, sans-serif; font-size: 14px;">
            <h2 style="margin: 0; color: red;">PT. TRI CIPTA PATRIOT</h2>
            <p style="margin: 0; font-size: 16px; font-weight: bold; color: blue;">GENERAL CONSTRUCTIONS SERVICES</p>
            <p style="margin: 5px 0;">
                Jl. Majapahit I Blok R12 No. 14 Tugu - Cimanggis<br>
                Depok 16451 - Indonesia<br>
                Telp.: +62 21 28566921 Fax.: +62 21 28566921<br>
                Email: triciptapatriot@gmail.com
            </p>
        </div>
    </header>

    <h1 style="text-align: center; margin: 20px 0;">{{ $title }}</h1>

    <div class="report-info">
        <p>Period: {{ $date_start ? date('d/m/Y', strtotime($date_start)) : 'All time' }} -
            {{ $date_end ? date('d/m/Y', strtotime($date_end)) : 'Present' }}</p>
        <p>Type: {{ $type ? ucfirst($type) : 'All Transactions' }}</p>
        <p>Print Date: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Reference</th>
                <th>Type</th>
                <th>Item/Product</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Vendor/Client</th>
                <th>Project</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $trans)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y', strtotime($trans['date'])) }}</td>
                    <td>{{ $trans['reference'] }}</td>
                    <td class="type-{{ $trans['type'] }}">
                        {{ ucfirst($trans['type']) }}
                    </td>
                    <td>{{ optional($trans['item'])->name ?? '-' }}</td>
                    <td>{{ optional($trans['item'])->unit->name ?? '-' }}</td>
                    <td>{{ $trans['quantity'] }}</td>
                    <td>
                        @if ($trans['type'] == 'in')
                            {{ $trans['vendor']->name ?? '-' }}
                        @else
                            {{ $trans['client']->name ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $trans['project']->name ?? '-' }}</td>
                    <td>{{ $trans['description'] ?? '-' }}</td>
                </tr>
            @endforeach
            {{-- Summary rows --}}
            <tr class="total-row">
                <td colspan="6" style="text-align: right">Total Stock In:</td>
                <td colspan="4">
                    {{ $transactions->where('type', 'in')->sum('quantity') }} Items
                </td>
            </tr>
            <tr class="total-row">
                <td colspan="6" style="text-align: right">Total Stock Out:</td>
                <td colspan="4">
                    {{ $transactions->where('type', 'out')->sum('quantity') }} Items
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p style="margin: 0; font-weight: bold;">WORKSHOP :</p>
        <p style="margin: 5px 0;">
            Jl. Militer No. 99 KM. 21 Darangdan<br>
            Purwakarta, Jawa Barat - Indonesia<br>
            Email: workshopiptcp@yahoo.com
        </p>
    </div>
</body>

</html>
