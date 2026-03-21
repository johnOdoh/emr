<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #7fc9c4, #4a9fa0);
            color: #000;
            padding: 20px;
            position: relative;
        }

        .header:after {
            content: "";
            position: absolute;
            bottom: -40px;
            left: 0;
            width: 100%;
            height: 60px;
        }

        .header-table {
            width: 100%;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo {
            text-align: right;
        }

        .section {
            margin-top: 30px;
            padding: 20px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 5px;
        }

        .boxed {
            border: 1px solid #ccc;
            padding: 6px;
        }

        /* ITEM TABLE */
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .items th, .items td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        .items th {
            background: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .totals {
            width: 40%;
            margin-left: auto;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .totals td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        .totals .label {
            text-align: right;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #555;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <table class="header-table">
            <tr>
                <td>
                    <h2>INVOICE</h2>
                    <p>
                        <strong>INVOICE NO</strong><br>
                        {{ $invoice_id }}
                    </p>
                    <p>
                        <strong>DATE</strong><br>
                        {{ $date }}
                    </p>
                </td>

                <td class="logo">
                    <img src="{{ public_path('logo.png') }}" alt="Company Logo" style="width: 100px;"><br><br>

                    {{ config('app.name') }}<br>
                    {{ config('app.address') }}<br>
                    {{ config('app.state') }}<br>
                    {{ config('app.phone') }}<br>
                    {{ config('app.email') }}
                </td>
            </tr>
        </table>
    </div>

    <!-- BODY -->
    <div class="section">

        <!-- BILL TO -->
        <table class="info-table">
            <tr>
                <td width="50%">
                    <strong>INVOICE TO</strong><br>
                    {{ $address }}<br>
                    {{ $state }}, {{ $zip_code }}<br>
                    {{ $phone }}<br>
                    {{ $email }}
                </td>
            </tr>
        </table>

        <!-- INFO ROW -->
        <table class="items">
            <tr>
                <th>Client</th>
                <th>Payment Terms</th>
                <th>Due date</th>
            </tr>
            <tr>
                <td>{{ $name }}</td>
                <td>Due on Receipt</td>
                <td>{{ $invoice_due_date }}</td>
            </tr>
        </table>

        <!-- ITEM TABLE -->
        <table class="items">
            <tr>
                <th>Item</th>
                <th>Rate per Unit/Hour</th>
                <th>Units/Hours</th>
                <th>Line Total</th>
            </tr>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['item_name'] }}</td>
                    <td>₦{{ number_format($item['rate'], 2) }}</td>
                    <td>{{ $item['units'] }}</td>
                    <td class="text-right">₦{{ number_format($item['total_amount'], 2) }}</td>
                </tr>
            @endforeach
        </table>

        <!-- TOTALS -->
        <table class="totals">
            <tr>
                <td class="label">Subtotal</td>
                <td>₦{{ number_format($item_total, 2) }}</td>
            </tr>
            @foreach ($taxes as $tax)
                <tr>
                    <td class="label">{{ $tax['tax_name'] }}</td>
                    <td>₦{{ number_format($tax['tax_amount'], 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="label"><strong>Total</strong></td>
                <td><strong>₦{{ number_format($grand_total, 2) }}</strong></td>
            </tr>
        </table>

    </div>

</div>

</body>
</html>
