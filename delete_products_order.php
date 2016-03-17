<?php


include('../db.php');

if (isset($_POST['id_client']) && isset($_POST['id_order']) && isset($_POST['id_product']) && isset($_POST['id_deleted_product'])) {

    //var_dump($_POST);

    $id_client = $_POST['id_client'];
    $id_product = $_POST['id_product'];
    $id_order = $_POST['id_order'];
    $id_deleted_product = $_POST['id_deleted_product'];

    $id_orders_products = 0;

	
	$sth = $dbh->prepare("SELECT id_orders_products FROM OrdersProducts AS op
						INNER JOIN Products AS p 
						ON p.id_product = op.id_product
						INNER JOIN Orders AS o 
						ON o.id_order = op.id_order
						INNER JOIN Client AS c 
						ON c.id_client = o.id_client
						WHERE c.id_client = ? AND p.id_product = ? AND o.id_order = ?");
						$sth->execute(array($id_client, $id_deleted_product, $id_order));
						$results = $sth->fetchAll();
							
						foreach($results as $result) {
							
							$id_orders_products = $result['id_orders_products'];
	
						}
	
	
			$statement = $dbh->prepare("DELETE FROM  OrdersProducts WHERE id_orders_products = ?");
			if($statement->execute(array($id_orders_products)))
			{
				echo "Produkt został usunięty z koszyka";
				echo '<a href="/sklep/cart.php">Powrót do wpisu.</a>';
				echo '<script>setTimeout("window.location.href=\"cart.php\";", 0);</script>';
			}
			else echo "Eror: DELETE FROM OrdersProducts WHERE id_orders_products ...";
	
}
?>