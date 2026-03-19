<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payslip - Zoonoodle Inc</title>
  <style>
    body {
      font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 20px;
    }
    .payslip {
      max-width: 700px;
      margin: auto;
      background: #fff;
      border: 1px solid #ddd;
      padding: 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .header h2 {
      margin: 0;
      color: #333;
    }
    .details {
      margin-bottom: 20px;
    }
    .details p {
      margin: 4px 0;
      font-size: 14px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table th, table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
      font-size: 14px;
    }
    table th {
      background: #f0f0f0;
    }
    .totals {
      text-align: right;
      font-weight: bold;
      margin-top: 10px;
      font-size: smaller;
    }
    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }
    .signatures div {
      text-align: center;
      width: 45%;
    }
    .signatures div p {
      margin-top: 60px;
      border-top: 1px solid #000;
      display: inline-block;
      padding-top: 5px;
    }
  </style>
</head>
<body>
  <div class="payslip">
    <div class="header">
      <h2>{{ config('app.name') }}</h2>
      <p>{{ config('app.address') }}, {{ config('app.area') }}, {{ config('app.state') }}</p>
      <h3>Payslip - {{ $date }}</h3>
    </div>

    <div class="details">
      <p><strong>Employee Name:</strong> {{ $name }}</p>
      <p><strong>Designation:</strong> {{ $job_title }}</p>
      <p><strong>Department:</strong> {{ $department }}</p>
    </div>

    <table>
      <tr>
        <th>Earnings</th>
        <th>Amount(₦)</th>
        <th>Deductions</th>
        <th>Amount(₦)</th>
      </tr>
      @php
        $size = max(count($earnings ?? []), count($deductions ?? []));
      @endphp
      @for ($i = 0; $i < $size; $i++)
        <tr>
            <td>{{ isset($earnings[$i]) ? $earnings[$i]['description'] : '-' }}</td>
            <td>{{ isset($earnings[$i]) ? number_format($earnings[$i]['amount']) : '-' }}</td>
            <td>{{ isset($deductions[$i]) ? $deductions[$i]['description'] : '-' }}</td>
            <td>{{ isset($deductions[$i]) ? number_format($deductions[$i]['amount']) : '-' }}</td>
        </tr>
      @endfor
      <tr>
        <th>Total Earnings</th>
        <th>₦{{ number_format($total_earnings, 2) }}</th>
        <th>Total Deductions</th>
        <th>₦{{ number_format($total_deductions, 2) }}</th>
      </tr>
    </table>

    <div class="totals">
    Net Pay: ₦<strong>{{ number_format($net_pay, 2) }}</strong> ({{ $net_pay_figure }})
    </div>

    <table style="width:100%; margin-top:40px; border-collapse: collapse; border:none;">
        <tr>
            <td style="height:70px; width:50%; padding:10px; border:none; text-align: center;">
                ___________________________<br>
                <strong>Employer Signature</strong>
            </td>
            <td style="height:70px; width:50%; padding:10px; border:none; text-align: center;">
                ___________________________<br>
                <strong>Employee Signature</strong>
            </td>
        </tr>
    </table>
</body>
</html>
