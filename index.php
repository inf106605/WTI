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
						<form method="POST" action="item.php">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
									<?php
									
									for($i=0; $i < 3; $i++)
									{
										if($i==0)
											echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
										else if($i > 0)
										{							
											echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
										}
									}
									?>
                                </ol>
                                <div class="carousel-inner">
									<?php
								   
								$sth = $dbh->prepare("SELECT * FROM Products
													ORDER BY date_add_products DESC
													LIMIT 5");
								$sth->execute();
								$results = $sth->fetchAll();
								
								$i = 0;
								
								foreach($results as $result) {
									
								

									   if($i==0)
									   {
										echo '<div class="item active">
											<center><button class="btn-default" name="id_product" value="2"><img class="slide-image" src="'.$result['photography'].'" style="max-width: 400px; max-height: 400px;" alt=""></button></center>
											<center><h2>'.$result['name_product'].'</h2></center>
										</div>';
									   }
									   else if($i > 0)
									   {
										   if($i == 3) break;
										
										echo '<div class="item">
											<center><button class="btn-default" name="id_product" value="2"><img class="slide-image" src="'.$result['photography'].'" style="max-width: 400px; max-height: 400px;" alt=""></button></center>
											<center><h2>'.$result['name_product'].'</h2></center>
										</div>';

										
										}
									
									$i++;
								   
								}	
									?>
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
							</form>
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
							
							$results = '';
							
							if(count($id_product) > 0)
							{
							
								$command_query = "SELECT ptt.id_tag FROM Products p
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
							
								$command_query .= " GROUP BY p.id_product LIMIT 25";
							
								$sth = $dbh->prepare($command_query);
												
								$sth->execute();
								
								$results = $sth->fetchAll();
								
								foreach($results as $result)
								{
									$id_tag[] = $result['id_tag'];
									//echo $result['id_tag'];
								}
								
								//echo "Przed: ".$command_query."<br/>";
								
								$command_query = ""; // wyczyszczenie zmiennej $command_query do ponownego użycia
								
								$command_query = "SELECT * FROM Products p
												JOIN products_has_tag AS ptt ON 
												p.id_product = ptt.id_product
												JOIN tag AS t ON
												t.id_tag = ptt.id_tag
												WHERE ";
								
								$counter = 0;
								
								foreach($id_tag as $result)
								{
									if($counter == 0)
									{
										$command_query .= "t.id_tag = ".$result." ";
									}
								
									else if($counter > 0)
									{
										$command_query .= "OR t.id_tag = ".$result." ";
									}
								
									$counter++;
								}
								
								$command_query .= " GROUP BY t.id_tag LIMIT 3";
								
								//echo "<br/> Po: ".$command_query."<br />";
								
								$sth = $dbh->prepare($command_query);	
								$sth->execute();
							}
							else{
								
								$sth = $dbh->prepare("SELECT * 
										FROM (
										SELECT id_tag, name_tag, COUNT(id_tag) AS TagsCount 
										FROM products_has_tag
										NATURAL JOIN tag
										GROUP BY id_tag
										) AS TagsCountQuery
										ORDER BY TagsCount DESC
										LIMIT 25");	
								$sth->execute();
								
								$results = $sth->fetchAll();
								
								foreach($results as $result)
								{
									$id_tag[] = $result['id_tag'];
								}
								
								$command_query = "SELECT * FROM
													Products AS p 
													JOIN products_has_tag AS ptt ON
													p.id_product = ptt.id_product
													JOIN tag AS t ON
													t.id_tag = ptt.id_tag
													WHERE";
								$licznik = 0;
								foreach($id_tag as $result)
								{
									if($licznik ==0 )
									{
										$command_query .= " t.id_tag = ".$result." ";
									}
									else if($licznik > 0)
									{
										$command_query .= " OR t.id_tag = ".$result." ";
									}
									$licznik++;
								}
								
								$command_query .= " GROUP BY p.id_product LIMIT 3";
								
								$sth = $dbh->prepare($command_query);	
								$sth->execute();
								
							}
							
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
					<?php
					
					if(count($_COOKIE) > 1)
					{
						echo '<h1>Ostatnio przeglądane produkty:</h1>';
					}
					
					?>
                    <div class="row">
					<?php
					// read cookies in php , generated in javascript
						
						try{
						
                        if (isset($_COOKIE)){
							
							
							$id_product[] = key($_COOKIE);
						
							while(next($_COOKIE))
							{
								$id_product[] = key($_COOKIE);
							}
							
							array_pop($id_product); // ściągam ostatni element z tablicy ( domyślnie jest to PHPSSID )
							
							asort($id_product); // sortowanie tablicy
							
							$command_query = "SELECT * FROM Products
												WHERE ";
							
								$counter = 0;
							
								foreach($id_product as $result)
								{
									if($counter == 0)
									{
										$command_query .= "id_product = ".$result." ";
									}
								
									else if($counter > 0)
									{
										$command_query .= "OR id_product = ".$result." ";
									}
								
									$counter++;
								}
							
								$command_query .= " GROUP BY id_product LIMIT 3";
							
								//echo $command_query;
							
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
				
							
							
							
							
						}
						
						}catch(Exception $e){
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