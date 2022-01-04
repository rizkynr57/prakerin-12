<head>
	<title>Cetak Laporan</title>
	<style>
		table.static {
			position: relative;
			border: 1px solid $543535
		}
</head>
<body>
	<div class="form-group">
		<p align="center"><b>Laporan Data Pemasukan</b></p>
                <a type="button" href="{{ route('barang-masuk.cetakPDF') }} class="btn btn-primary">Export on PDF</a>
		<table class="static" align="center" rules="all" border="1px" width="95%">
			<tr>
				<th>No</th>
				<th>Nama Supplier</th>
				<th>Nama Barang</th>
				<th>Jenis Barang</th>
				<th>Jumlah Barang</th>
				<th>Satuan</th>
				
				@foreach($barangMasuk as $data)
				       <tr>
					          <td>{{ $no++ }}</td>
					          <td>{{ $data->supplier->nama_supplier }}</td>
					          <td>{{ $data->barang->nama_barang }}</td>
					          <td>{{ $data->jenis_barang }} </td>
					          <td>{{ $data->jumlah_barang }}</td>
					          <td>{{ $data->satuan }}</td>
					</tr>
				@endforeach
				</tr>
		    </table>
		</div>
</body>
