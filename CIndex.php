<?php

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
		
	}
}

?>