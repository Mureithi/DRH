<?php
class Funding_source extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('funding_source', 'varchar', 100);
				
				
	}
	
	public function setUp() {
		$this->setTableName('funding_sources');
	
	}

	public static function getAllfpfundingsources()
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Funding_source")->OrderBy("funding_source asc");
		$result = $query -> execute();
		return $result;
	}
}
