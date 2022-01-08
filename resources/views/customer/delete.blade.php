<head>
<link rel="stylesheet" type"text/css" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
       <form action="{{ route('customer.destroy', $customer->id) }}" method="post">
	<div id="container" class="container">
		<i  id="allclose" class="fas fa-times" onclick="closeCont()"></i>
		<h3>Apakah Anda Yakin??</h3>
		<p class="sub-heading">Ini akan dihapus secara permanen</p>
		<div class="warning">
			<i class="fas fa-exclamation-triangle"></i>
			<p class"warn-para">Setelah dihapus, tidak akan bisa dikembalikan</p>
		</div>
		<button class="cancel" onclick="closeCont()" >Batal</button>
		<button class="yes-delete">Iya, Hapus</button>
		
		<button class="delete-btn" id="delete"> 
			<i class="far fa-trash-alt></i>Delete</button>
		</form>
<script type="text/javascript" src="{{ asset('assets/js/style.js') }}"></script>

</body>
