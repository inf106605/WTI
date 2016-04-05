﻿<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BD Projekt - Rowerowy sklep internetowy</title>
        
    </head>

    <body>

        <?php
		
		
		
        checkClient();

        function checkClient() {

		include('../db.php');
		

            session_start(); //rozpoczęcie sesji
            $login = $_POST['user']; //odczytuje login z formularza
            $pass = $_POST['pass'];

			// szukanie użytkownika , czy istnieje 


            if ((isset($_POST['user'])) && (isset($_POST['pass']))) {

				$md5_pass = md5($_POST['pass']);
						
			    $sth = $dbh->prepare("SELECT * FROM Client WHERE user_login = ? AND md5_pass = ?");
                $sth->execute(array($login,$md5_pass));
				$results = $sth->fetchAll();
							
                foreach($results as $result) {

                if (($login == $result['user_login']) && ($md5_pass == $result['md5_pass'])) {
	
						$statement1 = $dbh->prepare("UPDATE Client SET date_last_logged = NOW() WHERE user_login = ?");
						if($statement1->execute(array($login)));
						else
						{
							echo "Error: UPDATE Client SET date_last_logged...";
						}
										
						$_SESSION['user'] = $login;
						echo 'Zostałeś pomyślnie zalogowany.';
						echo '<script>setTimeout("window.location.href=\"index.php\";", 2000);</script>';
						return;
					}
                    
				}
					
                echo 'Podano nieprawidłowe dane! Spróbuj jeszcze raz!';
                echo "<script>setTimeout('window.history.back()', 2000);</script>";
                return;
			}
            
			else if (!isset($_POST['user'])) {
                echo 'Podaj login!';
            } else if (!isset($_POST['pass'])) {
                echo 'Podaj hasło!';
            }
        }
        ?>

    </body>

</html>