<?php
require_once("model/cart.php");
include_once("dbconn.php");
$connection = connect_to_db("motley");

print_r($connection->error);
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

class Model {

	public function __construct()  {

    if (!isset($_SESSION['cart'])) {
      	$_SESSION['cart'] = new ShoppingCart();
 	  }

    $_SESSION['conn'] = connect_to_db("motley");

  }


  //public function  to clear Cart() (not unset)
  public function clearCart(){
    $_SESSION = Array();
  }


	public function updateCart($type, $quantity) {
        //for now hardcode in type
        //$type = "latte";
        //$quantity = 1;
        $displayName = ShoppingCart::$alltypes[$type];

        if ($displayName && is_numeric($quantity) && $quantity > 0) {
            $_SESSION["cart"]->updateCart($type, $quantity);
            //$_SESSION["cart"]->order($type, $quantity);
            $message = "$quantity boxes of $displayName added to shopping cart";
        }
        else if (!$displayName) {
            $message = "Invalid selection";
        }
        else if (!is_numeric($quantity)) {
           $message = "Invalid; quantity not numeric";
        }
        else if ($quantity < 1) {
            $message = "Invalid; quantity less than 1";
        }
	       	return $message;
 	}

 	public function getCart() {
 		return $_SESSION["cart"]->getOrder();
 	}

    public function getCustomer() {
        return $_SESSION["cart"]->getCustomer();
    }

    public function addCustomer($key, $value){
        $_SESSION['cart']->addCustomer($key, $value);
    }

    public function order($drink, $quantity){
        $_SESSION['cart']->order($drink, $quantity);
    }

 	public function addToCart($type, $quantity) {
        //something is being added to the model without knowing??
        if($quantity > 0){
            $currentQuantity = $this->order[$type];
            $currentQuantity += $quantity;
            $this->order[$type] = $currentQuantity;
        }
 	}

  public function addCustomertoDb($name, $phone, $email, $carrier) {
      $connection = $_SESSION['conn'];
      include("model/queries.php");
      mysqli_stmt_execute($selectCustomer);
      print_r($connection->error);

      $selectCustomer -> bind_result($customerId);
      // Existing customer in database
      if ($selectCustomer -> fetch() ) {
        echo "Thanks for shopping again customer $customerId! <br />";
      }
      else {
        // Add to DB if new customer
        mysqli_stmt_execute($insertCustomer);
        $customerId = mysqli_stmt_insert_id($insertCustomer);
        print_r($connection->error);
        echo "Thanks for being a new customer!
        You are customer #$customerId. <br />";
      }
      // end statements
      echo "---ending customer table---";
      mysqli_stmt_close($selectCustomer);
      mysqli_stmt_close($insertCustomer);
}

  public function addDrinktoDb() {
    
  }

// public function getCustId ($name, $email) {
//   $connection = $_SESSION['conn'];
//   include("model/queries.php");
//   mysqli_stmt_execute($selectCustomer);
//   print_r($connection->error);
//
//   $selectCustomer -> bind_result($customerId);
//
//   mysqli_stmt_close($selectCustomer);
//   return $customerId;
// }

public function addOrdertoDb($customerId, $orderPrice, $date, $timedrop) {
    $connection = $_SESSION['conn'];
    include("model/queries.php");
    mysqli_stmt_execute($insertOrder);
    print_r($connection->error);
    echo "---starting insertOrder query--- <br />";
    $insertOrder -> bind_result($orderid);
    // Add to DB if new customer
    $orderid = mysqli_stmt_insert_id($insertOrder);
    print_r($connection->error);
    echo "Thanks for shopping! This is order #$orderid. <br />";

    // end statements
    mysqli_stmt_close($insertCustomer);
}
}


?>
