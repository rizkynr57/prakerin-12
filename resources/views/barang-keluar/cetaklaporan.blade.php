
<head>
	<title>Cetak Laporan</title>
	<style>
		table.static {
			position: relative;
			border: 1px solid #543535
		}
         </style>
</head>
<body>
	<div class="form-group">
		<p align="center"><b>Laporan Data Pengiriman</b></p>
                <a type="button" href="{{ route('barang-keluar.cetakPDF') }}" class="btn btn-success">Export on PDF</a>
		<table class="static" align="center" rules="all" border="1px" width="95%">
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Jumlah Pengiriman</th>
				<th>Tujuan</th>
				<th>Tanggal Pengiriman</th>
				</tr>
				@foreach($barangKeluar as $data)
				       <tr>
					          <td>{{ $no++ }}</td>
					          <td>{{ $data->barang->nama_barang }}</td>
					          <td>{{ $data->jumlah_pengiriman }} </td>
					          <td>{{ $data->tujuan }}</td>
					          <td>{{ $data->tgl_pengiriman }}</td>
					</tr>
				@endforeach
		    </table>
		</div>
</body>
