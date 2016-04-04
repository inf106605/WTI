<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wyniki wyszukiwania - BD Projekt - Rowerowy sklep internetowy</title>

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

					<div>Wyszukiwanie zaawansowane</div>
				
                    <h1>Wyniki wyszukiwania:</h1>
                    <div class="row">
                        <?php
                       
					   
					   try{
					   
					   
					   
                        if (isset($_POST['pole_szukaj']) ) {

						
						$sth = $dbh->prepare("SELECT * FROM Products WHERE name_product like ?");
						$var = $_POST['pole_szukaj'];
						$sth->bindValue(1,"%$var%", PDO::PARAM_STR);
							
							$sth->execute();
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

                        if (isset($_POST['id_category'])) {

						
							$sql1 = $dbh->prepare("SELECT description2 FROM Category WHERE id_category = :id_cat");
							$var1 = $_POST['id_category'];
							$sql1->execute(array(':id_cat' => $var1));
							$results1 = $sql1->fetchAll();
										
								
							
							foreach($results1 as $result) {
							
                            echo '<div class="col-sm-12" style="margin-bottom: 30px">' . $result['description2'] . '</div>';

							}
							
							
							
							$sth = $dbh->prepare("SELECT * FROM Products p
									 INNER JOIN Category c
									 ON c.id_category = p.id_category
									 WHERE c.id_category = :id_cat");
							$var = $_POST['id_category'];
							$sth->execute(array(':id_cat' => $var));
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