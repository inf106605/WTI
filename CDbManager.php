<?php 

global $dbh;
	
class CDbManager 
{
	private $m_oMysqli = null;
	
	public function __construct()
	{
		$m_oMysqli = $dbh;
	}
	
	public function GetTagsForCloud()
	{
		$aTags = array();
		$oResult = $this->$m_oMysqli->query('SELECT * 
											FROM (
											SELECT id_tag, name_tag, COUNT(id_tag) AS TagsCount 
											FROM products_has_tag
											NATURAL JOIN tag
											GROUP BY id_tag
											) AS TagsCountQuery
											ORDER BY TagsCount DESC
											LIMIT 25');
											
		while($oTagItem = $oResult->fetch_object())
		{
			$aTags[] = new CTagCloudItem($oTagItem->TagId,$oTagItem->TagName,$oTagItem->TagsCount);
		}
		
		return ($aTags);
	}
}

?>