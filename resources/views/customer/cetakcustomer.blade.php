<style>
    #customer {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #customer td, #customer th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #customer tr:nth-child(even){background-color: #f2f2f2;}
    #customer tr:hover {background-color: #ddd;}
    #customer th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="customer" width="100%">
    <thead>
    <tr>
        <td>No</td>
        <td>Nama Customer</td>
        <td>Alamat</td>
        <td>Email</td>
        <td>Nomor Telepon</td>
    </tr>
    </thead>
    @foreach($customer as $data)
        <tbody>
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama}}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->no_telp }}</td>
        </tr>
        </tbody>
    @endforeach

</table>

