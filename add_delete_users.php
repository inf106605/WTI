<?php


if (isset($_POST['id_client']) && isset($_POST['id_order']) && isset($_POST['id_product']) && isset($_POST['id_deleted_product'])) {

    var_dump($_POST);

    $id_client = $_POST['id_client'];
    $id_product = $_POST['id_product'];
    $id_order = $_POST['id_order'];
    $id_deleted_product = $_POST['id_deleted_product'];

    $id_orders_products = 0;


    $sql = "					SELECT id_orders_products FROM OrdersProducts AS op
								INNER JOIN Products AS p 
								ON p.id_product = op.id_product
								INNER JOIN Orders AS o 
								ON o.id_order = op.id_order
								INNER JOIN Client AS c 
								ON c.id_client = o.id_client
								WHERE c.id_client = ? AND p.id_product = ? AND o.id_order = ? ";



    $params1 = array($id_client, $id_deleted_product, $id_order);

    $stmt1 = sqlsrv_query($conn, $sql, $params1);

    $rows = sqlsrv_has_rows($stmt1);

    if ($rows === true) {

        if ($stmt1 === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {

            $id_orders_products = $row['id_orders_products'];
        }
    }

    $sql2 = "DELETE FROM  OrdersProducts WHERE id_orders_products = ?";


    $params2 = array($id_orders_products);

    $stmt2 = sqlsrv_query($conn, $sql2, $params2);

    if ($stmt2 === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Produkt został usunięty z koszyka";
        echo '<a href="/sklep/cart.php">Powrót do wpisu.</a>';
        echo '<script>setTimeout("window.location.href=\"cart.php\";", 0);</script>';
    }
}
?>