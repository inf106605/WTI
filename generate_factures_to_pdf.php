<?php

	session_start();  // start sesji ( zastanowić się czy potrzebne )

	include('../db.php'); // wczytanie ustawień połączenia z bazą danych

	// array(4) { ["id_client"]=> string(2) "17" ["id_order"]=> string(2) "22" ["id_product"]=> array(1) { [0]=> string(1) "2" } ["amount_product"]=> array(1) { //[0]=> string(1) "1" } } 
 
	if ( isset($_SESSION['user']) && isset($_POST['data_pdf']) && isset($_POST['data_pdf']) != "" )
	{
		
			// var_dump($_POST); // podgląd wysyłanych zmiennych prze $_POST
			
			// splitowanie $_POST['data_pdf']
			// array(1) { ["data_pdf"]=> string(12) "20:17:single" } --> id_order:id_client:(rodzaj_generowanego_pdf'a)
	
			$data_pdf = explode(':',$_POST['data_pdf']);
			
			$id_order  = $data_pdf[0];
			$id_client = $data_pdf[1];
			$type_document = $data_pdf[2];
			
			if($type_document == "single")
			{
			
				$name_product[] = 0;
				$price_product[] = 0;
				$amount_products[] = 0;
				$id_product[] = 0;
				$ile  = 0;
				$date_order = '';
						
				$sth = $dbh->prepare("SELECT * FROM Products p
									INNER JOIN OrdersProducts AS op
									ON p.id_product = op.id_product
									INNER JOIN Orders AS o 
									ON op.id_order = o.id_order
									INNER JOIN Client AS c 
									ON c.id_client = o.id_client
									WHERE c.id_client = ? AND o.id_order =?");		
				
				$sth->execute(array($id_client,$id_order));
				$results = $sth->fetchAll();
							
				foreach($results as $result) {
								
					$id_product[] = $result['id_product'];
                    $name_product[] = $result['name_product'];
                    $amount_products[] = $result['amount_products'];
					echo $result['amount_products'];
                    $price_product[] = $result['price_brutto'];
					$date_order = $result['date_order'];
					$ile++;
				}
				
	// klassa TCPDF
	require_once('fpdf2/tcpdf.php');
	
	// tworzymy obiekt klasy|| 1 argument to P, albo L
	$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
	// set metadata
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Krzysztof Jerzyński');
    $pdf->SetTitle('Rowerowy sklep Internetowy');
    $pdf->SetSubject('Nie wiem czy się różnyni temat o tytułu');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	// set header and footer fonts
   
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	
	// set default monospaced font
	
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	
    if (@file_exists('fpdf2/examples/lang/pol.php')) {
        require_once('fpdf2/examples/lang/pol.php');
        $pdf->setLanguageArray($l);
    }

	// domyślna ścieżka img - tcpdf/examples/images/
    $PDF_HEADER_LOGO = "kross-presto-2016.jpg";
    $PDF_HEADER_LOGO_WIDTH = "50";
    $PDF_HEADER_TITLE = "BD Projekt Sklep Rowerowy";
    $PDF_HEADER_STRING = "email: testingbaza@gmail.com \nTel. Kom. 492 182 932 \t GG 91238219";

	// ustawienie/ wrzucenie headera.
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

	// set default font subsetting mode
    $pdf->setFontSubsetting(true);

	// set font
    $pdf->SetFont('freeserif', '', 12);

	// add a page
    $pdf->AddPage();


	// set color for text
    $pdf->SetTextColor(0, 0, 0);
	
    $Naglowek = 'Zamówienie nr: ' . $id_order;
    date("Y-m-d   H:i:s") . '</p></div>';

    $data = '<div class="linia"><p class="naglowek_kalkulacja">Historia zamówienia nr '.$id_order.'</p>
			<p class="data">Data wygenerowania dokumentu: ' . date("Y-m-d   H:i:s") . '</p></div>';
    $table = '<table align="left" class="tabelka"> 
		<tr>
			<th>Lp</th>
			<th>ID Product</th>
			<th>Nazwa produktu</th>
			<th>Ilość</th>
			<th>Cena Brutto</th>
		</tr>';
	
	$style = '
			<style>
			
			/*Nagłówek Kalkulacja...*/
			
				.naglowek_kalkulacja{
				
				font-weight: bold;
				font-size: 22px;
			}
			
			/*Tabelka*/
			 
			table, td, th {
				border: 1px solid black; 
			}
			

		  
			table{
				border-collapse: collapse;
				font-size: 10px;
			
			}

		   			
			.linia{
				width: 100%;
				text-align: center;			
			}
			
			

			</style>';
			

				//Pętla od odczytywania wierszy + potrzebuję informacji o ilości dodanych produktów ;-)
				
				$dane = '';
	
				for ($j = 0; $j < $ile; $j++) {

					$lp = $j + 1;


					$dane .=
						'<tr><td>' . $lp . '</td>
						<td>' . $id_product[$lp] . '</td>
						<td>' . $name_product[$lp] . '</td>
						<td>' . $amount_products[$lp] . '</td>
						<td>' . $price_product[$lp] . '</td>
						</tr>';
				}
		
	
				$łaczny_koszt = 0;
				for ($licznik = 0; $licznik < $ile; $licznik ++) {
					$łaczny_koszt += $price_product[$licznik + 1] * $amount_products[$licznik + 1];
				}
				
				$podsumowanie = '<tr><td></td><td></td><td></td><td>SUMA:</td><td>' . $łaczny_koszt . ' zł</td></tr>';


				$sth = $dbh->prepare("SELECT * FROM Client AS c 
				INNER JOIN Addresses AS ad ON
				c.id_adress = ad.id_adress
				INNER JOIN Contact AS co ON
				co.id_contact = c.id_contact
				WHERE id_client = ?");
				
				$sth->execute(array($id_client));
				$results = $sth->fetchAll();
							
				foreach($results as $result) {
    
				$dodatki = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $result['surname'] . '<br />Nazwisko: ' . $result['name'] . '<br />Adres wysyłki: <br />Ulica: ' . $result['street'] . ' ' . $result['number_house'] . '<br />Kod pocztowy: ' . $result['postal_code'] . '<br />Miejscowość: ' . $result['city'] . '<br />Województwo: ' . $result['province'] . '<br />Kraj: ' . $result['country'] . '<br />Data zakupu: '.$date_order.'<br />';
				}
				
				$pdf->writeHTML($style.$data, true, false, true, false, '');
				$pdf->writeHTML($style.$table.$dane.$podsumowanie.'</table>'.$dodatki, true, false, true, false, '');

				$hash = 'WTI_Sklep_zamówienie_' . md5($_SERVER['REMOTE_ADDR']) . '.pdf';

				// pdf
				ob_start();
				$pdf->Output($hash, 'D');
				ob_end_flush();			
				
			}
			
			else if($type_document == "all")
			{
				$name_products[] = 0;
				$price_products[] = 0;
				$amounts_products[] = 0;
				$id_products[] = 0;
				$id_orders[] = 0;
				$ile  = 0;
				$date_orders[] = 0;
				
				$sth = $dbh->prepare("SELECT * FROM Products p
									INNER JOIN OrdersProducts AS op
									ON p.id_product = op.id_product
									INNER JOIN Orders AS o 
									ON op.id_order = o.id_order
									INNER JOIN Client AS c 
									ON c.id_client = o.id_client
									WHERE c.id_client = ?");
									
				$sth->execute(array($id_client));
				$results = $sth->fetchAll();
							
				foreach($results as $result) {
					
					$id_products[] = $result['id_product'];
					$id_orders[] = $result['id_order'];
                    $name_products[] = $result['name_product'];
                    $amounts_products[] = $result['amount_products'];
                    $price_products[] = $result['price_brutto'];
					$date_orders[] = $result['date_order'].' '.$result['time_order'];
					$ile++;
				    
					//echo $date_orders[$ile].' - '.$name_products[$ile].' - '.$id_orders[$ile].'<br />';
				
				}
				
				//echo "Generuję zestawienie zbiorcze wszystkich zamówień klienta o id: ".$id_client.' w okresie: '.$begin_date.' - '.$end_date.'<br />';	
				
					// klassa TCPDF
	require_once('fpdf2/tcpdf.php');
	
	// tworzymy obiekt klasy|| 1 argument to P, albo L
	$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
	// set metadata
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Krzysztof Jerzyński');
    $pdf->SetTitle('Rowerowy sklep Internetowy');
    $pdf->SetSubject('Nie wiem czy się różnyni temat o tytułu');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	// set header and footer fonts
   
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	
	// set default monospaced font
	
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	
    if (@file_exists('fpdf2/examples/lang/pol.php')) {
        require_once('fpdf2/examples/lang/pol.php');
        $pdf->setLanguageArray($l);
    }

	// domyślna ścieżka img - tcpdf/examples/images/
    $PDF_HEADER_LOGO = "kross-presto-2016.jpg";
    $PDF_HEADER_LOGO_WIDTH = "50";
    $PDF_HEADER_TITLE = "BD Projekt Sklep Rowerowy";
    $PDF_HEADER_STRING = "email: testingbaza@gmail.com \nTel. Kom. 492 182 932 \t GG 91238219";

	// ustawienie/ wrzucenie headera.
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

	// set default font subsetting mode
    $pdf->setFontSubsetting(true);

	// set font
    $pdf->SetFont('freeserif', '', 12);

	// add a page
    $pdf->AddPage();


	// set color for text
    $pdf->SetTextColor(0, 0, 0);
	
    $Naglowek = 'Faktura';
    date("Y-m-d   H:i:s") . '</p></div>';

    $data = '<div class="linia"><p class="naglowek_kalkulacja">Historia wszystkich zamówień</p>
			<p class="data">Data wygenerowania dokumentu: ' . date("Y-m-d   H:i:s") . '</p></div>';
    $table = '<table align="left" class="tabelka"> 
		<tr>
			<th>Lp</th>
			<th>ID Product</th>
			<th>ID Order</th>
			<th>Data zamówienia</th>
			<th>Nazwa produktu</th>
			<th>Ilość</th>
			<th>Cena Brutto</th>
		</tr>';
	
	$style = '
			<style>
			
			/*Nagłówek Kalkulacja...*/
			
				.naglowek_kalkulacja{
				
				font-weight: bold;
				font-size: 22px;
			}
			
			/*Tabelka*/
			 
			table, td, th {
				border: 1px solid black; 
			}
			

		  
			table{
				border-collapse: collapse;
				font-size: 10px;
			
			}

		   			
			.linia{
				width: 100%;
				text-align: center;			
			}
			
			

			</style>';
			

				//Pętla od odczytywania wierszy + potrzebuję informacji o ilości dodanych produktów ;-)
				
				$dane = '';
	
				for ($j = 0; $j < $ile; $j++) {

					$lp = $j + 1;


					$dane .=
						'<tr><td>' . $lp . '</td>
						<td>' . $id_products[$lp] . '</td>
						<td>' . $id_orders[$lp] . '</td>
						<td>' . $date_orders[$lp] . '</td>
						<td>' . $name_products[$lp] . '</td>
						<td>' . $amounts_products[$lp] . '</td>
						<td>' . $price_products[$lp] . '</td>
						</tr>';
				}
		
	
				$łaczny_koszt = 0;
				for ($licznik = 0; $licznik < $ile; $licznik ++) {
					$łaczny_koszt += $price_products[$licznik + 1] * $amounts_products[$licznik + 1];
				}
				
				$podsumowanie = '<tr><td></td><td></td><td></td><td></td><td></td><td>SUMA:</td><td>' . $łaczny_koszt . ' zł</td></tr>';


				$sth = $dbh->prepare("SELECT * FROM Client AS c 
				INNER JOIN Addresses AS ad ON
				c.id_adress = ad.id_adress
				INNER JOIN Contact AS co ON
				co.id_contact = c.id_contact
				WHERE id_client = ?");
				
				$sth->execute(array($id_client));
				$results = $sth->fetchAll();
							
				foreach($results as $result) {
    
				$dodatki = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $result['surname'] . '<br />Nazwisko: ' . $result['name'] . '<br />Adres wysyłki: <br />Ulica: ' . $result['street'] . ' ' . $result['number_house'] . '<br />Kod pocztowy: ' . $result['postal_code'] . '<br />Miejscowość: ' . $result['city'] . '<br />Województwo: ' . $result['province'] . '<br />Kraj: ' . $result['country'] . '<br />';
				}
				
				$pdf->writeHTML($style.$data, true, false, true, false, '');
				$pdf->writeHTML($style.$table.$dane.$podsumowanie.'</table>'.$dodatki, true, false, true, false, '');

				$hash = 'WTI_Sklep_zamówienie_' . md5($_SERVER['REMOTE_ADDR']) . '.pdf';

				// pdf
				ob_start();
				$pdf->Output($hash, 'D');
				ob_end_flush();	
				
			}
			
			else if($type_document == "datepicker" && isset($_POST['begin_date']) && isset($_POST['end_date']))
			{				
				$begin_date = $_POST['begin_date'];
				$end_date   = $_POST['end_date'];
		
				$name_products[] = 0;
				$price_products[] = 0;
				$amounts_products[] = 0;
				$id_products[] = 0;
				$id_orders[] = 0;
				$ile  = 0;
				$date_orders[] = 0;
				
				$sth = $dbh->prepare("SELECT * FROM Products p
									INNER JOIN OrdersProducts AS op
									ON p.id_product = op.id_product
									INNER JOIN Orders AS o 
									ON op.id_order = o.id_order
									INNER JOIN Client AS c 
									ON c.id_client = o.id_client
									WHERE c.id_client = ? AND
									date_order >= ? AND date_order <= ?
									ORDER BY o.id_order");
									
				$sth->execute(array($id_client,$begin_date,$end_date));
				$results = $sth->fetchAll();
							
				foreach($results as $result) {
					
					$id_products[] = $result['id_product'];
					$id_orders[] = $result['id_order'];
                    $name_products[] = $result['name_product'];
                    $amounts_products[] = $result['amount_products'];
                    $price_products[] = $result['price_brutto'];
					$date_orders[] = $result['date_order'].' '.$result['time_order'];
					$ile++;
				    
					//echo $date_orders[$ile].' - '.$name_products[$ile].' - '.$id_orders[$ile].'<br />';
				
				}
				
				//echo "Generuję zestawienie zbiorcze wszystkich zamówień klienta o id: ".$id_client.' w okresie: '.$begin_date.' - '.$end_date.'<br />';	
				
					// klassa TCPDF
	require_once('fpdf2/tcpdf.php');
	
	// tworzymy obiekt klasy|| 1 argument to P, albo L
	$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
	// set metadata
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Krzysztof Jerzyński');
    $pdf->SetTitle('Rowerowy sklep Internetowy');
    $pdf->SetSubject('Nie wiem czy się różnyni temat o tytułu');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	// set header and footer fonts
   
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	
	// set default monospaced font
	
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	
    if (@file_exists('fpdf2/examples/lang/pol.php')) {
        require_once('fpdf2/examples/lang/pol.php');
        $pdf->setLanguageArray($l);
    }

	// domyślna ścieżka img - tcpdf/examples/images/
    $PDF_HEADER_LOGO = "kross-presto-2016.jpg";
    $PDF_HEADER_LOGO_WIDTH = "50";
    $PDF_HEADER_TITLE = "BD Projekt Sklep Rowerowy";
    $PDF_HEADER_STRING = "email: testingbaza@gmail.com \nTel. Kom. 492 182 932 \t GG 91238219";

	// ustawienie/ wrzucenie headera.
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

	// set default font subsetting mode
    $pdf->setFontSubsetting(true);

	// set font
    $pdf->SetFont('freeserif', '', 12);

	// add a page
    $pdf->AddPage();


	// set color for text
    $pdf->SetTextColor(0, 0, 0);
	
    $Naglowek = 'Faktura';
    date("Y-m-d   H:i:s") . '</p></div>';

    $data = '<div class="linia"><p class="naglowek_kalkulacja">Historia zamówień w okresie: '.$begin_date.'-'.$end_date.'</p>
			<p class="data">Data wygenerowania dokumentu: ' . date("Y-m-d   H:i:s") . '</p></div>';
    $table = '<table align="left" class="tabelka"> 
		<tr>
			<th>Lp</th>
			<th>ID Product</th>
			<th>ID Order</th>
			<th>Data zamówienia</th>
			<th>Nazwa produktu</th>
			<th>Ilość</th>
			<th>Cena Brutto</th>
		</tr>';
	
	$style = '
			<style>
			
			/*Nagłówek Kalkulacja...*/
			
				.naglowek_kalkulacja{
				
				font-weight: bold;
				font-size: 22px;
			}
			
			/*Tabelka*/
			 
			table, td, th {
				border: 1px solid black; 
			}
			

		  
			table{
				border-collapse: collapse;
				font-size: 10px;
			
			}

		   			
			.linia{
				width: 100%;
				text-align: center;			
			}
			
			

			</style>';
			

				//Pętla od odczytywania wierszy + potrzebuję informacji o ilości dodanych produktów ;-)
				
				$dane = '';
	
				for ($j = 0; $j < $ile; $j++) {

					$lp = $j + 1;


					$dane .=
						'<tr><td>' . $lp . '</td>
						<td>' . $id_products[$lp] . '</td>
						<td>' . $id_orders[$lp] . '</td>
						<td>' . $date_orders[$lp] . '</td>
						<td>' . $name_products[$lp] . '</td>
						<td>' . $amounts_products[$lp] . '</td>
						<td>' . $price_products[$lp] . '</td>
						</tr>';
				}
		
	
				$łaczny_koszt = 0;
				for ($licznik = 0; $licznik < $ile; $licznik ++) {
					$łaczny_koszt += $price_products[$licznik + 1] * $amounts_products[$licznik + 1];
				}
				
				$podsumowanie = '<tr><td></td><td></td><td></td><td></td><td></td><td>SUMA:</td><td>' . $łaczny_koszt . ' zł</td></tr>';


				$sth = $dbh->prepare("SELECT * FROM Client AS c 
				INNER JOIN Addresses AS ad ON
				c.id_adress = ad.id_adress
				INNER JOIN Contact AS co ON
				co.id_contact = c.id_contact
				WHERE id_client = ?");
				
				$sth->execute(array($id_client));
				$results = $sth->fetchAll();
							
				foreach($results as $result) {
    
				$dodatki = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $result['surname'] . '<br />Nazwisko: ' . $result['name'] . '<br />Adres wysyłki: <br />Ulica: ' . $result['street'] . ' ' . $result['number_house'] . '<br />Kod pocztowy: ' . $result['postal_code'] . '<br />Miejscowość: ' . $result['city'] . '<br />Województwo: ' . $result['province'] . '<br />Kraj: ' . $result['country'] . '<br />';
				}
				
				$pdf->writeHTML($style.$data, true, false, true, false, '');
				$pdf->writeHTML($style.$table.$dane.$podsumowanie.'</table>'.$dodatki, true, false, true, false, '');

				$hash = 'WTI_Sklep_zamówienie_' . md5($_SERVER['REMOTE_ADDR']) . '.pdf';

				// pdf
				ob_start();
				$pdf->Output($hash, 'D');
				ob_end_flush();	
				
				
				
			}
			
			else "Błąd ogólny";
	}
	
	else "Nie jesteś zalogowany";
?>