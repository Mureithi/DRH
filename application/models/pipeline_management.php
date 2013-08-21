<?php
class Pipeline_management extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('fpcommodity_Id', 'integer', 12);
				$this->hasColumn('funding_source', 'varchar', 100);
				$this->hasColumn('eta_details', 'date');
				$this->hasColumn('pending', 'integer', 12);
				$this->hasColumn('received', 'integer', 12);
				$this->hasColumn('delayed', 'integer', 12);
				$this->hasColumn('date_received', 'date');
				$this->hasColumn('date_delayed_to', 'date');
				
				
				
		
	}
	
	public function setUp() {
		$this->setTableName('pipeline_management');
		
		
		
	}

	public static function getAllinpipeline()
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Pipeline_management");
		$result = $query -> execute();
		return $result;
	}
	
	
}
