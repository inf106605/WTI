<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BD Projekt - Rowerowy sklep internetowy</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/item.css" rel="stylesheet">
    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">
                    <div class="box">

                        <?php
                        
                        if (isset($_POST['id_product'])) {


                            $sth = $dbh->prepare("SELECT * FROM Products WHERE id_product = ?");
                            $var = $_POST['id_product'];
                            $sth->execute(array($var));
							$results = $sth->fetchAll();
							
                       
                            foreach($results as $result) {

                                echo '<form id="name_form" method="POST" action="cart.php">';
                                echo '<input name="id_product" type="text" style="display:none;" value="' . $result['id_product'] . '" />';
                                echo '<img class="img-responsive" src="' . $result['photography'] . '" alt="">

                                    <div class="caption-full">
                                        <h1>' . $result['name_product'] . ' </h1>
                                        <span class="price">' . $result['price_brutto'] . ' zł</span>
                                        <div class="description">' . $result['descriptions'] . '</div>';
										if($result['amount'] > 0)
										{
											echo '<button type="submit" class="btn btn-default big-button">Dodaj do koszyka</button>';
										}
										else 
										{
											echo '<h2>Brak produktów na stanie!</h2>';
										}
                                echo    '</div>
                                </form>';
                            }
							
							
							$sth = $dbh->prepare("SELECT * FROM tag AS t
												  JOIN products_has_tag AS ptt 
												  ON t.id_tag = ptt.id_tag
												  WHERE ptt.id_product = ?");
                            $var = $_POST['id_product'];
                            $sth->execute(array($var));
							$results = $sth->fetchAll();
							
							echo '<form action="tag.php" method="POST"> 
							<div class="form-inline">
							<div class="form-group">
							<label for="exampleInputName2">Tagi:</label>';
							
							foreach($results as $result) {
								echo '<button name="name_tag" type="submit" class="btn btn-default" value="'.$result['name_tag'].'">'.$result['name_tag'].'</button>';
							}
							
							echo '</div>
								</div>
							</form>';
							
							
                        } else
                            echo "Produkt nie istnieje!";
                        ?>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>

</html>
