<table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Jumlah Barang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->harga * $item->quantity }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    thead th, tbody td {
        text-align: center;
    }
    th {
        font-weight: bold; 
    }
    th, td {
        width: 33%; 
        text-align: center;
    }

    .table thead th {
        position: sticky; 
        top: 0;
        z-index: 1; 
    }
</style>
