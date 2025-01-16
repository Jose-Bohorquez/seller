<?php 
	
	// prueba llamado de este archivo
	#echo "hola desde el modelo rol.php";

	class Rol
	{


		// *** 1er Parte: Clase (POO) *** //
		// Atributos
		private $dbh; # variable de conexion data base handler
		private $id_rol;
		private $name;



		// Metodos


		# Sobrecarga de constructores
		public function __construct() {
            try {
                $this -> dbh = DataBase::connection();                  
                $a = func_get_args();                  
                $i = func_num_args();                                  
                if (method_exists($this, $f = '__construct' . $i)) {
                    call_user_func_array(array($this, $f), $a);  
                }
            } catch (Exception $e) {
                echo $e->getMessage();  
            }
        }


        # constructor para 2 parametros (__construct2)
        public function __construct2($id_rol,$name)
        {
        	$this -> id_rol = $id_rol;
        	$this -> name 	= $name;
        }


		# Metodos set() y get() id_rol
		public function set_id_rol($id_rol)
		{
			$this -> id_rol = $id_rol;
		}
		public function get_id_rol()
		{
			return $this -> id_rol;
		}


		# Metodos set() y get() name
		public function set_name($name)
		{
			$this -> name = $name;
		}
		public function get_name()
		{
			return $this -> name;
		}



		// *** 2da Parte: Persistencia BD (CRUD) *** //


		# caso de uso # 01 crear un usuario
		public function rol_create()
		{
			try {
				$sql = 'INSERT INTO ROL VALUES (:id_rol, :name)';
				$stmt = $this -> dbh -> prepare($sql);
				$stmt -> bindValue('id_rol',$this -> get_id_rol());
				$stmt -> bindValue('name',$this -> get_name());
				// Validamos
				$stmt -> execute();
			} catch (Exception $e) {
				die($e -> getMessage());				
			}
		}



		# caso de uso # 02 leer todos los usuarios
public function rol_read()
{
    try {
        $rolList = [];
        $sql = 'SELECT * FROM rol'; // Asegúrate de que sea 'rol'
        $stmt = $this->dbh->query($sql);
        foreach ($stmt->fetchAll() as $rol) {
            $rolList[] = new Rol(
                $rol['id_rol'],
                $rol['name']
            );
        }
        return $rolList;
    } catch (Exception $e) {
        die("Error al obtener roles: " . $e->getMessage());
    }
}



public function get_rol_by_id($id_rol)
{
    try {
        $sql = 'SELECT * FROM rol WHERE id_rol = :id_rol'; // Cambiado 'roles' a 'rol'
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue('id_rol', $id_rol);
        $stmt->execute();
        $rolDb = $stmt->fetch();
        return new Rol(
            $rolDb['id_rol'],
            $rolDb['name']
        );
    } catch (Exception $e) {
        die("Error al obtener el rol: " . $e->getMessage());
    }
}




		public function rol_update()
		{
			try {
				$sql = 'UPDATE ROL SET
							id_rol = :id_rol,
							name = :name
						WHERE id_rol = :id_rol ';
				$stmt = $this -> dbh -> prepare($sql);
				$stmt -> bindValue('id_rol',$this -> get_id_rol());
				$stmt -> bindValue('name',$this -> get_name());
				$stmt -> execute();
			} catch (Exception $e) {
				die($e -> getMessage());				
			}
		}




		public function rol_delete($id_rol)
		{
			try {
				$sql = 'DELETE FROM ROL WHERE id_rol = :id_rol';
				$stmt = $this -> dbh -> prepare($sql);
				$stmt -> bindValue('id_rol', $id_rol);
				$stmt -> execute();
			} catch (Exception $e) {
				die($e -> getMessage());				
			}
		}




	}

?>