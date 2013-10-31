<?php
class Funding_source extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('funding_source', 'varchar', 100);
				$this->hasColumn('procuring_a', 'integer', 2);
				$this->hasColumn('service_active', 'integer', 2);
				$this->hasColumn('date_asof', 'date');
				
				
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
