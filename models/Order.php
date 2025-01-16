<?php 
class Order {
    private $dbh;

    public function __construct() {
        $this->dbh = DataBase::connection();
    }

    public function create_order($carrito) {
        try {
            $this->dbh->beginTransaction();

            // Insertar la orden principal
            $sql = "INSERT INTO orders (date, total) VALUES (NOW(), :total)";
            $stmt = $this->dbh->prepare($sql);
            $total = 0;

            foreach ($carrito as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }

            $stmt->bindValue(':total', $total);
            $stmt->execute();
            $orderId = $this->dbh->lastInsertId();

            // Insertar detalles de la orden
            $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt = $this->dbh->prepare($sql);

            foreach ($carrito as $id => $producto) {
                $stmt->bindValue(':order_id', $orderId);
                $stmt->bindValue(':product_id', $id);
                $stmt->bindValue(':quantity', $producto['cantidad']);
                $stmt->bindValue(':price', $producto['precio']);
                $stmt->execute();
            }

            $this->dbh->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->dbh->rollBack();
            die($e->getMessage());
        }
    }
}

 ?>