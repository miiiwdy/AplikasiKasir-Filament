<table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Barang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->total_harga }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th,
    tbody td {
        text-align: center;
    }

    th {
        font-weight: bold;
    }

    th,
    td {
        width: 33%;
        text-align: left;
    }

    td {
        position: relative;
    }

    td::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1.5px;
        background-color: rgb(54, 54, 54);
    }

    .table thead th {
        position: sticky;
        top: 0;
        z-index: 1;
    }
</style>
