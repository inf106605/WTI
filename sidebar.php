<div class="col-md-3">

    <div class="list-group kategorie">
        <h3 class="list-group-item" style="background-color: #f5f5f5;">Kategorie</h3>

		 <?php include('../db.php'); ?>
        <?php

	  
		
		try{
		
		$results = $dbh->query("SELECT * FROM Category");
        foreach($results as $result) {
            echo '<form action="search.php" method="POST" >';
            echo '<input name="id_category" type="text" style="display:none;" value="' . $result['id_category'] . '" >';
            echo '<button onclick="form.submit();" class="list-group-item">' . $result['name'] . '</button>';
            echo '</form>';
        }
		
		}
		
		catch(Exception $e)
		{
			echo "Error.".$e;
			exit;
		}
		
        ?>

    </div>
    
    <div class="list-group kontakt" style="line-height: 25px">
        <h3 class="list-group-item" style="background-color: #f5f5f5;">Kontakt</h3>
        <div class="list-group-item">
            <b>BD Projekt Sklep Rowerowy</b><br>
            ul. Piotrowo 3<br>
            60-965 Poznań<br>
            <b>NIP:</b> 2271021334<br>
            <b>email:</b> testingbaza@gmail.com<br>
            <b>telefon:</b> 492 182 932<br>
            <b>GG:</b> 91238219
        </div>
    </div>

</div>