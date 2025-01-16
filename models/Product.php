<?php

	class Product
	{
	    private $dbh;
	    private $id;  
	    private $name;  
	    private $description;  
	    private $technical_description;  
	    private $price;  
	    private $amount;  
	    private $category;  
	    private $image;  

		public function __construct() 
		{
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

	    public function __construct8($id,$name, $description, $technical_description, $price, $amount, $category, $image) {
	    	$this -> id 					= $id;
	        $this -> name 					= $name;
	        $this -> description 			= $description;
	        $this -> technical_description 	= $technical_description;
	        $this -> price 					= $price;
	        $this -> amount 				= $amount;
	        $this -> category 				= $category;
	        $this -> image 					= $image;
	    }



	    
	    public function set_id($id) {
	        $this -> id = $id;
	    }
	    public function get_id() {
	        return $this -> id;
	    }



	    public function set_name($name) {
	        $this -> name = $name;
	    }
	    public function get_name() {
	        return $this -> name;
	    }



	    public function set_description($description) {
	        $this -> description = $description;
	    }
	    public function get_description() {
	        return $this -> description;
	    }



	    public function set_technical_description($technical_description) {
	        $this -> technical_description = $technical_description;
	    }
	    public function get_technical_description() {
	        return $this -> technical_description;
	    }



	    public function set_price($price) {
	        $this -> price = $price;
	    }
	    public function get_price() {
	        return $this -> price;
	    }



	    public function set_amount($amount) {
	        $this -> amount = $amount;
	    }
	    public function get_amount() {
	        return $this -> amount;
	    }



	    public function set_category($category) {
	        $this -> category = $category;
	    }
	    public function get_category() {
	        return $this -> category;
	    }



	    public function set_image($image) {
	        $this -> image = $image;
	    }
	    public function get_image() {
	        return $this -> image;
	    }



	    public function product_create()
	    {
	        try {


	        	$sql = 'INSERT INTO products (id, name, description, technical_description, price, amount, category, image) 
	        				 VALUES (:id, :name, :description, :technical_description, :price, :amount, :category, :image)';

	            $stmt = $this->dbh->prepare($sql);

	            $stmt->bindValue(':id', $this->get_id());
	            $stmt->bindValue(':name', $this->get_name());
	            $stmt->bindValue(':description', $this->get_description());
	            $stmt->bindValue(':technical_description', $this->get_technical_description());
	            $stmt->bindValue(':price', $this->get_price());
	            $stmt->bindValue(':amount', $this->get_amount());
	            $stmt->bindValue(':category', $this->get_category());
	            $stmt->bindValue(':image', $this->get_image());

	            $stmt->execute();
	        } catch (Exception $e) {
	            die($e->getMessage());
	        }
	    }




	    
		public function products_read()
		{
		    try {
		        $productList = [];
		        $sql = 'SELECT * FROM products';
		        $stmt = $this->dbh->query($sql);

		        
		        foreach ($stmt->fetchAll() as $product) {
		            $productList[] = new Product(
		            	$product['id'],
		                $product['name'],
		                $product['description'],
		                $product['technical_description'],
		                $product['price'],
		                $product['amount'],
		                $product['category'],
		                $product['image']
		            );
		        }

		        
		        return $productList;

		    } catch (Exception $e) {
		        die($e->getMessage());
		    }
		}




		public function get_product_by_id($id)
		{
		    try {
		        $sql = 'SELECT * FROM products WHERE id = :id';
		        $stmt = $this->dbh->prepare($sql);
		        $stmt->bindValue('id', $id);
		        $stmt->execute();
		        $productDb = $stmt->fetch();

		        
		        $product = new Product(
		            $productDb['id'],
		            $productDb['name'],
		            $productDb['description'],
		            $productDb['technical_description'],
		            $productDb['price'],
		            $productDb['amount'],
		            $productDb['category'],
		            $productDb['image']
		        );

		        return $product;
		    } catch (Exception $e) {
		        die($e->getMessage());
		    }
		}




		public function update_product()
		{
		    try {
		        $sql = 'UPDATE products SET
		                    name = :name,
		                    description = :description,
		                    technical_description = :technical_description,
		                    price = :price,
		                    amount = :amount,
		                    category = :category,
		                    image = :image
		                WHERE id = :id';

		        $stmt = $this->dbh->prepare($sql);

		        $stmt->bindValue('id', $this->get_id());
		        $stmt->bindValue('name', $this->get_name());
		        $stmt->bindValue('description', $this->get_description());
		        $stmt->bindValue('technical_description', $this->get_technical_description());
		        $stmt->bindValue('price', $this->get_price());
		        $stmt->bindValue('amount', $this->get_amount());
		        $stmt->bindValue('category', $this->get_category());
		        $stmt->bindValue('image', $this->get_image());

		        $stmt->execute();
		    } catch (Exception $e) {
		        die($e->getMessage());
		    }
		}




		public function product_delete($id)
	    {
	       try {
				$sql = 'DELETE FROM products WHERE id = :id';
				$stmt = $this -> dbh -> prepare($sql);
				$stmt -> bindValue('id', $id);
				$stmt -> execute();
			} catch (Exception $e) {
				die($e -> getMessage());				
			}
	    }




		public function products_by_category($category_id)
		{
		    try {
		        $productList = [];
		        $sql = 'SELECT * FROM products WHERE category = :category';
		        $stmt = $this->dbh->prepare($sql);
		        $stmt->bindValue(':category', $category_id);
		        $stmt->execute();

		        foreach ($stmt->fetchAll() as $product) {
		            $productList[] = new Product(
		                $product['id'],
		                $product['name'],
		                $product['description'],
		                $product['technical_description'],
		                $product['price'],
		                $product['amount'],
		                $product['category'],
		                $product['image']
		            );
		        }

		        return $productList;

		    } catch (Exception $e) {
		        die($e->getMessage());
		    }
		}




public function update_amount($id, $new_amount) {
    try {
        $sql = 'UPDATE products SET amount = :amount WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':amount', $new_amount);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}



	






	}

?>
