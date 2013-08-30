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
	
	public static function get_supplyplan(){
     
$supplyplan = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT * FROM (SELECT DISTINCT fpcommodities.fp_name,pipeline_management.id as tr_id,fpcommodities.Unit, funding_sources.`funding_source` ,  `eta_details` ,  `pending` , 
		CASE WHEN MONTH( eta_details ) >=7 THEN CONCAT( YEAR( eta_details ) ,  '-', YEAR( eta_details ) +1 ) ELSE CONCAT( YEAR( eta_details ) -1,  '-', YEAR( eta_details ) ) END AS financial_year 
		FROM pipeline_management, fpcommodities, funding_sources WHERE fpcommodities.id = pipeline_management.`fpcommodity_Id` AND funding_sources.id = pipeline_management.`funding_source`) AS temp 
		WHERE financial_year =  '2013-2014'  ");

        return $supplyplan ;} 
}
