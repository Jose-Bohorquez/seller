<?php 

require_once "models/Offer.php";

class Offerts
{
    

    public function create_offer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            require_once "models/Product.php";
            $product = new Product; 
            $products = $product->products_read(); 

           
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/new_offer.php";
            require_once "views/dashboard/modules/footer.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $image_path = $this->handle_image_upload(); 

            $offer = new Offer(
                null, 
                $_POST['product_id'],
                $_POST['discount'],
                $_POST['term'],
                $image_path 
            );

            $offer->offer_create(); 
            header("Location: ?c=Offerts&a=read_offer"); 
        }
    }

   


    public function read_offer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $offer = new Offer;
            $offers = $offer->offer_read(); 
            require_once "views/dashboard/modules/1_header.php";
            require_once "views/dashboard/modules/2_nav_lat.php";
            require_once "views/dashboard/modules/3_nav_sup.php";
            require_once "views/dashboard/pages/read_offers.php"; 
            require_once "views/dashboard/modules/footer.php";
        }
    }

   
public function update_offer()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $offer = new Offer;
        $offer = $offer->get_offer_by_id($_GET['id']); 
        
        
        require_once "views/dashboard/modules/1_header.php";
        require_once "views/dashboard/modules/2_nav_lat.php";
        require_once "views/dashboard/modules/3_nav_sup.php";
        require_once "views/dashboard/pages/update_offert.php"; 
        require_once "views/dashboard/modules/footer.php";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_FILES['offer_image']) && $_FILES['offer_image']['error'] == 0) {
            
            $image_path = $this->handle_image_upload();
        } else {
            
            $image_path = isset($_POST['existing_image']) ? $_POST['existing_image'] : ''; 
        }

        
        $offer = new Offer(
            $_POST['id'], 
            $_POST['product_id'],
            $_POST['discount'],
            $_POST['term'],
            $image_path 
        );

        
        $offer->offer_update(); 

        
        header("Location: ?c=Offerts&a=read_offer");
    }
}



   
    public function delete_offer()
    {
        $offer = new Offer;
        $offer->offer_delete($_GET['id']); 
        header("Location: ?c=Offerts&a=read_offer"); 
    }

   
    private function handle_image_upload()
    {
        if (isset($_FILES['offer_image']) && $_FILES['offer_image']['error'] == 0) {
            $target_dir = 'assets/imagenes/offers/'; 

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); 
            }

           
            $image_extension = pathinfo($_FILES['offer_image']['name'], PATHINFO_EXTENSION);

           
            $image_name = uniqid('offer_', true) . '.' . $image_extension;
            $target_file = $target_dir . $image_name;

           
            if (move_uploaded_file($_FILES['offer_image']['tmp_name'], $target_file)) {
                return $target_file; 
            } else {
                return null; 
            }
        }
        return null; 
    }
}
?>
