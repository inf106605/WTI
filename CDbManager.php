<?php 

include 'CTagCloudItem.php';

class CDbManager 
{

	public function __construct()
	{

	}
	
	public function GetTagsForCloud()
	{
		global $dbh;
		$aTags = array();
		$oResult = $dbh->query('SELECT * 
											FROM (
											SELECT id_tag, name_tag, COUNT(id_tag) AS TagsCount 
											FROM products_has_tag
											NATURAL JOIN tag
											GROUP BY id_tag
											) AS TagsCountQuery
											ORDER BY TagsCount DESC
											LIMIT 25');
																		
		foreach($oResult as $result)
		{
			$oTagItem = $result;
			$aTags[] = new CTagCloudItem($result['id_tag'],$result['name_tag'],$result['TagsCount']);
		}
		
		return ($aTags);
	}
}

?>