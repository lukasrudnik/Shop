<?php

require_once 'User.php';

class Order
{

    private $id;
    private $user_id;
    private $product_id;
    private $status;
    private $amount;

    public function __construct()
    {
        $this -> id         = -1;
        $this -> user_id    = "";
        $this -> product_id = "";
        $this -> status     = "Nowe";
        $this -> amount     = "";
    }

    function getId()
    {
        return $this -> id;
    }

    function getUser_id()
    {
        return $this -> user_id;
    }

    function getProduct_id()
    {
        return $this -> product_id;
    }

    function getStatus()
    {
        return $this -> status;
    }

    function getAmount()
    {
        return $this -> amount;
    }

    function setId($id)
    {
        $this -> id = $id;
    }

    function setUser_id($user_id)
    {
        $this -> user_id = $user_id;
    }

    function setProduct_id($product_id)
    {
        $this -> product_id = $product_id;
    }

    function setStatus($status)
    {
        $this -> status = $status;
    }

    function setAmount($amount)
    {
        $this -> amount = $amount;
    }

    static public function saveToDB(mysqli $connection)
    {
        $sql    = sprintf("INSERT INTO Orders (`user_id`, `product_id`, `status`, `amount`)
                VALUES ('%s', '%s', '%s', '%s';", $this -> getUser_id(), $this -> getProduct_id(), $this -> getStatus(), $this -> getAmount());
        $result = $connection -> query($sql);
        if ($result == true) {
            $this -> id = $connection -> insert_id;
            return $this -> id;
        }
        return false;
    }

    static public function deleteFromDB(mysqli $connection, $id)
    {
        $sql    = "DELETE FROM Orders WHERE id = '$id'";
        $result = self::$connection -> query($sql);
        if ($result === true) {
            $deleted = "Zamówienie usunięte z bazy danych";
            return $deleted;
        }
        return false;
    }

    static public function loadAllOrders(mysqli $connection)
    {
        $tab = [];

        $sql    = "SELECT * FROM `Orders`";
        $result = $connection -> query($sql);
        if ($result == true && $result -> num_rows != 0) {
            foreach ($result as $row) {
                $orderNew               = new Order();
                $orderNew -> id         = $row['id'];
                $orderNew -> user_id    = $row['user_id'];
                $orderNew -> product_id = $row['product_id'];
                $orderNew -> status     = $row['status'];
                $orderNew -> amount     = $row['amount'];
                $tab[]                  = $orderNew;
            }
            return $tab;
        }
        return null;
    }

    static public function loadOrdersByUserId(mysqli $connection, $user_id)
    {
        $tab = [];

        $sql    = "SELECT * FROM `Orders` WHERE user_id = $user_id ";
        $result = $connection -> query($sql);
        if ($result == true && $result -> num_rows != 0) {
            foreach ($result as $row) {
                $orderNew               = new Order();
                $orderNew -> id         = $row['id'];
                $orderNew -> user_id    = $row['user_id'];
                $orderNew -> product_id = $row['product_id'];
                $orderNew -> status     = $row['status'];
                $orderNew -> amount     = $row['amount'];
                $tab[]                  = $orderNew;
            }
            return $tab;
        }
        return null;
    }

    static public function loadOrdersById(mysqli $connection, $id)
    {
        $sql    = "SELECT * FROM `Orders` WHERE id = $id";
        $result = $connection -> query($sql);
        if ($result == true && $result -> num_rows == 1) {
            $row                    = $result -> fetch_assoc();
            $orderNew               = new Order();
            $orderNew -> id         = $row['id'];
            $orderNew -> user_id    = $row['user_id'];
            $orderNew -> product_id = $row['product_id'];
            $orderNew -> status     = $row['status'];
            $orderNew -> amount     = $row['amount'];
            return $orderNew;
        }
        return null;
    }
}
