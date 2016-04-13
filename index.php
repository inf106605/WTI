<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WTI Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/homepage.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->	
    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">

                    <div class="row carousel-holder">

                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img class="slide-image" src="img/carousel1.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="img/carousel2.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="img/carousel3.jpg" alt="">
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <h1>Polecane produkty:</h1>
					
                    <div class="row">                        

                        <?php
						
						// read cookies in php , generated in javascript
						
						try{
						
                        if (isset($_COOKIE)) {
							
							$id_product[] = key($_COOKIE);
						
							while(next($_COOKIE))
							{
								$id_product[] = key($_COOKIE);
							}
							
							array_pop($id_product); // ściągam ostatni element z tablicy ( domyślnie jest to PHPSSID )
							
							asort($id_product); // sortowanie tablicy
							
							/*
							foreach($id_product as $result)
							{
								echo $result;
							}
							*/
							
							$command_query = "SELECT ptt.id_product FROM Products p
												JOIN products_has_tag AS ptt ON 
												p.id_product = ptt.id_product
												JOIN tag AS t ON
												t.id_tag = t.id_tag
												WHERE ";
							
							$counter = 0;
							
							foreach($id_product as $result)
							{
								if($counter == 0)
								{
									$command_query .= "p.id_product = ".$result." ";
								}
								
								else if($counter > 0)
								{
									$command_query .= "OR p.id_product = ".$result." ";
								}
								
								$counter++;
							}
							
							//$command_query .= "GROUP BY p.id_product";
							
							echo $command_query;
							
							$sth = $dbh->prepare($command_query);
												
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

                          
                        } else {

							$results = $dbh->query("SELECT * FROM Products");

                           
                            $ilosc = 0;

                            foreach($results as $result) {

                                $ilosc++;

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

                                if ($ilosc == 6) {
                                    break;
                                }
                            }
                        }
						
						
						} catch(Exception $e)
						{
							echo 'Error. '.$e;
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