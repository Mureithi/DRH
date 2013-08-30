<?php
class Fp_Stocks extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('fpcommodity_id', 'integer', 12);
				$this->hasColumn('soh_storeqty', 'integer', 12);
				$this->hasColumn('soh_storeName', 'varchar', 12);
				$this->hasColumn('date', 'date');
				
	}	
	
	public function setUp() {
		$this->setTableName('fp_stocks');
	
	}

	public static function getAllfpstocks()
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Fp_Stocks");
		$result = $query -> execute();
		return $result;
	}
}
