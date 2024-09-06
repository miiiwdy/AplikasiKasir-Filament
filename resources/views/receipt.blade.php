<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            letter-spacing: -0.4px;
            margin: 0;
            padding: 20px;
        }

        .receipt-container {
            width: 300px;
            margin: auto;
            border: 1px solid #000;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .receipt-container p {
            margin: 0 0 5px 0;
            text-align: left;
        }

        .receipt-container h2 {
            margin-bottom: 5px;
        }

        .receipt-container h4 {
            font-weight: 400;
            font-size: 14px;
            margin: 5px 0 25px 0;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header {
            margin-bottom: 10px;
        }

        .details,
        .item {
            margin: 5px 0;
        }

        .item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .tanda {
            display: flex;
            justify-content: space-between;
            padding-bottom: 5px;
            font-weight: 600;
            font-size: 15px
        }

        .footer {
            margin-top: 20px;
        }

        .total,
        .payment-method {
            display: flex;
            justify-content: space-between;
        }

        .thankyou {}

        .thankyou h4 {
            font-weight: 400;
            font-size: 14px;
            margin: 5px 0 2px 0;
            text-align: center;
            margin: 0 25px;
        }

        @media print {
            #printReceipt {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <div class="header">
            <h2>EasyCashier</h2>
            <h4 style="margin-bottom: 5px">Jalan Raya pekapuran RT 02 RW 07</h4>
            <h4>Telp. 087.802315101 - Fax. -</h4>
            <p>Tanggal: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            <p style="margin-bottom: 15px">Kasir: {{ Auth::user()->name }}</p>
            <hr>
        </div>
        <div class="tanda">
            <span>Qty</span>
            <span>Nama Barang</span>
            <span>Harga</span>
        </div>
        @if (session('purchaseData'))
            @foreach (session('purchaseData') as $data)
                <div class="item">
                    <span>{{ $data['quantity'] }}x</span>
                    <span>{{ $data['nama_barang'] ?? 'Unknown' }}</span>
                    <span>{{ number_format($data['total_harga'], 2, ',', '.') }}</span>
                </div>
            @endforeach

            <div class="footer">
                <hr>
                <div class="total">
                    <strong>Total:</strong>
                    <strong>Rp{{ number_format(collect(session('purchaseData'))->sum('total_harga'), 2, ',', '.') }}</strong>
                </div>
                <div class="payment-method" style="margin-bottom: 20px">
                </div>
                <div class="thankyou">
                    <h4>Terima Kasih</h4>
                    <h4>#Barang yang sudah dibeli tidak dapat dirukarkan / dikembalikan</h4>
                </div>
            </div>
        @else
            <p>No data available.</p>
        @endif
    </div>
</body>

</html>
