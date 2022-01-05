<style>
    #product-keluar {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #product-keluar td, #product-keluar th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #product-keluar tr:nth-child(even){background-color: #f2f2f2;}
    #product-keluar tr:hover {background-color: #ddd;}
    #product-keluar th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="product-keluar" width="100%">
 <a type="button" href="{{ route('barang-keluar.cetakPDF') }} class="btn btn-success">Export Ke PDF</a>
    <thead>
    <tr>
        <td>No</td>
        <td>Nama Barang</td>
        <td>Jumlah Pengiriman</td>
        <td>Tujuan</td>
        <td>Tanggal Pengiriman Barang</td>
    </tr>
    </thead>
    @foreach(barangKeluar as $data)
        <tbody>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->barang->nama_barang}}</td>
            <td>{{ $data->jumlah_pengiriman}}</td>
            <td>{{ $data->tujuan }}</td>
            <td>{{ $data->tgl_pengiriman }}</td>
        </tr>
        </tbody>
    @endforeach

</table>
