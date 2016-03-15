<?php

session_start();

if (isset($_SESSION['user'])) {


	$id_client = 0;
	$id_contact = 0;
	$id_adress = 0;
	
	
    $sql = "SELECT * FROM Client AS cl
			INNER JOIN Contact AS con ON
			con.id_contact = cl.id_contact
			INNER JOIN Addresses AS ad ON
			ad.id_adress = cl.id_adress
			WHERE cl.user_login = ?;";
    $params = array($_SESSION['user']);
    $stmt = sqlsrv_query($conn, $sql, $params);
    $rows = sqlsrv_has_rows($stmt);
    if ($rows === true) {
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
		
		  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			  
			  $id_client = $row['id_client'];
			  $id_contact = $row['id_contact'];
			  $id_adress = $row['id_adress'];
			  
		  }
		
		
    }


    if (isset($_POST['surname'])) {
        $sql = "UPDATE Client SET surname = ? WHERE id_client = ?;";
        $params = array($_POST['surname'],$id_client);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
    if (isset($_POST['name'])) {
        $sql = "UPDATE Client SET name_client = ? WHERE id_client = ?;";
        $params = array($_POST['name'],$id_client);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt1 === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }

    if (isset($_POST['email'])) {
        $sql = "UPDATE Contact SET email = ? WHERE id_contact = ?;";
        $params = array($_POST['email'],$id_contact);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }

    if (isset($_POST['street'])) {
        $sql = "UPDATE Addresses SET street = ? WHERE id_adress = ?;";
        $params = array($_POST['street'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }


    if (isset($_POST['number_house'])) {
        $sql = "UPDATE Addresses SET number_house = ? WHERE id_adress = ?;";
        $params = array($_POST['number_house'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }

    if (isset($_POST['number_local'])) {
        $sql = "UPDATE Addresses SET number_local = ? WHERE id_adress = ?;";
        $params = array($_POST['number_local'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }

    if (isset($_POST['city'])) {
        $sql = "UPDATE Addresses SET city = ? WHERE id_adress = ?;";
        $params = array($_POST['city'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
	    if (isset($_POST['postal_code'])) {
        $sql = "UPDATE Addresses SET postal_code = ? WHERE id_adress = ?;";
        $params = array($_POST['postal_code'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
	
		    if (isset($_POST['country'])) {
        $sql = "UPDATE Addresses SET country = ? WHERE id_adress = ?;";
        $params = array($_POST['country'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
	
	
			    if (isset($_POST['province'])) {
        $sql = "UPDATE Addresses SET province = ? WHERE id_adress = ?;";
        $params = array($_POST['province'],$id_adress);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
	if(isset($_POST['pass']))
	{
		$sql = "UPDATE Client SET md5_pass = ? WHERE id_client = ?;";
        $params = array($_POST['pass'],$id_client);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
	}
	
	
		if (isset($_POST['number_telephone'])) {
        $sql = "UPDATE Contact SET number_telephone = ? WHERE id_contact = ?;";
        $params = array($_POST['number_telephone'],$id_contact);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
		if (isset($_POST['fax'])) {
        $sql = "UPDATE Contact SET fax = ? WHERE id_contact = ?;";
        $params = array($_POST['fax'],$id_contact);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
		if (isset($_POST['nip'])) {
        $sql = "UPDATE Client SET nip = ? WHERE id_client = ?;";
        $params = array($_POST['nip'],$id_client);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
	
	if (isset($_POST['website'])) {
        $sql = "UPDATE Contact SET site = ? WHERE id_contact = ?;";
        $params = array($_POST['website'],$id_contact);
        $stmt = sqlsrv_query($conn, $sql, $params);
        $rows = sqlsrv_has_rows($stmt);
        if ($rows === true) {
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
	
}

echo "<script>setTimeout('window.history.back()', 10);</script>";

?>