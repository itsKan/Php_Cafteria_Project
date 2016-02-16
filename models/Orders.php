<?php 
/**
* 
*/
class Orders
{
	private $dbConnection;
	function __construct(mysqli $dbCon) {
		$this->dbConnection = $dbCon;
	}
	function addOrder() {
		$orderQuery = "insert into orders values ('','".$_POST['status']."',".$_POST['u_id'].","
			.$_POST['room_no'].",curdate(),curtime(),'');";
		$this->dbConnection->query($orderQuery);
		$products = $_SESSION['products'];
		if ($this->dbConnection->affected_rows > 0) {
			foreach ($products as $pId => $quantity) {
				$detailQuery = "insert into orders_details values (".$pId.",last_insert_id(),"
					.$quantity.",".$quantity."*(select u_price from products where p_id = ".$pId."));";
				$this->dbConnection->query($detailQuery);
			}
		}
		$totalPrice = "update orders set total_price = (select sum(total_price) 
					from orders_details where o_id = last_insert_id());";
		$this->dbConnection->query($totalPrice);
		echo $this->dbConnection->error;
		return $this->dbConnection->affected_rows;
	}	
	function setOrderStatus($status,$oId) {
		$query = "update orders set status='".$status."' where o_id=".$oId.";";
		$this->dbConnection->query($query);
		return $this->dbConnection->affected_rows;
	}
	function getOrderDetails($oId) {
		$query = "select products.*, orders_details.* from products,orders_details 
			where products.p_id = orders_details.p_id and orders_details.o_id =".$oId.";";
		$result = $this->dbConnection->query($query);
		return $result;
	}
	function getOrders($optQString) {
		if (!isset($optQString)) {
			$optQString = "";
		}
		$query = "select orders.*,users.u_name,users.ext from orders,users where orders.u_id = users.u_id ".$optQString;
		$result = $this->dbConnection->query($query);
		return $result;
	}
	function getOrdersByUser() {
		$query = "select * from orders where u_id = ".$_POST['u_id'];
		$result = $this->dbConnection->query($query);
		return $result;	
	}
	function getOrdersByDateRange() {
		$query = "select * from orders where date between date('".$_GET['from'].
				"') and date('".$_GET['to']."');";
		$result = $this->dbConnection->query($query);
		return $result;		
	}
	function getOrderTotal() {
		$query = "select total_price from orders where o_id = ".$_POST['o_id'];
		$result = $this->dbConnection->query($query);
		return $result;
	}
	function getOrder($oId) {
		$query = "select * from orders where o_id =".$oId;
		$result = $this->dbConnection->query($query);	
		return $result->fetch_assoc();	
	}
}
?>