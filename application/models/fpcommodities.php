<?php
class Fpcommodities extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('fp_name', 'varchar', 100);
				$this->hasColumn('description', 'varchar', 100);
				$this->hasColumn('unit', 'varchar', 50);
				
	}
	
	public function setUp() {
		$this->setTableName('fpcommodities');
	
	}

	public static function getAllfpcommodities()
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Fpcommodities")->OrderBy("fp_name asc");
		$result = $query -> execute();
		return $result;
	}
}
