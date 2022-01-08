
<style>
    #supplier {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #supplier td, #supplier th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #supplier tr:nth-child(even){background-color: #f2f2f2;}
    #supplier tr:hover {background-color: #ddd;}
    #supplier th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="supplier" width="100%">
    <thead>
    <tr>
        <td>No</td>
        <td>Nama</td>
        <td>Alamat</td>
        <td>Nomor Telepon</td>
        <td>Nama Perusahaan</td>
    </tr>
    </thead>
    @foreach($supplier as $data)
        <tbody>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_supplier}}</td>
            <td>{{ $data->alamat}}</td>
            <td>{{ $data->no_telp }}</td>
            <td>{{ $data->nama_perusahaan }}</td>
        </tr>
        </tbody>
    @endforeach

</table>
