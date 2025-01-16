<?php

class Offer
{
    
    private $dbh; 
    private $id; 
    private $product_id; 
    private $discount; 
    private $term; 
    private $image; 

    
    public function __construct()
    {
        try {
            $this->dbh = DataBase::connection(); 
            $a = func_get_args(); 
            $i = func_num_args(); 
            if (method_exists($this, $f = '__construct' . $i)) {
                call_user_func_array(array($this, $f), $a); 
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    

    public function __construct5($id, $product_id, $discount, $term, $image)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->discount = $discount;
        $this->term = $term;
        $this->image = $image;
    }

    

    
    public function set_id($id)
    {
        $this->id = $id;
    }

    public function get_id()
    {
        return $this->id;
    }

    
    public function set_product_id($product_id)
    {
        $this->product_id = $product_id;
    }

    public function get_product_id()
    {
        return $this->product_id;
    }

    
    public function set_discount($discount)
    {
        $this->discount = $discount;
    }

    public function get_discount()
    {
        return $this->discount;
    }

    
    public function set_term($term)
    {
        $this->term = $term;
    }

    public function get_term()
    {
        return $this->term;
    }

    
    public function set_image($image)
    {
        $this->image = $image;
    }

    public function get_image()
    {
        return $this->image;
    }

    

    
    public function offer_create()
    {
        try {
            $sql = 'INSERT INTO offers (product_id, discount, term, image) VALUES (:product_id, :discount, :term, :image)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('product_id', $this->get_product_id());
            $stmt->bindValue('discount', $this->get_discount());
            $stmt->bindValue('term', $this->get_term());
            $stmt->bindValue('image', $this->get_image());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function offer_read()
    {
        try {
            $offerList = [];
            $sql = 'SELECT * FROM offers';
            $stmt = $this->dbh->query($sql);
            foreach ($stmt->fetchAll() as $offer) {
                $offerList[] = new Offer(
                    $offer['id'],
                    $offer['product_id'],
                    $offer['discount'],
                    $offer['term'],
                    $offer['image']
                );
            }
            return $offerList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    
    public function get_offer_by_id($id)
    {
        try {
            $sql = 'SELECT * FROM offers WHERE id = :id';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            $offerDb = $stmt->fetch();
            $offer = new Offer(
                $offerDb['id'],
                $offerDb['product_id'],
                $offerDb['discount'],
                $offerDb['term'],
                $offerDb['image']
            );
            return $offer;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    

    public function offer_update()
    {
        try {
            $sql = 'UPDATE offers SET product_id = :product_id, discount = :discount, term = :term, image = :image WHERE id = :id';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('product_id', $this->get_product_id());
            $stmt->bindValue('discount', $this->get_discount());
            $stmt->bindValue('term', $this->get_term());
            $stmt->bindValue('image', $this->get_image());
            $stmt->bindValue('id', $this->get_id());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    
    public function offer_delete($id)
    {
        try {
            $sql = 'DELETE FROM offers WHERE id = :id';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

?>
