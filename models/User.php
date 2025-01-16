<?php 

	class User
	{

		private $dbh; # variable de conexion data base handler
		private $id_user;
		private $name;	
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

        public function __construct8($id_user,$name,$lastname,$id_number,$cel,$email,$pass,$rol)
        {
        	$this -> id_user	 = $id_user;
        	$this -> name		 = $name;
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


		# Metodos set() y get() name
		public function set_name($name)
		{
			$this -> name = $name;
		}
		public function get_name()
		{
			return $this -> name;
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
            $sql = 'INSERT INTO USER (name, lastname, id_number, cel, email, pass, rol) 
                    VALUES (:name, :lastname, :id_number, :cel, :email, :pass, :rol)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('name', $this->name);
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
				$sql = 'SELECT * FROM USER';
				$stmt = $this -> dbh -> query($sql);
				foreach ($stmt -> fetchAll() as $user) {
					$userList[] = new User(
						$user['id_user'],
						$user['name'],
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
        $sql = 'SELECT u.*, r.name as role_name
                FROM USER u
                JOIN ROL r ON u.rol = r.id_rol
                WHERE id_user = :id_user';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue('id_user', $id_user);
        $stmt->execute();
        $userDb = $stmt->fetch();

        if ($userDb) {
            $this->id_user = $userDb['id_user'];
            $this->name = $userDb['name'];
            $this->lastname = $userDb['lastname'];
            $this->id_number = $userDb['id_number'];
            $this->cel = $userDb['cel'];
            $this->email = $userDb['email'];
            $this->pass = $userDb['pass'];
            $this->rol = $userDb['rol'];
            return $this;
        }
        return null;
    } catch (Exception $e) {
        throw new Exception("Error al obtener el usuario: " . $e->getMessage());
    }
}





		public function user_update()
		{
			try {

				$sql = 'UPDATE USER SET
							id_user 	= :id_user,
							name 		= :name,
							lastname 	= :lastname,
							id_number 	= :id_number,
							cel 		= :cel,
							email 		= :email,
							pass 		= :pass,
							rol 		= :rol

						WHERE id_user 	= :id_user ';

				$stmt = $this -> dbh -> prepare($sql);				
				$stmt -> bindValue('id_user',$this -> get_id_user() );	
				$stmt -> bindValue('name',$this -> get_name() );
				$stmt -> bindValue('lastname',$this -> get_lastname() );
				$stmt -> bindValue('id_number',$this -> get_id_number() );
				$stmt -> bindValue('cel',$this -> get_cel() );
				$stmt -> bindValue('email',$this -> get_email() );
				$stmt -> bindValue('pass',$this -> get_pass() );
				$stmt -> bindValue('rol',$this -> get_rol() );		
				$stmt -> execute();
				
			} catch (Exception $e) {
				die($e -> getMessage());				
			}
		}



		public function user_delete($id_user)
		{
			try {
				$sql = 'DELETE FROM USER WHERE id_user = :id_user';
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
		        $sql = 'SELECT * FROM USER WHERE email = :email AND pass = :password';
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