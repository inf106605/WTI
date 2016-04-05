<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $_POST['name_tag'] ?> - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/search.css" rel="stylesheet">

    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">

                    <h1>Produkty powiązane z tagiem <?php echo $_POST['name_tag'] ?></h1>
                    <div class="row">
                        <?php
                       
					   
					   try{
					   
					   
					   
                        if (isset($_POST['name_tag']) ) {

						
						$sth = $dbh->prepare("SELECT * FROM Products AS p 
											  JOIN products_has_tag AS ppt ON 
											  p.id_product = ppt.id_product 
											  JOIN tag AS t ON 
											  t.id_tag = ppt.id_tag 
											  WHERE t.name_tag = ?");
						$var = $_POST['name_tag'];							
						$sth->execute(array($var));
						$results = $sth->fetchAll();
						
                             foreach($results as $result) { 


                                echo '<form id="name_form" method="POST" action="item.php">';
                                echo '<input name="id_product" type="text" style="display:none;" value="' . $result['id_product'] . '" />';
                                echo '
                                <div class="col-sm-4">
                                    <div class="box">
                                        <div class="image">
                                            <img src="' . $result['photography'] . '" class="img-responsive" alt="">
                                        </div>
                                        <div class="caption">
                                            <button>' . $result['name_product'] . '</button>
                                            <span class="price">' . $result['price_brutto'] . '</span>
                                            <div class="description">' . $result['descriptions'] . '</div>
                                        </div>
                                    </div>
                                </div>
                                ';
                                echo '</form>';
                            

                        
                        }
						
						}
						
					   }catch(Exception $e)
					   {
						   echo "Error. ".$e;
					   }
						
                        ?>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>


</html>