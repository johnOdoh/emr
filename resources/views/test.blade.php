<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: Arial, sans-serif;
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
            margin-top: 60px;
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
                        <strong>DATE</strong><br>
                        Date
                    </p>

                    <p>
                        <strong>INVOICE NO</strong><br>
                        Number
                    </p>
                </td>

                <td class="logo">
                    <strong>Logo</strong><br>
                    Name<br><br>

                    Happy Hedges<br>
                    Street Address<br>
                    City, ST ZIP Code<br>
                    Phone<br>
                    Fax<br>
                    Email
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
                    Street Address<br>
                    City, ST ZIP Code<br>
                    Phone<br>
                    Fax<br>
                    Email
                </td>
            </tr>
        </table>

        <!-- INFO ROW -->
        <table class="items">
            <tr>
                <th>Client</th>
                <th>Location</th>
                <th>Payment Terms</th>
                <th>Due date</th>
            </tr>
            <tr>
                <td>Richard</td>
                <td>South Hills</td>
                <td>Due on Receipt</td>
                <td>May 25, 2024</td>
            </tr>
        </table>

        <!-- ITEM TABLE -->
        <table class="items">
            <tr>
                <th>Item</th>
                <th>Hours</th>
                <th>Hourly Rate</th>
                <th>Line Total</th>
            </tr>

            <tr>
                <td>Elder care services</td>
                <td>100</td>
                <td>$20</td>
                <td class="text-right">$2000</td>
            </tr>

            <tr>
                <td>Meals</td>
                <td>2</td>
                <td>$25</td>
                <td class="text-right">$50</td>
            </tr>
        </table>

        <!-- TOTALS -->
        <table class="totals">
            <tr>
                <td class="label">Subtotal</td>
                <td>$2050.00</td>
            </tr>
            <tr>
                <td class="label">Sales Tax</td>
                <td>$205.00</td>
            </tr>
            <tr>
                <td class="label"><strong>Total</strong></td>
                <td><strong>$2255.00</strong></td>
            </tr>
        </table>

        <!-- FOOTER -->
        <div class="footer">
            Create an invoice with invoice.io
        </div>

    </div>

</div>

</body>
</html>
