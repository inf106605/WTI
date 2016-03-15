<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Rejestracja - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
<!--        <link href="css/register.css" rel="stylesheet">-->

    </head>

    <body>
        
        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

                <div class="col-md-9">
                    <form class="form-horizontal" method="POST" action="register_base.php" style="margin-top: 20px;">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Imię</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Imię" name="surname"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nazwisko</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Nazwisko" name="name"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-9"><input type="email" class="form-control" placeholder="E-mail" name="email"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Login" name="user"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hasło</label>
                            <div class="col-sm-9"><input onchange="sprawdzHasla();" type="password" id="haslo" class="form-control" placeholder="Hasło" name="pass"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Potwierdź hasło</label>
                            <div class="col-sm-9"><input onchange="sprawdzHasla();" id="haslo_potw" type="password" class="form-control" placeholder="Potwierdź hasło" name="cpass"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ulica</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Ulica" name="street"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numer lokalu</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="Numer lokalu" name="number_house"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numer mieszkania</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="Numer mieszkania" name="number_local"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Miasto</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Miasto" name="city"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kod pocztowy</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Kod pocztowy" name="postal_code"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kraj</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Kraj" name="country"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Województwo</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Województwo" name="province"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Numer telefonu</label>
                            <div class="col-sm-9"><input type="tel" class="form-control" placeholder="Numer telefonu" name="number_telephone"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Fax</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="Fax" name="fax"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">NIP ( opcjonalnie )</label>
                            <div class="col-sm-9"><input type="number" class="form-control" placeholder="NIP" name="nip"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Strona internetowa</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Strona internetowa" name="website"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button id="button" type="submit" name="submit" class="btn btn-default big-button"><b>Załóż konto</b></button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>

</html>
