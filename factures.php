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

                    if (isset($_SESSION['user']) && isset($_POST['id_orders'])) {

                        $id_product[] = 0;
                        $name_product[] = 0;
                        $price_product[] = 0;
                        $amount_products[] = 0;
                        $id_order = $_POST['id_orders'];
                        $nazwa_uzytkownika = $_SESSION['user'];
						$id_client = "";
						
						$sth = $dbh->prepare("SELECT * FROM Products AS p 
							INNER JOIN OrdersProducts AS op
							ON p.id_product=op.id_product
							INNER JOIN Orders AS o 
							ON o.id_order  = op.id_order
							INNER JOIN Client AS c 
							ON c.id_client = o.id_client
							WHERE c.user_login = ? 
							AND o.id_order = ?");
						$sth->execute(array($nazwa_uzytkownika, $id_order));
						$results = $sth->fetchAll();
							
						foreach($results as $result) {
						
						    $id_product[] = $result['id_product'];
                            $name_product[] = $result['name_product'];
                            $amount_products[] = $result['amount_products'];
                            $price_product[] = $result['price_brutto'];
							$id_client = $result['id_client'];
						
						}

                        $ile = count($id_product); // ilosc produktów w zamówieniu

                        echo '<div class="col-sm-12"><h1>Zamówienie nr: ' . $id_order . '</h1></div>
                        <div class="col-sm-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>ID Produktu</th>
                                <th>Nazwa Produktu</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                              </tr>
                            </thead>
                            <tbody>';
                                
                            for ($j = 1; $j < $ile; $j++) {
                                echo '<tr><td>' . $id_product[$j] . '</td>';
                                echo '<td>' . $name_product[$j] . '</td>';
                                echo '<td>' . $amount_products[$j] . '</td>';
                                echo '<td>' . $price_product[$j] . ' zł</td></tr>';

                                $lp = $j;
                            }

                            echo '
                                
                            </tbody>
                        </table> 
                            ';

                        $laczny_koszt = 0;
                        for ($j = 1; $j < $ile; $j++) {
                            $laczny_koszt += $price_product[$j] * $amount_products[$j];
                        }

                        echo '<b>Łączny koszt: ' . $laczny_koszt . ' zł</b><br><br>
                              <a href="orders_preview.php" class="btn btn-default big-button">Powrót</a>
							  <center><form name="generate_pdf" action="generate_factures_to_pdf.php" method="POST" class="btn btn-default big-button"><button name="data_pdf" value="'.$id_order.':'.$id_client.':single">GENERUJ PDF</button></form></center>
                              </div>';

						$sth = $dbh->prepare("SELECT * FROM Client AS c 
						INNER JOIN Addresses AS ad ON
						c.id_adress = ad.id_adress
						INNER JOIN Contact AS co ON
						co.id_contact = c.id_contact
						WHERE c.id_client = ?");
						
						$sth->execute(array($id_client));
						$results = $sth->fetchAll();
							
						foreach($results as $result) {
						 
                            $dodatki = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $result['surname'] . '<br />Nazwisko: ' . $result['name'] . '<br />Adres wysyłki: <br />Ulica: ' . $result['street'] . ' ' . $result['number_house'] . '<br />Kod pocztowy: ' . $result['postal_code'] . '<br />Miejscowość: ' . $result['city'] . '<br />Województwo: ' . $result['province'] . '<br />Kraj: ' . $result['country'] . '<br />';
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- /.container -->

            <?php include 'footer.php'; ?>

    </body>

</html>