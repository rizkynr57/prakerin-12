<style>
    #product-masuk {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #product-masuk td, #product-masuk th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #product-masuk tr:nth-child(even){background-color: #f2f2f2;}
    #product-masuk tr:hover {background-color: #ddd;}
    #product-masuk th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="product-masuk" width="100%">
    <thead>
    <tr>
        <td>No</td>
        <td>Nama Supplier</td>
        <td>Nama Barang</td>
        <td>Jenis Barang</td>
        <td>Jumlah Pemasukan</td>
        <td>Tanggal Pemasukan Barang</td>
    </tr>
    </thead>
    @foreach(barangMasuk as $data)
        <tbody>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->supplier->nama_supplier }}</td>
            <td>{{ $data->barang->nama_barang}}</td>
            <td>{{ $data->jenis_pengiriman}}</td>
            <td>{{ $data->jumlah_barang }}</td>
            <td>{{ $data->tgl_masuk }}</td>
        </tr>
        </tbody>
    @endforeach

</table>
