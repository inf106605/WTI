<!-- Navigation -->
<?php
session_start();
?>
<?php include 'htdocs/db.php'; ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">BD Projekt</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left" method="POST" action="search.php">
                <div class="form-group">
                    <input type="text" class="form-control" name="pole_szukaj" placeholder="Szukaj">
                </div>
                <button type="submit" class="btn btn-default">Szukaj</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
				<?php
				
					if(isset($_SESSION['user']))
					{
						echo '<li><a href="orders_preview.php">Zamówienia</a></li>';
					}
				
				?>
				<?php
				
					if(isset($_SESSION['user']))
					{
						echo '<li><a href="edition_user.php">Edycja danych</a></li>';
					}
				
				?>
                <li><a href="cart.php">Koszyk</a></li>
                
				<?php 
					if(isset($_SESSION['user']))
					{
						echo '<li><a href="index.php">Witaj '.$_SESSION['user'].'</a></li>';
					}
					else echo '<li><a href="login.php">Zaloguj</a></li>';
				
				?>
				<?php 
				
				if(isset($_SESSION['user']))
				{
					echo '<li><a href="logout.php">Wyloguj</a></li>';
				}
				
				?>
				<?php
				if(!(isset($_SESSION['user'])))
					echo '<li><a href="register.php">Zarejestruj</a></li>';
				?>
            </ul>
        </div><!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</nav>