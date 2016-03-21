<?php

session_start();

include '../db.php';

if (isset($_SESSION['user'])) {

	var_dump($_POST);

	$id_client = 0;
	$id_contact = 0;
	$id_adress = 0;
	
	
	$sth = $dbh->prepare("SELECT * FROM Client AS cl
						INNER JOIN Contact AS con ON
						con.id_contact = cl.id_contact
						INNER JOIN Addresses AS ad ON
						ad.id_adress = cl.id_adress
						WHERE cl.user_login = ?");
						
	$sth->execute(array($_SESSION['user']));
	$results = $sth->fetchAll();
							
	foreach($results as $result) {
	
		$id_client = $result['id_client'];
		$id_contact = $result['id_contact'];
		$id_adress = $result['id_adress'];		
    }


    if (isset($_POST['surname'])) {
		
		$statement1 = $dbh->prepare("UPDATE Client SET surname = ? WHERE id_client = ?");
		if($statement1->execute(array($_POST['surname'],$id_client)));
		else
		{
			echo "Error: UPDATE Client SET surname...";
		}	
    }
    if (isset($_POST['name'])) {
		
		$statement1 = $dbh->prepare("UPDATE Client SET name = ? WHERE id_client = ?");
		if($statement1->execute(array($_POST['name'],$id_client)));
		else
		{
			echo "Error: UPDATE Client SET name...";
		}	
    }

    if (isset($_POST['email'])) {
		
		$statement1 = $dbh->prepare("UPDATE Contact SET email = ? WHERE id_contact = ?");
		if($statement1->execute(array($_POST['email'],$id_contact)));
		else
		{
			echo "Error: UPDATE Contact SET email...";
		}	
    }

    if (isset($_POST['street'])) {
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET street = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['street'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET street...";
		}	
    }


    if (isset($_POST['number_house'])) {
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET number_house = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['number_house'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET number_house...";
		}	
    }

    if (isset($_POST['number_local'])) {
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET number_local = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['number_local'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET number_local...";
		}
    }

    if (isset($_POST['city'])) {
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET city = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['city'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET city...";
		}
    }
	
	if (isset($_POST['postal_code'])) {
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET postal_code = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['postal_code'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET postal_code...";
		}
    }
	
	
	if (isset($_POST['country'])) {
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET country = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['country'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET country...";
		}	
    }
	
	
	if (isset($_POST['province'])){
		
		$statement1 = $dbh->prepare("UPDATE Addresses SET province = ? WHERE id_adress = ?");
		if($statement1->execute(array($_POST['province'],$id_adress)));
		else
		{
			echo "Error: UPDATE Addresses SET province...";
		}	
    }
	
	if(isset($_POST['pass']) && isset($_POST['cpass']) && ($_POST['pass'] == $_POST['cpass'])){
		
		if($_POST['pass'] == "") return;
		
		// zamiana hasła na skrót md5 i zapisanie do bazy danych
		
		$pass_md5 = md5($_POST['pass']);
		
		$statement1 = $dbh->prepare("UPDATE Client SET md5_pass = ? WHERE id_client = ?");
		if($statement1->execute(array($pass_md5,$id_client)));
		else
		{
			echo "Error: UPDATE Client SET md5_pass...";
		}	
	}
	
	
	if (isset($_POST['number_telephone'])) {
		
		$statement1 = $dbh->prepare("UPDATE Contact SET number_telephone = ? WHERE id_contact = ?");
		if($statement1->execute(array($_POST['number_telephone'],$id_contact)));
		else
		{
			echo "Error: UPDATE Contact SET number_telephone...";
		}	
    }
	
	if (isset($_POST['fax'])) {
		
		$statement1 = $dbh->prepare("UPDATE Contact SET fax = ? WHERE id_contact = ?");
		if($statement1->execute(array($_POST['fax'],$id_contact)));
		else
		{
			echo "Error: UPDATE Contact SET fax...";
		}	
    }
	
	if (isset($_POST['nip'])) {
		
		$statement1 = $dbh->prepare("UPDATE Client SET nip = ? WHERE id_client = ?");
		if($statement1->execute(array($_POST['nip'],$id_client)));
		else
		{
			echo "Error: UPDATE Client SET nip...";
		}	
    }
	
	
	if (isset($_POST['website'])) {
		
		$statement1 = $dbh->prepare("UPDATE Contact SET site = ? WHERE id_contact = ?");
		if($statement1->execute(array($_POST['website'],$id_contact)));
		else
		{
			echo "Error: UPDATE Contact SET site...";
		}
    }
	
}

echo "<script>setTimeout('window.history.back()', 10);</script>";

?>