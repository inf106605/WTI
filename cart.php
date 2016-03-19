<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Koszyk - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/cart.css" rel="stylesheet">

        <script type="text/javascript">
            function submitForm(action)
            {
                document.getElementById('name_form').action = action;
                document.getElementById('name_form').submit();
            }
        </script>

    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">


                    <h1>Koszyk:</h1>
                    <div class="row">
                        <?php
                        
                        if (isset($_SESSION['user'])) {

                            $nazwa_uzytkownika = $_SESSION['user'];

                            $ostatni_order = 0; //ostatni order, którego posiadaczem jest klient o
                            // zdefiniowanej nazwie - domyślnie jest koszyk ze statusem niewysłany 
                            // bądź niezrealizowany
                            $id_uzytkownika = 0; // pobieram go na podstawie zalogowanego 
                            // użytkownika wykorzystując do tego jego login 
                            // dodawanie do koszyka wysyłanego id produktu i sprawdzanie czy już takowy produkt istnieje w zamówieniu

                            $czy_istnieje_juz_dodany_produkt = 'nie';

                            if (isset($_POST['id_product'])) {

                                $id_produktu = $_POST['id_product'];
                            }

                            //pobieranie ostatniego id zamówienia klienta

							$sth = $dbh->prepare("SELECT * FROM Orders o
							JOIN Client c ON
							c.id_client = o.id_client
							WHERE c.user_login = ?");
							$sth->execute(array($nazwa_uzytkownika));
							$results = $sth->fetchAll();
						                           

                            foreach($results as $result) {
							
									$ostatni_order = $result['id_order'];
                            }
							
							
							$sth = $dbh->prepare("SELECT * FROM Products AS p 
							INNER JOIN OrdersProducts AS op 
							ON p.id_product=op.id_product
							INNER JOIN Orders AS o
							ON o.id_order = op.id_order
							INNER JOIN Client AS c
							ON c.id_client = o.id_client
							WHERE c.user_login = ? AND o.id_order = ?");
							$sth->execute(array($nazwa_uzytkownika,$ostatni_order));
							$results = $sth->fetchAll();
						   
						    $ilosc_produktow = 0;
						   
                            
                                foreach($results as $result) {
									$ilosc_produktow++;
                                    //$ostatni_order = $result['id_order'];
                                    $id_uzytkownika = $result['id_client'];
                                    if ((isset($_POST['id_product'])) && ($id_produktu == $result['id_product']))
                                        $czy_istnieje_juz_dodany_produkt = 'tak';
                                }
                            
                            if($ilosc_produktow==0){ // zaden produkt jeszcze nie istnieje
							
							$sth = $dbh->prepare("SELECT * FROM Orders o
									INNER JOIN Client AS c
									ON c.id_client = o.id_client
									WHERE c.user_login = ?");
							$sth->execute(array($nazwa_uzytkownika));
							$results = $sth->fetchAll();
							
						
                                foreach($results as $result) {
									//$ostatni_order = $result['id_order'];
                                    $id_uzytkownika = $result['id_client'];
                                }
                            }

                            // dodanie nowego produktu do zamówienia 

                            if ((isset($_POST['id_product'])) && ($czy_istnieje_juz_dodany_produkt == 'nie')) 
							{
								
								$statement = $dbh->prepare("INSERT INTO OrdersProducts(id_order,id_product) VALUES(?,?)");
								
								if($statement->execute(array($ostatni_order, $id_produktu)));
								else echo "Eror: INSERT INTO OrdersProducts ...";
								
                            }
							
							$sth = $dbh->prepare("SELECT * FROM Products AS p 
							INNER JOIN OrdersProducts AS op
							ON p.id_product=op.id_product
							INNER JOIN Orders AS o 
							ON o.id_order  = op.id_order
							INNER JOIN Client AS c 
							ON c.id_client = o.id_client
							WHERE c.id_client = ? 
							AND o.id_order = ?");
							$sth->execute(array($id_uzytkownika, $ostatni_order));
							$results = $sth->fetchAll();

							
                            echo '<form id="name_form" method="POST" action="test.php">';


                            foreach($results as $result) {

                                echo '<input name="id_client" type="text" style="display:none;" value="' . $result['id_client'] . '" />';
                                echo '<input name="id_order" type="text" style="display:none;" value="' . $result['id_order'] . '" />';
                                echo '<input name="id_product[]" type="text" style="display:none;" value="' . $result['id_product'] . '" />';

                                echo '
                                <div class="col-sm-4">
                                    <div class="box">
                                        <div class="image">
                                            <img src="' . $result['photography'] . '" class="img-responsive" alt="">
                                        </div>
                                        <div class="caption">
                                            <button>' . $result['name_product'] . '</button>
                                            <span class="price">' . $result['price_brutto'] . '</span>
                                            <input class="form-control" name="amount_product[]" type="number" value="1">
                                            <input type="submit" class="delete" name="id_deleted_product" value="' . $result['id_product'] . '" onclick="submitForm(\'delete_products_order.php\')" >
                                        </div>
                                    </div>
                                </div>
                                ';
                            }

                            // test.php - testowanie , orders.php - złożenie zamówienia
                            echo '<div class="col-sm-12">
                                <button type="submit" class="btn btn-default big-button" onclick="submitForm(\'orders.php\')">Złóż zamówienie</button>
                             </div></form>';

                            
                        } else {
                            echo '<div class="col-sm-12">';
                            echo 'Nie masz dostępu do koszyka, jesteś niezalogowany.<br>';
                            echo '<a href="/sklep/login.php">Zaloguj</a>';
                            echo ' lub <a href="/sklep/register.php">załóż konto</a></div>';
                        }
						//echo $ostatni_order;
                        ?>

                    </div>

                </div>

            </div>

        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>


</html>