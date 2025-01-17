<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>users_read_view</title>
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
			<th>Id_User</th>
			<th>Name_User</th>
			<th>LastName_User</th>
			<th>Id_number_User</th>
			<th>Tel_User</th>
			<th>Email_User</th>
			<th>Pass_User</th>
			<th>Rol_User</th>
		</tr>
		<?php foreach ($users as $user) : ?>
			<tr>
				<th> <?php echo $user -> get_id_user(); ?> </th>
				<th> <?php echo $user -> get_name(); ?> </th>
				<th> <?php echo $user -> get_lastname(); ?> </th>
				<th> <?php echo $user -> get_id_number(); ?> </th>
				<th> <?php echo $user -> get_cel(); ?> </th>
				<th> <?php echo $user -> get_email(); ?> </th>
				<th> <?php echo $user -> get_pass(); ?> </th>
				<th> <?php echo $user -> get_rol(); ?> </th>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>