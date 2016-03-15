<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Logowanie - BD Projekt - Rowerowy sklep internetowy</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/homepage.css" rel="stylesheet">
        
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
                        echo "Jesteś już zalogowany!";
                    } else {

                        echo '<form class="form-horizontal" action="login_database.php" method="post" style="margin-top: 20px;">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Login" name="user"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hasło</label>
                            <div class="col-sm-9"><input type="password" class="form-control" placeholder="Hasło" name="pass"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button id="button" type="submit" name="submit" class="btn btn-default big-button"><b>Zaloguj</b></button>
                            </div>
                        </div>
                        
                        </form>';
                    }
                    ?>

                </div>
            </div>
            <!-- /.container -->

            <?php include 'footer.php'; ?>

    </body>

</html>