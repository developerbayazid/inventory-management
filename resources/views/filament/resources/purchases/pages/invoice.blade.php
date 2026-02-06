<x-filament-panels::page>

<div style="max-width: 100%;background: #ffffff;padding: 30px;border-radius: 8px;" class="invoice-container">

    <!-- HEADER -->
    <div style="display: flex;justify-content: space-between;align-items: center;border-bottom: 2px solid #eee;padding-bottom: 20px;" class="invoice-header">
        <div>
            <h1 style="margin: 0;font-size: 28px;color: #2c3e50;">Purchase Invoice</h1>
            <p>Invoice No: {{ $purchase->invoice_number }}</p>
        </div>

        <div style=" text-align: right;font-size: 14px;" class="company-details">
            <strong>Your Company Name</strong><br>
            Dhaka, Bangladesh<br>
            Phone: +880 1XXXXXXXXX
        </div>
    </div>

    <!-- INFO -->
    <div style="display: flex;justify-content: space-between;margin-top: 30px;font-size: 14px;" class="invoice-info">
        <div>
            <strong>Supplier</strong><br>
            {{ $purchase->provider->name }}<br>
            {{ $purchase->provider->address }}<br>
            {{ $purchase->provider->email }}<br>
            {{ $purchase->provider->phone }}
        </div>

        <div>
            <strong>Date</strong><br>
            {{ $purchase->purchase_date }}
        </div>
    </div>

    <!-- PRODUCT TABLE -->
    <table style="width: 100%;border-collapse: collapse;margin-top: 30px;">
        <thead style=" background: #27272A;color: #fff;">
            <tr>
                <th style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;">#</th>
                <th style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;">Product</th>
                <th style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;text-align: right;" class="text-right">Price</th>
                <th style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;text-align: right;" class="text-right">Quantity</th>
                <th style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;text-align: right;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($purchase->products as $product)
                <tr>
                    <td style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;">{{ $product->id }}</td>
                    <td style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;">{{ $product->product->name }}</td>
                    <td style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;text-align: right;" class="text-right">${{ $product->price }}</td>
                    <td style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;text-align: right;" class="text-right">{{ $product->quantity }}</td>
                    <td style="padding: 12px;border: 1px solid #e0e0e0;font-size: 13px;text-align: right;" class="text-right">${{ $product->price * $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTALS -->
    <div style="margin-top: 30px;width: 40%;margin-left: auto;" class="totals">
        <table style="width: 100%;border-collapse: collapse;margin-top: 30px;">
            <tr>
                <td style="text-align: right;padding: 8px 12px;">Sub Total</td>
                <td style="text-align: right; padding: 8px 12px; font-weight: bold;border-top: 2px solid #333;" class="text-right">${{ $purchase->total }}</td>
            </tr>
            <tr>
                <td style="text-align: right;padding: 8px 12px;">Discount</td>
                <td style="text-align: right;padding: 8px 12px; font-weight: bold;border-top: 2px solid #333;" class="text-right">${{ $purchase->discount }}</td>
            </tr>
            <tr>
                <td style="text-align: right;padding: 8px 12px;">Total</td>
                <td style="text-align: right;padding: 8px 12px; font-weight: bold;border-top: 2px solid #333;" class="text-right">${{ $purchase->net_total }}</td>
            </tr>
        </table>
    </div>

    <!-- FOOTER -->
    <div style="margin-top: 40px;text-align: center;font-size: 12px;color: #777;" class="footer">
        This is a system generated invoice.<br>
        Thank you for your business.
    </div>

</div>





</x-filament-panels::page>
