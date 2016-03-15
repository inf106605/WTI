<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BD Projekt - Rowerowy sklep internetowy</title>

    </head>

    <body>


	
        <?php
		
		
		 
        function NewUser() {

            
			include 'htdocs/db.php';
			
            $surname = $_POST['surname'];
            $name = $_POST['name'];
            $full_name = $_POST['surname'] . " " . $_POST['name'];
            $userName = $_POST['user'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $potw_password = $_POST['cpass'];
            $street = $_POST['street'];
            $number_house = $_POST['number_house'];
            $number_local = $_POST['number_local'];
            $city = $_POST['city'];
            $postal_code = $_POST['postal_code'];
            $country = $_POST['country'];
            $province = $_POST['province'];
            $number_telephone = $_POST['number_telephone'];
            $fax = $_POST['fax'];
            $nip = $_POST['nip'];
            $website = $_POST['website'];


			try{
			
			$statement = $dbh->prepare("INSERT INTO Addresses (city,province,country,postal_code,street,number_house,number_local) VALUES (?,?,?,?,?,?,?)");
			if($statement->execute(array($city, $province, $country, $postal_code, $street, $number_house, $number_local)));
			else echo "Eror: INSERT INTO Addresses ...";
					
          
            $last_id_adres = $dbh->lastInsertId();
			
			

            //echo "1 record Addresses added";

            $statement = $dbh->prepare("INSERT INTO Contact (number_telephone,fax,email,site) VALUES (?,?,?,?)");
			if($statement->execute(array($number_telephone, $fax, $email, $website)));
			else echo "Eror: INSERT INTO Contact ...";

            //echo "1 record Contact added";
            $last_id_contact = $dbh->lastInsertId();
			

			$statement1 = $dbh->prepare("INSERT INTO Client (id_adress,id_contact,user_login,md5_pass,name,nip,client_type,data_rejestracji,privileges,surname) VALUES (?,?,?,?,?,?,?,?,?,?)");
			if($statement1->execute(array($last_id_adres,$last_id_contact,$userName,$password,$name,$nip,"standard",date("Y-m-d H:i:s"),1,$surname)));
			else
			{
				echo "Eror: INSERT INTO Client ...";
			}				
			
	        //echo "1 record Client added"; 
            // dodawanie pierwszego zamówienia - służy jako koszyk 

			$id_klient = 0;
			$sth = $dbh->prepare("SELECT id_client FROM Client");
			$sth->execute();
			$results = $sth->fetchAll();
						                           

            foreach($results as $result) { 
			
                $id_klient = $result['id_client'];
            }


			
			$statement = $dbh->prepare("INSERT INTO Orders(id_client,is_accepted,is_paid,date_order,date_shipment,is_realized,date_realized_order)
						VALUES(?,?,?,?,?,?,?)");
			if($statement->execute(array($id_klient,0,0,date("Y-m-d H:i:s"),NULL,0,NULL)));
			else 
			{
				print_r($statement->errorInfo());
				echo "Eror: INSERT INTO Orders ...";
			}

			
		}
		catch(Exception $e)
		{
			echo "Error: ".$e;
		}
			
        }

        function SignUp() {

  
			include 'htdocs/db.php';
  
            if (!empty($_POST['user'])) {   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
      
			$sth = $dbh->prepare("SELECT * FROM Client WHERE user_login = ?");
			$sth->execute(array($_POST['user']));
			$results = $sth->fetchAll();
				

                if (!$results) {
                    NewUser();
                    echo "Zostałeś pomyślnie zarejestrowany!<br />";
                    echo '<a href="/sklep/index.php">Powrót do wpisu.</a>';
                    echo '<script>setTimeout("window.location.href=\"index.php\";", 2000);</script>';
                } else {
                    echo "<p style=\"color:red\">Przepraszamy, ale użytkownik o podanych loginie już istnieje!</p>";
                    echo '<a href="javascript: history.go(-1)">Powrót do wpisu.</a>';
                    echo "<script>setTimeout('window.history.back()', 2000);</script>";
                }
            } else {
                echo "Proszę wprowadzić login!";
                echo "<script>setTimeout('window.history.back()', 2000);</script>";
            }
        }

        if (isset($_POST['submit'])) {
            if ((isset($_POST['cpass'])) && (isset($_POST['pass']))) {
                if (($_POST['cpass']) != ($_POST['pass'])) {
                    echo "Hasła nie są zgodne!";
                    echo '<a href="javascript: history.go(-1)">Powrót do formularza</a>';
                    echo "<script>setTimeout('window.history.back()', 2000);</script>";
                } else {

                    SignUp();
                }
            }
        }
        ?>

    </body>
</html>