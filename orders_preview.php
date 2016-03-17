<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zamówienia - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/orders_preview.css" rel="stylesheet">

    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">

                    <?php
                    if (isset($_SESSION['user'])) {

                        $orders[] = 0;

                        $nazwa_uzytkownika = $_SESSION['user'];
						
						
						$sth = $dbh->prepare("SELECT * FROM Orders o
						INNER JOIN Client AS c
						ON c.id_client = o.id_client
						WHERE c.user_login = ?");
						$sth->execute(array($nazwa_uzytkownika));
						$results = $sth->fetchAll();
							
						foreach($results as $result) {
							
							$orders[] = $result['id_order'];
							
						}
						
                        echo '<div class="col-sm-12"><h1>Twoje zamówienia:</h1></div>';

                        $ile = count($orders);

                        for ($j = 1; $j < $ile - 1; $j++) {

                            echo '
                            
                            <div class="col-sm-4">
                                <form id="name_form" method="POST" action="factures.php">
                                    <div class="box"> 
                                        <div>Zamowienie nr ' . $orders[$j] . '</div>
                                        <button name="id_orders" value="' . $orders[$j] . '" type="submit" class="btn btn-default big-button">Zobacz zamówienie</button>
                                    </div>
                                </form>
                            </div>
                            
                            ';
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- /.container -->

            <?php include 'footer.php'; ?>

    </body>

</html>