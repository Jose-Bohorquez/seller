<?php

	class Rol
	{
		// Atributos
		private $dbh; // Conexión a la base de datos
		private $id_rol;
		private $name_rol;

		// Constructor principal con sobrecarga
		public function __construct()
		{
			try {
				$this->dbh = DataBase::connection(); // Conexión a la base de datos
				if (!$this->dbh) {
					throw new Exception("No se pudo establecer conexión con la base de datos");
				}

				$args = func_get_args();
				$numArgs = func_num_args();

				if (method_exists($this, $method = '__construct' . $numArgs)) {
					call_user_func_array([$this, $method], $args);
				}
			} catch (Exception $e) {
				die("Error en el constructor: " . $e->getMessage());
			}
		}

		// Constructor con parámetros
		public function __construct2($id_rol, $name_rol)
		{
			$this->id_rol = $id_rol;
			$this->name_rol = $name_rol;
		}

		// Métodos set y get para id_rol
		public function set_id_rol($id_rol)
		{
			$this->id_rol = $id_rol;
		}

		public function get_id_rol()
		{
			return $this->id_rol;
		}

		// Métodos set y get para name_rol
		public function set_name_rol($name_rol)
		{
			$this->name_rol = $name_rol;
		}

		public function get_name_rol()
		{
			return $this->name_rol;
		}

		// CRUD: Métodos de persistencia en la base de datos

		// Crear un rol
		public function rol_create()
		{
			try {
				$sql = 'INSERT INTO rol (id_rol, name_rol) VALUES (:id_rol, :name_rol)';
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':id_rol', $this->get_id_rol());
				$stmt->bindValue(':name_rol', $this->get_name_rol());
				$stmt->execute();
			} catch (Exception $e) {
				die("Error al crear el rol: " . $e->getMessage());
			}
		}

		// Leer todos los roles
		public function rol_read()
		{
			try {
				$rollist = [];
				$sql = 'SELECT * FROM rol';
				$stmt = $this->dbh->query($sql);
		
				foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $rol) {
					// Crear instancias de la clase Rol
					$rollist[] = new Rol($rol['id_rol'], $rol['name_rol']);
				}
		
				return $rollist;
			} catch (Exception $e) {
				die("Error al obtener los roles: " . $e->getMessage());
			}
		}
		

		// Obtener un rol por su ID
		public function get_rol_by_id($id_rol)
		{
			try {
				$sql = 'SELECT * FROM rol WHERE id_rol = :id_rol';
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':id_rol', $id_rol);
				$stmt->execute();

				$rolDb = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($rolDb) {
					return new Rol($rolDb['id_rol'], $rolDb['name_rol']);
				} else {
					return null; // No se encontró el rol
				}
			} catch (Exception $e) {
				die("Error al obtener el rol: " . $e->getMessage());
			}
		}

		// Actualizar un rol
		public function rol_update()
		{
			try {
				$sql = 'UPDATE rol SET name_rol = :name_rol WHERE id_rol = :id_rol';
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':id_rol', $this->get_id_rol());
				$stmt->bindValue(':name_rol', $this->get_name_rol());
				$stmt->execute();
			} catch (Exception $e) {
				die("Error al actualizar el rol: " . $e->getMessage());
			}
		}

		// Eliminar un rol
		public function rol_delete($id_rol)
		{
			try {
				$sql = 'DELETE FROM rol WHERE id_rol = :id_rol';
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':id_rol', $id_rol);
				$stmt->execute();
			} catch (Exception $e) {
				die("Error al eliminar el rol: " . $e->getMessage());
			}
		}
	}

?>