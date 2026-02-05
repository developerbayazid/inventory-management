<x-filament-panels::page>




<style>

        .invoice-container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
        }

        .company-details {
            text-align: right;
            font-size: 14px;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table thead {
            background: #2c3e50;
            color: #fff;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            font-size: 13px;
        }

        .text-right {
            text-align: right;
        }

        .totals {
            margin-top: 30px;
            width: 40%;
            margin-left: auto;
        }

        .totals table td {
            padding: 8px 12px;
        }

        .totals tr:last-child td {
            font-weight: bold;
            border-top: 2px solid #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

    </style>

<div class="invoice-container">

    <!-- HEADER -->
    <div class="invoice-header">
        <div>
            <h1>Purchase Invoice</h1>
            <p>Invoice No: INV-001</p>
        </div>

        <div class="company-details">
            <strong>Your Company Name</strong><br>
            Dhaka, Bangladesh<br>
            Phone: +880 1XXXXXXXXX
        </div>
    </div>

    <!-- INFO -->
    <div class="invoice-info">
        <div>
            <strong>Supplier</strong><br>
            ABC Supplier Ltd<br>
            supplier@email.com<br>
            +880 1XXXXXXXXX
        </div>

        <div>
            <strong>Date</strong><br>
            01 February 2026
        </div>
    </div>

    <!-- PRODUCT TABLE -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th class="text-right">Price</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Product A</td>
                <td class="text-right">100.00</td>
                <td class="text-right">2</td>
                <td class="text-right">200.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Product B</td>
                <td class="text-right">50.00</td>
                <td class="text-right">1</td>
                <td class="text-right">50.00</td>
            </tr>
        </tbody>
    </table>

    <!-- TOTALS -->
    <div class="totals">
        <table>
            <tr>
                <td>Sub Total</td>
                <td class="text-right">250.00</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td class="text-right">0.00</td>
            </tr>
            <tr>
                <td>Net Total</td>
                <td class="text-right">250.00</td>
            </tr>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        This is a system generated invoice.<br>
        Thank you for your business.
    </div>

</div>





</x-filament-panels::page>
