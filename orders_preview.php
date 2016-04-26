<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zamówienia - WTI Projekt - Rowerowy sklep internetowy</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/orders_preview.css" rel="stylesheet">
	    <script type="text/javascript">
			function submitForm(action)
            {
                document.getElementById('name_form').action = action;
                document.getElementById('name_form').submit();
            }
   
	</script>
		
	<script> 
	$(function() {
		$( "#datepicker1" ).datepicker( { dateFormat: 'yy-mm-dd' } );
		
		$( "#datepicker2" ).datepicker( { dateFormat: 'yy-mm-dd' } );
		
		
		});
    </script>
	
	
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

					include_once('LabCharts/LabChartsBar.php');
					include_once('LabCharts/LabChartsLine.php');
					include_once('LabCharts/LabChartsPie.php');
					
                        $orders[] = 0;

                        $user_name = $_SESSION['user'];
						$id_client = '';
						
						$sth = $dbh->prepare("SELECT * FROM Orders o
						INNER JOIN Client AS c
						ON c.id_client = o.id_client
						WHERE c.user_login = ?");
						$sth->execute(array($user_name));
						$results = $sth->fetchAll();
							
						foreach($results as $result) {
							
							$orders[] = $result['id_order'];
							$id_client = $result['id_client'];
						}


						echo '<div class="col-sm-12"><h1>Twoje zamówienia:</h1></div>
						<form id="name_form" method="POST" action="factures.php">
						<div class="col-sm-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>ID Zamówienia</th>
                                <th>Zamówienie</th>
                              </tr>
                            </thead>
                            <tbody>';
 
                        $ile = count($orders);
                        for ($j = 1; $j < $ile - 1; $j++) {
                                echo '<tr><td>' . $orders[$j] . '</td>';
                                echo '<td><button name="id_orders" value="' . $orders[$j] . '" type="submit" class="btn btn-default small-button">Zobacz zamówienie</button></td>';
                            }
                        echo '</tbody>
                        </table>
						</form>
						</div>';
						
                       						
						// przycisk do pobierania pdf'a zestawiającego wszystkie zamówienia klienta

							echo '<center><form id="name_form" method="POST" action="generate_factures_to_pdf.php">
							<div id="date_picker">
							<p>Data początkowa: <input type="text" id="datepicker1" name="begin_date" /></p>
							<p>Data końcowa: <input type="text" id="datepicker2" name="end_date" /></p>
							</div>
							<button name="data_pdf" type="submit" class="btn btn-default big-button" value="0:'.$id_client.':datepicker">Pobierz zestawienie okresowe zamówień</button>
							</form></center>';
						
						echo '<center><form id="name_form" method="POST" action="generate_factures_to_pdf.php">
							<button name="data_pdf" type="submit" class="btn btn-default big-button" value="0:'.$id_client.':all">Pobierz zestawienie wszystkich zamówień</button>
							</form></center>';
						
/*
$LabChartsPie = new LabChartsPie();
$LabChartsPie->setData(array(100, 200, 200, 200, 430, 760, 54));
//$LabChartsPie->setType('p3');
$LabChartsPie->setTitle('Udziały w pewnej firmie');
$LabChartsPie->setSize('400x200');
$LabChartsPie->setColors('D9351C');
$LabChartsPie->setLabels('Marek|Franek|Michał|Lech|Jarosław|Grzesiek|Tomek');

echo '<img src="'.$LabChartsPie->getChart().'" />';

$LabChartsBar = new LabChartsBar();
$LabChartsBar->setData(array(85.8,57.5, 16.7, 5, 1.7));
$LabChartsBar->setSize('400x200');
$LabChartsBar->setTitle('Przychody w poszczególnych miesiącach');
//$LabChartsBar->setColors('D9351C|FAAC02|79D81C|2A9DF0|02AA9D');
$LabChartsBar->setLabels('Styczen|Luty|Marzec|Kwiecien|Maj');
$LabChartsBar->setBarStyles(40);
$LabChartsBar->setAxis(10);
$LabChartsBar->setGrids(10);

echo '<img src="'.$LabChartsBar->getChart().'" />';
*/

						$id_product[] = 0;
                        $name_product[] = 0;
                        $price_product[] = 0;
                        $amount_products[] = 0;
                        $nazwa_uzytkownika = $_SESSION['user'];
						$id_client = "";
						
						// suma z wszystkich zamówień
						
						$array_data_money = array();
						
						for($i=1; $i <= 12; $i++)
						{
						
							$sth = $dbh->prepare("SELECT o.id_order, SUM(p.price_brutto*op.amount_products) AS suma FROM Products AS p 
											  INNER JOIN OrdersProducts AS op
											  ON p.id_product=op.id_product
											  INNER JOIN Orders AS o 
											  ON o.id_order  = op.id_order
											  INNER JOIN Client AS c 
											  ON c.id_client = o.id_client
											  WHERE c.user_login = ?
											  AND EXTRACT(MONTH FROM o.date_order) = ?
											  AND EXTRACT(YEAR FROM o.date_order) = ?");
							$sth->execute(array($nazwa_uzytkownika,$i,date("Y")));
							$results = $sth->fetchAll();
							$sum = 0;
							foreach($results as $result) 
							{						
									$sum += $result['suma'];
							}
							
							array_push($array_data_money,$sum);
						
						}
						
						$max_value_in_array = max($array_data_money); // potrzebne do określenia podziałki osi y
						
						$scale_y = ($max_value_in_array / 10);
						
						$scale_y = floor($scale_y);
						
						echo "<br /><br /><h2>Statystyki</h2>";
						
						$LabChartsLine = new LabChartsLine();
						$LabChartsLine->setData($array_data_money);
						$LabChartsLine->setColors('D9351C');
						$LabChartsLine->setSize('700x300');
						$LabChartsLine->setTitle('Wydatki w poszczególnych miesiącach '.date("Y").' roku');
						$LabChartsLine->setAxis ($scale_y, 'Sty||Lut||Mar||Kwi||Maj||Cze||Lip||Sie||Wrz||Paź||Lis||Gru|');
						$LabChartsLine->setGrids (12);
						
						echo '<img src="'.$LabChartsLine->getChart().'" />';

						// % udział kategorii , z których najczęściej klient kupuje swoje produkty 
						
						$sth = $dbh->prepare("SELECT cat.name, COUNT(p.id_category) AS count_category FROM Products AS p 
											  INNER JOIN Category AS cat
                                              ON cat.id_category = p.id_category
											  INNER JOIN OrdersProducts AS op
											  ON p.id_product=op.id_product
											  INNER JOIN Orders AS o 
											  ON o.id_order  = op.id_order
											  INNER JOIN Client AS c 
											  ON c.id_client = o.id_client
											  WHERE c.user_login = ?
											  GROUP BY p.id_category");
						$sth->execute(array($nazwa_uzytkownika));
						$results = $sth->fetchAll();
						
						$array_data_category_count = array();
						$array_data_category_name = array();
						foreach($results as $result) 
						{						
							array_push($array_data_category_count,$result['count_category']);
							array_push($array_data_category_name,$result['name']);
						}
						
						$LabChartsPie = new LabChartsPie();
						$LabChartsPie->setData($array_data_category_count);
						$LabChartsPie->setType('p3');
						$LabChartsPie->setTitle('Procentowy udział kategorii kupowanych produktów');
						$LabChartsPie->setSize('700x300');
						$LabChartsPie->setColors('D9351C');
						$labelsString = '';

						foreach($array_data_category_name as $result) 
						{
								$labelsString .= $result.'|';							
						}
						
						$labelsString = rtrim($labelsString, "|");
						
						//echo $labelsString;
						
						$LabChartsPie->setLabels($labelsString);

						echo '<br/><br/><br/><img src="'.$LabChartsPie->getChart().'" />';
						
						

                    }
                    ?>

                </div>
            </div>
            <!-- /.container -->

            <?php include 'footer.php'; ?>

    </body>

</html>