<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>DAFTAR MENU</h4>
	</center>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $menu)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ ucfirst($menu->category) }}</td>
                <td>Rp {{ number_format($menu->price, 2) }}</td>
                <td>{{ $menu->description ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
