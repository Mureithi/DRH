<?php
class Fpcommodities extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('fp_name', 'varchar', 100);
				$this->hasColumn('description', 'varchar', 100);
				$this->hasColumn('unit', 'varchar', 50);
				$this->hasColumn('projected_monthly_c', 'integer', 12);
				$this->hasColumn('projected_psi', 'integer', 12);
				$this->hasColumn('as_of', 'date');
				
				
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
	
	public static function getAll_edit($fpid)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Fpcommodities")-> where("id=$fpid");
		$result = $query -> execute();
		return $result;
	} 
}
