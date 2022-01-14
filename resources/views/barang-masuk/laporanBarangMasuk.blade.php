<style>
    #barang-masuk {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #barang-masuk td, #barang-masuk th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #barang-masuk tr:nth-child(even){background-color: #f2f2f2;}
    #barang-masuk tr:hover {background-color: #ddd;}
    #barang-masuk th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="barang-masuk" width="100%">
   <a type="button" href="{{ route('exportPDF.barangMasuk') }} class="btn btn-success">
       <i class="fas fa-file-export">Export PDF</i>
   </a>
    <thead>
    <tr>
        <td>No</td>
        <td>Nama Supplier</td>
        <td>Nama Barang</td>
        <td>Jumlah Pemasukan</td>
        <td>Tanggal Pemasukan Barang</td>
    </tr>
    </thead>
    @foreach($barangMasuk as $data)
        <tbody>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->supplier->nama_supplier }}</td>
            <td>{{ $data->barang->nama_barang}}</td>
            <td>{{ $data->jumlah_pemasukan }}</td>
            <td>{{ $data->tgl_masuk }}</td>
        </tr>
        </tbody>
    @endforeach

</table>
