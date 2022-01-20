<html>
    <head>
        <title>Laporan Keluar</title>
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body>
<h2 align="center">Laporan Yang Telah Terkirim</h2>
<table id="barang-keluar" width="80%" class="table table-striped">
</a>
<thead>
    <tr class="bg-warning">
        <td>No</td>
        <td>Nama Customer</td>
        <td>Nama Barang</td>
        <td>Jumlah Pengiriman</td>
        <td>Harga Satuan</td>
        <td>Tujuan Pengiriman</td>
        <td>Tanggal Pengiriman</td>
    </tr>
</thead>
@foreach($barangKeluar as $data)
<tbody>
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->customer->nama }}</td>
        <td>{{ $data->barang->nama_barang}}</td>
        <td>{{ $data->jumlah_pengiriman }}</td>
        <td>{{ $data->harga_satuan }}</td>
        <td>{{ $data->tujuan }}</td>
        <td>{{ $data->tgl_pengiriman }}</td>
    </tr>
</tbody>
@endforeach

</body>
</table>
<center>
    <a href="{{ route('exportPDF.barangKeluar') }}" class="btn btn-success btn-lg active">
        <i class="fas fa-file-export"></i></i> Export PDF</a>
    </center>
</html>
