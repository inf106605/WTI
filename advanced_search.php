<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wyniki wyszukiwania zaawnsowanego - Rowerex - Rowerowy sklep internetowy</title>

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
					<div class="panel panel-info">
					<form action="advanced_search.php" method="POST">
					<h3>Szukaj</h3>
					<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">Słowo(a):</label>
							<input name="words_input" type="text" class="form-control" id="exampleInputName2" placeholder="Wpisz słowa">
							<select name="type_search_content" class="form-control">
								<option value="1">Szukaj w tytułach</option>
								<option value="2">Szukaj zawartość postów</option>
							</select>
						</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">Tag:</label>
							<input name="tags_input" type="text" class="form-control" id="exampleInputName2" placeholder="Wpisz słowa" alt="Istnieje możliwość wpisania wielu tagów po przecinku lub spacji" />
						</div>
					</div>
					<h3>Dodatkowe opcje</h3>
					<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">Szukaj produktów po:</label>
							<select name="date_search" class="form-control">
								<option value="1">Obojętna data</option>
								<option value="2">Od twojej ostatniej wizyty</option>
								<option value="3">Wczoraj</option>
								<option value="4">Tydzień temu</option>
								<option value="5">2 tygodnie temu</option>
								<option value="6">Miesiąc temu</option>
								<option value="7">3 miesięcy temu</option>
								<option value="8">Rok temu</option>
							</select>
							<select name="date_search_extension" class="form-control">
								<option value="1">i nowsze</option>
								<option value="2">i starsze</option>
							</select>
						</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">Sortuj po:</label>
							<select name="sort_by_type_content" class="form-control">
								<option value="1">Tytuł</option>
								<option value="2">Data</option>
							</select>
							<select name="sort_type" class="form-control">
								<option value="1">malejąco</option>
								<option value="2">rosnąco</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<center><button type="submit" class="btn btn-default">Szukaj teraz</button></center>
					</div>
				</form>
					<h3>Chmura tagów:</h3>
					<?php

							$sth = $dbh->prepare("SELECT * FROM tag AS t
												  JOIN products_has_tag AS ptt 
												  ON t.id_tag = ptt.id_tag
											     ");
                            $sth->execute();
							$results = $sth->fetchAll();
							
					echo '<form action="tag.php" method="POST"> 
							<div class="form-inline">
							<div class="form-group">';
							
							foreach($results as $result) {
								echo '<button name="name_tag" type="submit" class="btn btn-default" value="'.$result['name_tag'].'">'.$result['name_tag'].'</button>';
							}
							
							echo '</div>
								</div>
							</form>'; ?>
					</div>
					
					   <?php
                       
					    function get_remote_data($url, $post_paramtrs = false) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    if ($post_paramtrs) {
        curl_setopt($c, CURLOPT_POST, TRUE);
        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&" . $post_paramtrs);
    } curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
    curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
    $follow_allowed = ( ini_get('open_basedir') || ini_get('safe_mode')) ? false : true;
    if ($follow_allowed) {
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    }curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
    curl_setopt($c, CURLOPT_REFERER, $url);
    curl_setopt($c, CURLOPT_TIMEOUT, 60);
    curl_setopt($c, CURLOPT_AUTOREFERER, true);
    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
    $data = curl_exec($c);
    $status = curl_getinfo($c);
    curl_close($c);
    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si', $status['url'], $link);
    $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si', '$1=$2' . $link[0] . '$3$4$5', $data);
    $data = preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si', '$1=$2' . $link[1] . '://' . $link[3] . '$3$4$5', $data);
    if ($status['http_code'] == 200) {
        return $data;
    } elseif ($status['http_code'] == 301 || $status['http_code'] == 302) {
        if (!$follow_allowed) {
            if (empty($redirURL)) {
                if (!empty($status['redirect_url'])) {
                    $redirURL = $status['redirect_url'];
                }
            } if (empty($redirURL)) {
                preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);
                if (!empty($m[2])) {
                    $redirURL = $m[2];
                }
            } if (empty($redirURL)) {
                preg_match('/href\=\"(.*?)\"(.*?)here\<\/a\>/si', $data, $m);
                if (!empty($m[1])) {
                    $redirURL = $m[1];
                }
            } if (!empty($redirURL)) {
                $t = debug_backtrace();
                return call_user_func($t[0]["function"], trim($redirURL), $post_paramtrs);
            }
        }
    } return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:" . json_encode($status) . "<br/><br/>Last data got<br/>:$data";
}
					   try{
					   
					                  
                        if (isset($_POST['words_input']) && isset($_POST['type_search_content']) && isset($_POST['tags_input']) && isset($_POST['date_search']) && isset($_POST['date_search_extension']) && isset($_POST['sort_by_type_content']) && isset($_POST['sort_type']))  
						{

						/*SŁOWA*/
						
						// zapisanie listy wyrazów $_POST do zmiennej lokalnej
						
						$word_input = $_POST['words_input'];
						
						// określenie listy znaków które mają być zamienione na spację 
						$replace = array(",",";",".");
						
						// zamiana wyrazów, które występują w tablicy array na spację
						$word_input_replaced = str_replace($replace, " " , $word_input);						
						
						// splitowanie wyrazów z wykorzystaniem wyrażeń regularnych
						$word_input_split = preg_split("/[\s,!@#$%^\&*()+-=\/<>{}?_]/", $word_input_replaced);
						
						echo "Słowo(a): ";
						
						foreach($word_input_split as $result)
						{
							echo $result.' ';
						}
						
						/*TAGI*/
						
						// zapisanie listy tagów $_POST do zmiennej lokalnej
						$tags_input = $_POST['tags_input'];
						
						// określenie listy znaków które mają być zamienione na spację - wykorzystam wcześniej
						// zdefiniowaną zmienną replace
						$tags_input_replaced = str_replace($replace, " ", $tags_input);
						
						// splitowanie wyrazów z wykorzystaniem wyrażeń regularnych
						
						$tags_input_split = preg_split("/[\s,!@#$%^\&*()+-=\/<>{}?_]/", $tags_input_replaced);
						
						echo "<br />Tagi: ";
						
						foreach($tags_input_split as $result)
						{
							echo $result.' ';
						}
					
						// wyszukiwanie rzeczowników w wynikach wyszukiwania z wykorzystaniem sjp.pl
						/*
						foreach($word_input_split as $result)
						{
							$downloaded_url = get_remote_data('https://pl.wiktionary.org/wiki/'.$result);
							
							if(strpos($downloaded_url,'odmiana-rzeczownik'))
							{
								echo '<br />'.$result.' jest rzeczownikiem <br/>';
							}
							else if(strpos($downloaded_url,'<div style="border: 1px solid #ccc; padding: 7px; background: white;"><b>W Wikisłowniku nie ma jeszcze hasła pod taką nazwą. Masz do wyboru:</b>'))
							{
								$downloaded_url1 = get_remote_data('http://sjp.pl/'.$result);
								
								if(strpos($downloaded_url1,'<tr><th scope="row" valign="top"><tt>M') || strpos($downloaded_url1,'<tr><th scope="row" valign="top"><tt>U</tt></th><td>'))
								{
									echo '<br />'.$result.' jest rzeczownikiem <br/>';
								}
							}
						}
						
						*/
						
						
						

						echo '<h1>Wyniki wyszukiwania zaawansowanego:</h1>
						<div class="row">';
						
						$sth = $dbh->prepare("SELECT * FROM Products WHERE name_product like ?");
						$var = $_POST['words_input'];
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