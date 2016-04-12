<?php

include 'CDbManager.php';

class CIndex
{
	private $m_oDb = null;
	
	public function __construct()
	{
		$this->m_oDb = new CDbManager();
	}
	
	public function __destruct()
	{
		$this->m_oDb = null;
	}
	
	public function GetTagsCloudsArray()
	{
		$oTagsCloud = $this->m_oDb->GetTagsForCloud();
		if(sizeof($oTagsCloud) == 0)
		{
			return;
		}
		$nMaxValue = $oTagsCloud[0]->m_nTagsCount;
		$nMinValue = $oTagsCloud[sizeof($oTagsCloud) - 1]->m_nTagsCount;
		$nMaxDiffrenceValue = $nMaxValue - $nMinValue;
		foreach($oTagsCloud as $oItem)
		{
			$nItemRange = (($oItem->m_nTagsCount - $nMinValue) * 100) / $nMaxDiffrenceValue;
			
			if($nItemRange > 90)
			{
				$oItem->SetTagsClass('tag9');
			}
			else if($nItemRange > 80)
			{
				$oItem->SetTagsClass('tag8');
			}
			else if($nItemRange > 70)
			{
				$oItem->SetTagsClass('tag7');
			}
			else if($nItemRange > 60)
			{
				$oItem->SetTagsClass('tag6');
			}
			else if($nItemRange > 50)
			{
				$oItem->SetTagsClass('tag5');
			}
			else if($nItemRange > 40)
			{
				$oItem->SetTagsClass('tag4');
			}
			else if($nItemRange > 30)
			{
				$oItem->SetTagsClass('tag3');
			}
			else if($nItemRange > 20)
			{
				$oItem->SetTagsClass('tag2');
			}
			else if($nItemRange > 10)
			{
				$oItem->SetTagsClass('tag1');
			}
			else 
			{
				$oItem->SetTagsClass('tag0');
			}
		}
		//usort($oTagsCloud, 'CompareTagCloudItem'); // sortuje elementy z wykorzystaniem zdefiniowanej poniżej funkcji
		
		return $oTagsCloud; // zwraca tablice z listą/tablicą tagów
	}
	
	private function CompareTagCloudItem($oItemA, $oItemB)
	{
		return strcasecmp($oItemA->m_sTagName,$oItemB->m_sTagName); // sprawdza czy tagi są do siebie podobne, np. "Hello world!","HELLO WORLD!" po wstawieniu jako argumenty da wyni 0 , czyli stringi sa do siebie podobne
	}
	
}

?>