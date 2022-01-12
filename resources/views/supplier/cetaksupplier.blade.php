<style>
    #supplier {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #supplier td,
    #supplier th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #supplier tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #supplier tr:hover {
        background-color: #ddd;
    }

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
    @foreach ($data as $item)
        <tbody>
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->nama_supplier }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->no_telp }}</td>
                <td>{{ $item->nama_perusahaan }}</td>
            </tr>
        </tbody>
    @endforeach

</table>
