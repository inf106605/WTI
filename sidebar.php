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
    
	<div class="list-group tagi" style="line-height: 25px">
        <h3 class="list-group-item" style="background-color: #f5f5f5;">Tagi</h3>
        <div class="list-group-item">
           <?php 
		   
				include 'CIndex.php';
				
				$x = new CIndex();

				$getTagsCloudArray = $x->GetTagsCloudsArray();
				
				/*
				$sth = $dbh->prepare("SELECT * 
										FROM (
										SELECT id_tag, name_tag, COUNT(id_tag) AS TagsCount 
										FROM products_has_tag
										NATURAL JOIN tag
										GROUP BY id_tag
										) AS TagsCountQuery
										ORDER BY TagsCount DESC
										LIMIT 25");
				$sth->execute();
				$results = $sth->fetchAll();
				
				*/
				
							
				echo '<form action="tag.php" method="POST"> 
							<div class="form-inline">
							<div class="form-group">';
							
				foreach($getTagsCloudArray as $result) 
				{
						echo '<button id="'.$result->m_sTagsClass.'" name="name_tag" type="submit" class="btn btn-default" value="'.$result->m_sTagName.'">'.$result->m_sTagName.'</button>';
				}
							
				echo '</div>
					</div>
				</form>';
		   ?>
        </div>
    </div>
	
    <div class="list-group kontakt" style="line-height: 25px">
        <h3 class="list-group-item" style="background-color: #f5f5f5;">Kontakt</h3>
        <div class="list-group-item">
            <b>WTI Projekt Sklep Rowerowy</b><br>
            ul. Piotrowo 3<br>
            60-965 Poznań<br>
            <b>NIP:</b> 2271021334<br>
            <b>email:</b> wtiprojekt@wp.pl<br>
            <b>telefon:</b> 492 182 932<br>
            <b>GG:</b> 91238219
        </div>
    </div>

</div>