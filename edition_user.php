<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Edycja danych - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/register.css" rel="stylesheet">

    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>		

                <div class="col-md-9">
                    <form class="form-horizontal" method="POST" action="edition_user_func.php">

                        <?php
               

                        if (isset($_SESSION['user'])) { 

                         								
							$sth = $dbh->prepare("SELECT * FROM Client AS cl
								JOIN Addresses AS ad ON 
								cl.id_adress = ad.id_adress
								JOIN Contact AS co ON
								co.id_contact = cl.id_contact
								WHERE user_login = ?");
							$sth->execute(array($_SESSION['user']));
							$results = $sth->fetchAll();
						                           

                             foreach($results as $result) { 

                           



                                        echo '<div class="form-group">
                            <label class="col-sm-3 control-label">Imię</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Imię" name="surname" value="' . $result['surname'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nazwisko</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Nazwisko" name="name" value="' . $result['name'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-9"><input type="email" class="form-control" placeholder="E-mail" name="email" value="' . $result['email'] . '" /></div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hasło</label>
                            <div class="col-sm-9"><input type="password" id="haslo" class="form-control" placeholder="Hasło" name="pass"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Potwierdź hasło</label>
                            <div class="col-sm-9"><input id="haslo_potw" type="password" class="form-control" placeholder="Potwierdź hasło" name="cpass"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ulica</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Ulica" name="street" value="' . $result['street'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numer lokalu</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="Numer lokalu" name="number_house" value="' . $result['number_house'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numer mieszkania</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="Numer mieszkania" name="number_local" value="' . $result['number_local'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Miasto</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Miasto" name="city" value="' . $result['city'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kod pocztowy</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Kod pocztowy" name="postal_code" value="' . $result['postal_code'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kraj</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Kraj" name="country" value="' . $result['country'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Województwo</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Województwo" name="province" value="' . $result['province'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numer telefonu</label>
                            <div class="col-sm-9"><input type="tel" class="form-control" placeholder="Numer telefonu" name="number_telephone" value="' . $result['number_telephone'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Fax</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="Fax" name="fax" value="' . $result['fax'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">NIP ( opcjonalnie )</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="NIP" name="nip" value="' . $result['nip'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Strona internetowa</label>
                            <div class="col-sm-9"><input type="url" class="form-control" placeholder="Strona internetowa" name="website" value="' . $result['site'] . '" /></div>
                        </div>';
                                    }
                                
                            
                            echo' <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button id="button" type="submit" name="submit" class="btn btn-default big-button"><b>Zapisz dane</b></button>
                            </div>
                        </div>';

                            echo '</form>';
                        }
                        ?>

                </div>

            </div>

        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>

</html>
