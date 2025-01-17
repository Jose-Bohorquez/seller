<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>rol_read_view</title>
</head>
<body>
	<style type="text/css">
	table, th, td {
	  border: 1px solid black;
	  border-radius: 10px;
	  border-color: #96D4D4;
	}
	</style>
	<table>
		<tr>
			<th>Id_Rol</th>
			<th>Name_Rol</th>
		</tr>
		<?php foreach ($roles as $rol) : ?>
			<tr>
				<th> <?php echo $rol -> get_id_rol(); ?> </th>
				<th> <?php echo $rol -> get_name(); ?> </th>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>