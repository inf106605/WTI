<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zamówienia - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/orders_preview.css" rel="stylesheet">

    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">


                    <?php
//		session_start();

                    if (isset($_SESSION['user']) && isset($_POST['id_orders'])) {



                        $serverName = 'SZERYF-KOMPUTER';

                        $connectionInfo = array('Database' => 'sklep_baza', 'CharacterSet' => 'UTF-8');

                        $conn = sqlsrv_connect($serverName, $connectionInfo);

                        $id_product[] = 0;
                        $name_product[] = 0;
                        $price_product[] = 0;
                        $amount_products[] = 0;

                        $id_order = $_POST['id_orders'];
                        $nazwa_uzytkownika = $_SESSION['user'];

                        $sql = "SELECT * FROM Products AS p 
							INNER JOIN OrdersProducts AS op
							ON p.id_product=op.id_product
							INNER JOIN Orders AS o 
							ON o.id_order  = op.id_order
							INNER JOIN Client AS c 
							ON c.id_client = o.id_client
							WHERE c.user_login = ? 
							AND o.id_order = ?";



                        $params = array($nazwa_uzytkownika, $id_order);
                        $stmt = sqlsrv_query($conn, $sql, $params);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

                            $id_product[] = $row['id_product'];
                            $name_product[] = $row['name'];
                            $amount_products[] = $row['amount_products'];
                            $price_product[] = $row['price_brutto'];
                        }

                        /*
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


                          // ---------------------------------------------------------
                          // ważne w chuj.. domyślna ścieżka imgów jest - tcpdf/examples/images/
                          $PDF_HEADER_LOGO = "kross-presto-2016.jpg";
                          $PDF_HEADER_LOGO_WIDTH = "50";
                          $PDF_HEADER_TITLE = "BD Projekt Sklep Rowerowy";
                          $PDF_HEADER_STRING = "email: testingbaza@gmail.com \n
                          Tel. Kom. 492 182 932 \t GG 91238219";

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

                          //Write($h, $txt, $link='', $fill=0, $align='', $ln=false, $stretch=0, $firstline=false, $firstblock=false, $maxh=0)



                          // ta data działała w poprzednik skrypcie
                          $Naglowek= 'Zamówienie ';
                          date("Y-m-d   H:i:s").'</p></div>';

                          $data =
                          '<div class="linia"><p class="naglowek_kalkulacja">Kalkulacja zamówienia klienta</p>
                          <p class="data">'.date("Y-m-d   H:i:s").'</p></div>';
                          $table ='<table align="left" class="tabelka">
                          <tr>
                          <th>Lp</th>
                          <th>ID Product</th>
                          <th>Nazwa produktu</th>
                          <th>Ilość</th>
                          <th>Cena Brutto</th>
                          </tr>';

                          $style = '
                          <style>


                          .naglowek_kalkulacja{

                          font-weight: bold;
                          font-size: 22px;
                          }



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


                         */

                        //Pętla od odczytywania wierszy + potrzebuję informacji o ilości dodanych produktów ;-)

                        $ile = count($id_product);

                        echo '<div class="col-sm-12"><h1>Zamówienie nr: ' . $id_order . '</h1></div>
                        <div class="col-sm-12">
                        <table class="table">
                            <thead>
                              <tr>
                                <th>ID Produktu</th>
                                <th>Nazwa Produktu</th>
                                <th>Ilość</th>
                                <th>Cena</th>
                              </tr>
                            </thead>
                            <tbody>';
                                
                            for ($j = 1; $j < $ile; $j++) {
                                echo '<tr><td>' . $id_product[$j] . '</td>';
                                echo '<td>' . $name_product[$j] . '</td>';
                                echo '<td>' . $amount_products[$j] . '</td>';
                                echo '<td>' . $price_product[$j] . ' zł</td></tr>';

                                $lp = $j;
                            }

                            echo '
                                
                            </tbody>
                        </table> 
                            ';
                        /* 			
                          $dane .=
                          '<tr><td>'.$lp.'</td>
                          <td>'.$id_product[$j].'</td>
                          <td>'.$name_product[$j].'</td>
                          <td>'.$amount_products[$j].'</td>
                          <td>'.$price_product[$j].'</td>

                          </tr>';

                         */



                        $laczny_koszt = 0;
                        for ($j = 1; $j < $ile; $j++) {
                            $laczny_koszt += $price_product[$j] * $amount_products[$j];
                        }

                        echo '<b>Łączny koszt: ' . $laczny_koszt . ' zł</b><br><br>
                              <a href="orders_preview.php" class="btn btn-default big-button">Powrót</a>
                              </div>';

                        /*

                          $podsumowanie = '<tr><td></td><td></td><td></td><td>SUMA:</td><td>'.$laczny_koszt.' zł</td></tr>';


                         */

                        $sql5 = "SELECT * FROM Client AS c 
		 INNER JOIN Addresses AS ad ON
		 c.id_adress = ad.id_adress
		 INNER JOIN Contact AS co ON
		 co.id_contact = c.id_contact
		 WHERE c.user_login = ?";



                        $params5 = array($nazwa_uzytkownika);
                        $stmt5 = sqlsrv_query($conn, $sql5, $params5);
                        if ($stmt5 === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        while ($row = sqlsrv_fetch_array($stmt5, SQLSRV_FETCH_ASSOC)) {

                            $dodatki = '<br /><br /><br />Dane klienta do faktury:<br /><br />Imie: ' . $row['surname'] . '<br />Nazwisko: ' . $row['name_client'] . '<br />Adres wysyłki: <br />Ulica: ' . $row['street'] . ' ' . $row['number_house'] . '<br />Kod pocztowy: ' . $row['postal_code'] . '<br />Miejscowość: ' . $row['city'] . '<br />Województwo: ' . $row['province'] . '<br />Kraj: ' . $row['country'] . '<br />';
                        }



                        /*

                          $pdf->writeHTML($style.$data, true, false, true, false, '');
                          $pdf->writeHTML($style.$table.$dane.$podsumowanie.'</table>'.$dodatki, true, false, true, false, '');




                          $hash = 'Sklep_zamówienie_'.date("Y-m-d   H:i:s").'.pdf';
                          // pdf
                          $pdf->Output($hash, 'D');


                         */
                    }
                    ?>

                </div>
            </div>
            <!-- /.container -->

            <?php include 'footer.php'; ?>

    </body>

</html>