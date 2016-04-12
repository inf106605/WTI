<?php 

class CTagCloudItem
{
	private $m_sTagId = '';
	private $m_sTagName = '';
	private $m_nTagsCount = 0;
	private $m_sTagsClass = 0;
	
	public function __construct($sTagId, $sTagName, $nTagsCount)
	{
		$this->m_sTagId = $sTagId;
		$this->m_sTagName = $sTagName;
		$this->m_nTagsCount = $nTagsCount;
	}
	
	public function __get($sVariableName)
	{
		return($this->$sVariableName);
	}
	
	public function SetTagsClass($sTagsClass)
	{
		$this->m_sTagsClass = $sTagsClass;
	}
}

?>