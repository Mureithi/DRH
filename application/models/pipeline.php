<?php
class Pipeline extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('fpcommodity_Id', 'integer', 12);
				$this->hasColumn('funding_source', 'varchar', 100);
				$this->hasColumn('fp_quantity', 'integer', 12);
				$this->hasColumn('fp_date', 'date');
				$this->hasColumn('transaction_type', 'varchar', 12);
				
				
				
				
		
	}
	
	public function setUp() {
		$this->setTableName('pipeline');
		
		
		
	}

	public static function getAllinpipeline()
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Pipeline");
		$result = $query -> execute();
		return $result;
	}
	
	
	public static function getAll_edit($trid)
	{
		$supplyplan = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT pipeline.id AS tr_id, fp_name, fp_quantity, Unit, funding_sources.funding_source,fp_date, projected_monthly_c
FROM  `pipeline` , fpcommodities, funding_sources WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND funding_sources.id = pipeline.`funding_source` AND pipeline.id =$trid");

        return $supplyplan ;
	} 
	
	
	public static function get_supply_plan(){
     
		$supplyplan = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT * 
FROM ( SELECT DISTINCT fpcommodities.fp_name, pipeline.id AS tr_id, fpcommodities.Unit, funding_sources.`funding_source` ,  `fp_date` ,  `fp_quantity` , 
CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year
FROM pipeline, fpcommodities, funding_sources
WHERE fpcommodities.id = pipeline.`fpcommodity_Id` 
AND funding_sources.id = pipeline.`funding_source`
AND `transaction_type`='PENDINGKEMSA'
) AS temp
WHERE financial_year =  '2013-2014'  ");

        return $supplyplan ;
	} 
	
	public static function supply_plan_filter($f_year,$fpids){
     
		$supplyplan = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT * 
FROM ( SELECT DISTINCT fpcommodities.id as c_id,fpcommodities.fp_name, pipeline.id AS tr_id, fpcommodities.Unit, funding_sources.`funding_source` ,  `fp_date` ,  `fp_quantity` , 
CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year
FROM pipeline, fpcommodities, funding_sources
WHERE fpcommodities.id = pipeline.`fpcommodity_Id` 
AND funding_sources.id = pipeline.`funding_source`
AND `transaction_type`='PENDINGKEMSA'
) AS temp
WHERE financial_year =  '$f_year' 
AND c_id= $fpids");

        return $supplyplan ;
        } 
        
        public static function kemsa_psi(){
     
		$supplyplan = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT fpcommodity_Id, fp_name, Unit, SUM( fp_quantity ) AS fp_quantity, SUM( sohkemsa ) AS sohkemsa, projected_monthly_c, financial_year
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` ,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohkemsa,  `fpcommodity_Id` , fpcommodities.fp_name, Unit, projected_monthly_c
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHKEMSA'
) AS temp
WHERE financial_year =  '2013-2014'
GROUP BY temp.fpcommodity_Id");

        return $supplyplan ;
        } 
	
	
}
