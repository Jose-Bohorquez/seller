<?php 

	class User
	{

		private $dbh; # variable de conexion data base handler
		private $id_user;
		private $name_user;	
		private $lastname;
		private $id_number;
		private $cel;	
		private $email;	
		private $pass; 	
		private $rol;

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

        public function __construct8($id_user,$name_user,$lastname,$id_number,$cel,$email,$pass,$rol)
        {
        	$this -> id_user	 = $id_user;
        	$this -> name_user		 = $name_user;
        	$this -> lastname	 = $lastname;
        	$this -> id_number	 = $id_number;
        	$this -> cel		 = $cel;
        	$this -> email		 = $email;
        	$this -> pass		 = $pass;
        	$this -> rol		 = $rol;
        }

        public function __construct2($email,$pass)
        {
        	$this -> email 	= $email;
        	$this -> pass 	= $pass;
        }


		# Metodos set() y get() id_user
		public function set_id_user($id_user)
		{
			$this -> id_user = $id_user;
		}
		public function get_id_user()
		{
			return $this -> id_user;
		}


		# Metodos set() y get() name_user
		public function set_name_user($name_user)
		{
			$this -> name_user = $name_user;
		}
		public function get_name_user()
		{
			return $this -> name_user;
		}


		# Metodos set() y get() lastname
		public function set_lastname($lastname)
		{
			$this -> lastname = $lastname;
		}
		public function get_lastname()
		{
			return $this -> lastname;
		}


		# Metodos set() y get() id_number
		public function set_id_number($id_number)
		{
			$this -> id_number = $id_number;
		}
		public function get_id_number()
		{
			return $this -> id_number;
		}


		# Metodos set() y get() cel
		public function set_cel($cel)
		{
			$this -> cel = $cel;
		}
		public function get_cel()
		{
			return $this -> cel;
		}


		# Metodos set() y get() email
		public function set_email($email)
		{
			$this -> email = $email;
		}
		public function get_email()
		{
			return $this -> email;
		}


		# Metodos set() y get() pass
		public function set_pass($pass)
		{
			$this -> pass = $pass;
		}
		public function get_pass()
		{
			return $this -> pass;
		}


		# Metodos set() y get() rol
		public function set_rol($rol)
		{
			$this -> rol = $rol;
		}
		public function get_rol()
		{
			return $this -> rol;
		}


		// *** 2da Parte: Persistencia BD (CRUD) *** //
   public function user_create()
    {
        try {
            $sql = 'INSERT INTO user (name_user, lastname, id_number, cel, email, pass, rol) 
                    VALUES (:name_user, :lastname, :id_number, :cel, :email, :pass, :rol)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('name_user', $this->name_user);
            $stmt->bindValue('lastname', $this->lastname);
            $stmt->bindValue('id_number', $this->id_number);
            $stmt->bindValue('cel', $this->cel);
            $stmt->bindValue('email', $this->email);
            $stmt->bindValue('pass', $this->pass);
            $stmt->bindValue('rol', $this->rol);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error al crear usuario: " . $e->getMessage());
        }
    }




		public function user_read()
		{
			try {
				$userList = [];
				$sql = 'SELECT * FROM user';
				$stmt = $this -> dbh -> query($sql);
				foreach ($stmt -> fetchAll() as $user) {
					$userList[] = new User(
						$user['id_user'],
						$user['name_user'],
						$user['lastname'],
						$user['id_number'],
						$user['cel'],
						$user['email'],
						$user['pass'],
						$user['rol']
					);
					
				}

				// Validamos
				return $userList;

			} catch (Exception $e) {
				die($e -> getMessage());				
			}
		}



		public function get_user_by_id($id_user)
		{
			try {
				$sql = 'SELECT u.*, r.name_rol AS role_name
						FROM user u
						JOIN rol r ON u.rol = r.id_rol
						WHERE id_user = :id_user';

				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
				$stmt->execute();
				$userDb = $stmt->fetch(PDO::FETCH_ASSOC);
		
				if ($userDb) {
					// Crear y retornar un nuevo objeto User
					return new User(
						$userDb['id_user'],
						$userDb['name_user'],
						$userDb['lastname'],
						$userDb['id_number'],
						$userDb['cel'],
						$userDb['email'],
						$userDb['pass'],
						$userDb['rol'] // ID del rol
					);
				}
		
				return null; // Si no se encontró el usuario
			} catch (Exception $e) {
				throw new Exception("Error al obtener el usuario: " . $e->getMessage());
			}
		}
		





		public function update_user_fields(array $fieldsToUpdate, $userId)
		{
			try {
				// Crear la parte dinámica del query
				$updateFields = [];
				foreach ($fieldsToUpdate as $field => $value) {
					$updateFields[] = "$field = :$field";
				}
		
				$sql = 'UPDATE user SET ' . implode(', ', $updateFields) . ' WHERE id_user = :id_user';
				$stmt = $this->dbh->prepare($sql);
		
				// Asignar valores a los campos
				foreach ($fieldsToUpdate as $field => $value) {
					$stmt->bindValue(":$field", $value);
				}
				$stmt->bindValue(':id_user', $userId);
		
				$stmt->execute();
			} catch (Exception $e) {
				throw new Exception("Error al actualizar usuario: " . $e->getMessage());
			}
		}
		







		public function user_update()
		{
			try {
				$sql = 'UPDATE user SET
							name_user   = :name_user,
							lastname    = :lastname,
							id_number   = :id_number,
							cel         = :cel,
							email       = :email,
							pass        = :pass,
							rol         = :rol
						WHERE id_user   = :id_user';
		
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':id_user', $this->get_id_user());
				$stmt->bindValue(':name_user', $this->get_name_user());
				$stmt->bindValue(':lastname', $this->get_lastname());
				$stmt->bindValue(':id_number', $this->get_id_number());
				$stmt->bindValue(':cel', $this->get_cel());
				$stmt->bindValue(':email', $this->get_email());
				$stmt->bindValue(':pass', $this->get_pass());
				$stmt->bindValue(':rol', $this->get_rol());
				$stmt->execute();
			} catch (Exception $e) {
				throw new Exception("Error al actualizar el usuario: " . $e->getMessage());
			}
		}
		



		public function user_delete($id_user)
		{
			try {
				$sql = 'DELETE FROM user WHERE id_user = :id_user';
				$stmt = $this -> dbh -> prepare($sql);
				$stmt -> bindValue('id_user', $id_user);
				$stmt -> execute();
			} catch (Exception $e) {
				die($e -> getMessage());				
			}
		}


		public function get_user_by_email_and_password($email, $password)
		{
		    try {
		        $sql = 'SELECT * FROM user WHERE email = :email AND pass = :password';
		        $stmt = $this->dbh->prepare($sql);
		        $stmt->bindValue('email', $email);
		        $stmt->bindValue('password', $password);
		        $stmt->execute();

		        $userDb = $stmt->fetch();

		        if ($userDb) {
		            return new User(
		                $userDb['id_user'],
		                $userDb['name'],
		                $userDb['lastname'],
		                $userDb['id_number'],
		                $userDb['cel'],
		                $userDb['email'],
		                $userDb['pass'],
		                $userDb['rol']
		            );
		        }
		        return null;
		    } catch (Exception $e) {
		        die($e->getMessage());
		    }
		}




	}


 ?>