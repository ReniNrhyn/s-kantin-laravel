<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi #{{ $transaction->invoice_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .receipt { width: 300px; margin: 0 auto; padding: 15px; border: 1px dashed #ccc; }
        .header { text-align: center; margin-bottom: 15px; }
        .info { margin-bottom: 15px; }
        .items { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .items th, .items td { padding: 5px; text-align: left; border-bottom: 1px dashed #ddd; }
        .total { font-weight: bold; text-align: right; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Kantin Sekolah</h2>
            <p>Jl. Pendidikan No. 123</p>
        </div>

        <div class="info">
            <p><strong>Invoice:</strong> {{ $transaction->invoice_number }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->formatted_date }}</p>
            <p><strong>Kasir:</strong> {{ $transaction->user->name }}</p>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Qty</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->menu->name }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>Rp {{ number_format($transaction->menu->price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <p>Total: {{ $transaction->formatted_total }}</p>
            <p>Pembayaran: {{ strtoupper($transaction->payment_method) }}</p>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja</p>
            <p>=== Layanan Konsumen ===</p>
            <p>Telp: 0812-3456-7890</p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
