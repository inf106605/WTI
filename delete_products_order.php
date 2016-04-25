<?php


include('../db.php');

if (isset($_POST['id_client']) && isset($_POST['id_order']) && isset($_POST['id_product']) && isset($_POST['id_deleted_product'])) {

    //var_dump($_POST);

    $id_client = $_POST['id_client'];
    $id_product = $_POST['id_product'][0];
    $id_order = $_POST['id_order'];


	$statement = $dbh->prepare("DELETE FROM OrdersProducts WHERE id_order = ? AND id_product = ?");
	if($statement->execute(array($id_order,$id_product)))
	{
		echo "Produkt został usunięty z koszyka";
		echo '<a href="/sklep/cart.php">Powrót do wpisu.</a>';
		echo '<script>setTimeout("window.location.href=\"cart.php\";", 0);</script>';
	}
	
	else echo "Eror: DELETE FROM OrdersProducts WHERE id_order = ? and id_product = ?  ...";
	
}
?>