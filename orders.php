<?php

session_start();

include('../db.php');
require 'phpmailer/PHPMailerAutoload.php';

if (isset($_SESSION['user']) && isset($_POST['id_client']) && isset($_POST['id_order']) && isset($_POST['id_product']) && isset($_POST['amount_product'])) 
{

    $name_product[] = 0;
    $price_product[] = 0;
    $id_order = $_POST['id_order'];
    $id_client = $_POST['id_client'];

	$sth = $dbh->prepare("SELECT * FROM Products AS p 
							INNER JOIN OrdersProducts AS op
							ON p.id_product=op.id_product
							INNER JOIN Orders AS o 
							ON o.id_order  = op.id_order
							INNER JOIN Client AS c 
							ON c.id_client = o.id_client
							WHERE c.id_client = ? 
							AND o.id_order = ?");
	$sth->execute(array($id_client, $id_order));
	$results = $sth->fetchAll();

    foreach($results as $result) {

        $name_product[] = $result['name_product'];

        $price_product[] = $result['price_brutto'];
    }

    /*

      array(4) { ["id_client"]=> string(4) "1061" ["id_order"]=> string(2) "16" ["id_product"]=> array(2) { [0]=> string(2) "21" [1]=> string(2) "16" } ["amount_product"]=> array(2) { [0]=> string(1) "4" [1]=> string(1) "5" } }


     */


//var_dump($_POST);
// klassa TCPDF
    require_once('fpdf2/tcpdf.php');

// tworzymy obiekt klasy|| 1 argument to P, albo L
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Ustawiasz metadane
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('BD Projekt');
    $pdf->SetTitle('Sklep Internetowy');
    $pdf->SetSubject('Nie wiem czy się różnyni temat o tytułu');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//$pdf->SetFooterData();
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

//domyślna ścieżka imgów jest - tcpdf/examples/images/
    $PDF_HEADER_LOGO = "kross-presto-2016.jpg";
    $PDF_HEADER_LOGO_WIDTH = "50";
    $PDF_HEADER_TITLE = "BD Projekt Sklep Rowerowy";
    $PDF_HEADER_STRING = "email: testingbaza@gmail.com \nTel. Kom. 492 182 932 \t GG 91238219";

//ustawienie/ wrzucenie headera.
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set default font subsetting mode
    $pdf->setFontSubsetting(true);

// set font
    $pdf->SetFont('freeserif', '', 12);

// add a page
    $pdf->AddPage();


// set color for text
    $pdf->SetTextColor(0, 0, 0);


// ta data działała w poprzednik skrypcie
    $Naglowek = 'Zamówienie nr: ' . $_POST['id_order'];
    date("Y-m-d   H:i:s") . '</p></div>';

    $data = '<div class="linia"><p class="naglowek_kalkulacja">Kalkulacja zamówienia klienta</p>
<p class="data">' . date("Y-m-d   H:i:s") . '</p></div>';
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

    $ile = count($_POST["id_product"]);
    //Pętla od odczytywania wierszy + potrzebuję informacji o ilości dodanych produktów ;-)
    $dane = '';
    for ($j = 0; $j < $ile; $j++) {

        $lp = $j + 1;


        $dane .=
                '<tr><td>' . $lp . '</td>
                <td>' . $_POST["id_product"][$j] . '</td>
                <td>' . $name_product[$lp] . '</td>
				<td>' . $_POST['amount_product'][$j] . '</td>
                <td>' . $price_product[$lp] . '</td>
				
               </tr>';
    }

    $łaczny_koszt = 0;
    for ($licznik = 0; $licznik < count($_POST["id_product"]); $licznik ++) {
        $łaczny_koszt += $price_product[$licznik + 1] * $_POST['amount_product'][$licznik];
    }
    $podsumowanie = '<tr><td></td><td></td><td></td><td>SUMA:</td><td>' . $łaczny_koszt . ' zł</td></tr>';


    for ($licznik = 0; $licznik < count($_POST["id_product"]); $licznik++) {

        $temp_amount = $_POST['amount_product'][$licznik];
        $temp_id_product = $_POST['id_product'][$licznik];
		$temp_product_name = '';
		$all_amount_product = '';
		
		$sth = $dbh->prepare("SELECT * FROM Products
		WHERE id_product = ?");
		$sth->execute(array($temp_id_product));
		$results = $sth->fetchAll();
		
		foreach($results as $result){
			
			$all_amount_product = $result['amount'];
			$temp_product_name = $result['name_product'];
		}
		
		$difference_amount = $all_amount_product - $temp_amount;
		
		if($difference_amount >= 0)
		{
			$statement = $dbh->prepare("UPDATE Products SET amount = ? WHERE id_product = ?");
			if($statement->execute(array($difference_amount, $temp_id_product)));
			else echo "Eror: UPDATE OrdersProducts SET amount ...";
			
			$statement = $dbh->prepare("UPDATE OrdersProducts SET amount_products = ? WHERE id_order = ? AND id_product = ?");
			if($statement->execute(array($temp_amount, $id_order, $temp_id_product)));
			else echo "Eror: UPDATE OrdersProducts SET amount_products ...";
		}
		
		else
		{
			 echo 'Nie ma aż tylu egzemplarzy produktu '.$temp_product_name.' na stanie!';
			 echo '<script>setTimeout(function(){location.href="orders_preview.php", 3000} );</script>';
			 die();
		}

    }

	$sth = $dbh->prepare("SELECT * FROM Client AS c 
		 INNER JOIN Addresses AS ad ON
		 c.id_adress = ad.id_adress
		 INNER JOIN Contact AS co ON
		 co.id_contact = c.id_contact
		 WHERE id_client = ?");
	$sth->execute(array($id_client));
	$results = $sth->fetchAll();

	$name_client = '';
	
	foreach($results as $result){
		$name_client = $result['surname'].' '.$result['name'];
        $dodatki = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $result['surname'] . '<br />Nazwisko: ' . $result['name'] . '<br />Adres wysyłki: <br />Ulica: ' . $result['street'] . ' ' . $result['number_house'] . '<br />Kod pocztowy: ' . $result['postal_code'] . '<br />Miejscowość: ' . $result['city'] . '<br />Województwo: ' . $result['province'] . '<br />Kraj: ' . $result['country'] . '<br />';
    }
    $pdf->writeHTML($style.$data, true, false, true, false, '');
    $pdf->writeHTML($style.$table.$dane.$podsumowanie.'</table>'.$dodatki, true, false, true, false, '');

    $hash = 'WTI_Sklep_zamówienie_nr_' .$id_order.'_'. date("Y-m-d_H-i-s") . '.pdf';
	// pdf
	$filename= $hash.".pdf"; 
    $filelocation = "C:\\xampp2\\htdocs\\sklep\\temp_pdf";//windows
	$fileNL = $filelocation."\\".$filename;//Windows
		 
    ob_start();
    //$pdf->Output($hash, 'D');
	//$pdf->Output("$tmp/file.pdf", "F");
	$pdf->Output($fileNL,'F');
	ob_end_flush();
	
	
	//wysyłanie pdf'a na e-maila
	$mail = new PHPMailer();
	$mail->IsSMTP();
	//$mail->SMTPDebug = 2; 
	$mail->Mailer = 'smtp';
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.wp.pl'; // "ssl://smtp.gmail.com" didn't worked
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';

	$myfile = fopen("..\dane_email.txt", "r") or die("Unable to open file!");
	// Output one line until end-of-file
	$data_email = explode(':',fgets($myfile));
	fclose($myfile);
 
	$mail->Username = $data_email[0];
	$mail->Password = $data_email[1];
 
	$mail->IsHTML(true); // if you are going to send HTML formatted emails
	$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
	$mail->CharSet = "UTF-8";
 
	$mail->From = "wtiprojekt@wp.pl";
	$mail->FromName = $name_client;
	$mail->addAddress("wtiprojekt@wp.pl",$name_client);
	$mail->Subject = "Zamówienie nr ".$id_order;
	foreach($results as $result) {
		$mail->Body = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $result['surname'] . '<br />Nazwisko: ' . $result['name'] . '<br />Adres wysyłki: <br />Ulica: ' . $result['street'] . ' ' . $result['number_house'] . '<br />Kod pocztowy: ' . $result['postal_code'] . '<br />Miejscowość: ' . $result['city'] . '<br />Województwo: ' . $result['province'] . '<br />Kraj: ' . $result['country'] . '<br />';
	}
	$mail->AddAttachment($fileNL, $filename);
 
	if(!$mail->Send())
		echo "Błąd składania zamówienia! <br />PHPMailer Error: " . $mail->ErrorInfo;
	else{
		echo "Dziękujemy za złożenie zamówienia...";
	}
	
	$files = glob('temp_pdf/*'); // get all file names
	foreach($files as $file){ // iterate files
	if(is_file($file))
		unlink($file); // delete file
	}

	// ustawienie jako zrealizowanych !!!!! is_accepted oraz data_order są dodawane jako odróżnienie koszyka od zamówienia

	$statement = $dbh->prepare("UPDATE Orders SET is_accepted = 1 WHERE id_order = ?");
	if($statement->execute(array($id_order)));
	else echo "Eror: UPDATE Orders SET is_accepted ...";

    // Eror: UPDATE Orders SET date_order ...
	
	$actual_time_order = gmdate("H:i:s", time());

	$statement = $dbh->prepare("UPDATE Orders SET date_order = NOW() WHERE id_order = ?");
	if($statement->execute(array($id_order)));
	else echo "Eror: UPDATE Orders SET date_order ...";
	
	$statement = $dbh->prepare("UPDATE Orders SET time_order = ? WHERE id_order = ?");
	if($statement->execute(array($actual_time_order,$id_order)));
	else echo "Eror: UPDATE Orders SET time_order ...";
	 
	// uwtorzenie pustego koszyka

	$statement = $dbh->prepare("INSERT INTO Orders(id_client,is_accepted,is_paid,date_order,date_shipment,is_realized,date_realized_order,time_order) VALUES(?,0,0,'','',0,'','')");
	if($statement->execute(array($id_client)));
	else echo "Eror: INSERT INTO Orders ...";
	
    echo '<script>setTimeout(function(){location.href="orders_preview.php", 1000} );</script>';
}

?>

