<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .low-stock {
            background-color: #ffdddd;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: left;
            background-color: #d3b4eb;
            padding: 10px;
            border-top: 3px solid #4b0082;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .page-break {
            page-break-after: always;
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
                Email: <a href="mailto:triciptapatriot@gmail.com">triciptapatriot@gmail.com</a>
            </p>
        </div>
    </header>

    <h1>{{ $title }}</h1>
    <p>Print Date: {{ date('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Unit</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr class="{{ $item->stock <= 10 ? 'low-stock' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->unit->name }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        @if ($item->stock <= 10)
                            Low Stock
                        @else
                            Safe Stock
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p style="margin: 0; font-weight: bold;">WORKSHOP :</p>
        <p style="margin: 5px 0;">
            Jl. Militer No. 99 KM. 21 Darangdan<br>
            Purwakarta, Jawa Barat - Indonesia<br>
            Email: <a href="mailto:workshopiptcp@yahoo.com" style="color: black;">workshopiptcp@yahoo.com</a>
        </p>
    </div>
</body>

</html>
