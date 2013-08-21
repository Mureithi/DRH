<?php
class Fp_Stocks extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('fpcommodity_id', 'integer', 12);
				$this->hasColumn('soh_Kemsa', 'integer', 12);
				$this->hasColumn('soh_Psi', 'integer', 12);
				$this->hasColumn('pending_Kemsa', 'integer', 12);
				$this->hasColumn('pending_Psi', 'integer', 12);
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
