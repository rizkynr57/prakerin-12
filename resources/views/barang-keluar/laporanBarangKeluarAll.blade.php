<style>
    #barang-keluar {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #barang-keluar td, #barang-keluar th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #barang-keluar tr:nth-child(even){background-color: #f2f2f2;}
    #barang-keluar tr:hover {background-color: #ddd;}
    #barang-keluar th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
<h2 align="center">Laporan Penerimaan Barang</h2>
<table id="barang-keluar" width="100%">
</a>
<thead>
    <tr>
        <td>No</td>
        <td>Nama Customer</td>
        <td>Nama Barang</td>
        <td>Jumlah Pengiriman</td>
        <td>Harga Satuan</td>
        <td>Satuan Barang</td>
        <td>Tujuan</td>
        <td>Tanggal Pengiriman Barang</td>
    </tr>
</thead>
@foreach($barangKeluar as $data)
<tbody>
    <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->customer->nama }}</td>
            <td>{{ $data->barang->nama_barang }}</td>
            <td>{{ $data->jumlah_pengiriman }}</td>
            <td>{{ $data->harga_satuan }}</td>
            <td>{{ $data->satuan }}</td>
            <td>{{ $data->tujuan }}</td>
            <td>{{ $data->tgl_pengiriman }}</td>
        </tr>
    </tbody>
    @endforeach
</table>
<center>
    <a class="btn btn-primary" href="{{ route('exportPDF.barangKeluar') }}">
    <i class="fas fa-file-export"></i>Export PDF</a>
</center>

