<?php
class Pipeline extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('fpcommodity_Id', 'integer', 12);
		$this -> hasColumn('funding_source', 'integer', 12);
		$this -> hasColumn('procuring_agency', 'integer', 12);
		$this -> hasColumn('fp_quantity', 'integer', 12);
		$this -> hasColumn('fp_date', 'date');
		$this -> hasColumn('transaction_type', 'varchar', 12);
		$this -> hasColumn('date_receive', 'date');
		$this -> hasColumn('qty_receive', 'integer' ,12);
		$this -> hasColumn('delay_to', 'date');
		$this -> hasColumn('comment', 'varchar', 100);
		$this -> hasColumn('pending_as_of', 'date');
	}

	public function setUp() {
		$this -> setTableName('pipeline');

	}

	public static function getAllinpipeline() {
		$query = Doctrine_Query::create() -> select("*") -> from("Pipeline");
		$result = $query -> execute();
		return $result;
	}

	public static function getAll_edit($trid) {
		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT pipeline.id AS tr_id, date_receive,transaction_type,pending_as_of,fp_name, funding_sources.id as funding_id,fp_quantity, Unit, funding_sources.funding_source,fp_date, projected_monthly_c
FROM  `pipeline` , fpcommodities, funding_sources WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND funding_sources.id = pipeline.`funding_source` AND pipeline.id =$trid");

		return $supplyplan;
	}

	public static function getall_supply_plan() {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT fpcommodities.fp_name, pending_as_of, pipeline.id AS tr_id, fpcommodities.Unit, funding_sources.`funding_source` , funding_sources.id AS funding_id,  `fp_date` ,  `fp_quantity` ,  `transaction_type` , `date_receive` ,  `delay_to` 
FROM pipeline, fpcommodities, funding_sources
WHERE fpcommodities.id = pipeline.`fpcommodity_Id` 
AND (
 `transaction_type` =  'PENDINGKEMSA'
OR  `transaction_type` =  'DELAYED'
OR  `transaction_type` =  'INCOUNTRY'
OR  `transaction_type` =  'RECEIVED'
)
AND funding_sources.id = pipeline.`funding_source` 
ORDER BY  `pipeline`.`fp_date` DESC 
  ");

		return $supplyplan;
	}

	public static function get_supply_plan() {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT * 
FROM ( SELECT fpcommodities.fp_name, pipeline.id AS tr_id, fpcommodities.Unit, pending_as_of, funding_sources.`funding_source` ,  `fp_date` ,  `fp_quantity` ,  `transaction_type` ,  `qty_receive` ,  `date_receive` , `delay_to` , 
CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year
FROM pipeline, fpcommodities, funding_sources
WHERE fpcommodities.id = pipeline.`fpcommodity_Id` 
AND funding_sources.id = pipeline.`funding_source`
ORDER BY fp_date ASC
) AS temp ORDER BY transaction_type
 ");

		return $supplyplan;
	}

	public static function supply_plan_filter($datefinal,$fpids,$funding_source) {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT * 
FROM ( SELECT fpcommodities.id as c_id,fpcommodities.fp_name, pipeline.id AS tr_id,funding_sources.id as fund_id, fpcommodities.Unit, funding_sources.`funding_source` ,  `fp_date` ,  `fp_quantity` , `transaction_type`,
CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year
FROM pipeline, fpcommodities, funding_sources
WHERE fpcommodities.id = pipeline.`fpcommodity_Id` 
AND funding_sources.id = pipeline.`funding_source`
) AS temp
WHERE fp_date >=  '$datefinal'  
AND c_id= '$fpids'
OR fund_id='$funding_source'");

		return $supplyplan;
	}

	public static function kemsa_psi() {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT fpcommodity_Id, fp_name, Unit, SUM( fp_quantity ) AS fp_quantity, SUM( sohkemsa ) AS sohkemsa, projected_monthly_c, financial_year
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

		return $supplyplan;
	}

	public static function soh_kemsa_psi($year_from, $month) {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT  `fp_quantity` ,  SUM(`fp_quantity` / fpcommodities.projected_monthly_c) AS sohkemsa, fp_date, `fpcommodity_Id` , fpcommodities.fp_name, Unit, projected_monthly_c,  `transaction_type` 
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND YEAR(  `fp_date` ) = '$year_from'
AND MONTH(  `fp_date` ) = '$month'
AND  `transaction_type` =  'SOHKEMSA'
GROUP BY  `fpcommodity_Id");

		return $supplyplan;
	}

	public static function getall_soh() {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT pipeline.id, fpcommodities.fp_name, fpcommodities.Unit,pipeline.fp_quantity,pipeline.fp_date ,transaction_type 
FROM pipeline, fpcommodities WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND (`transaction_type` =  'SOHKEMSA' OR  `transaction_type` =  'SOHPSI')");

		return $supplyplan;
	}
	public static function getall_pipeline() {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT pipeline.id, fpcommodities.fp_name, fpcommodities.Unit,pipeline.fp_quantity,pipeline.fp_date ,transaction_type 
FROM pipeline, fpcommodities WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND (`transaction_type` =  'INCOUNTRY' OR  `transaction_type` =  'RECEIVED')");

		return $supplyplan;
	}

	public static function getid_soh($fpid) {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT pipeline.id, fpcommodities.fp_name, fpcommodities.Unit,pipeline.fp_quantity,pipeline.fp_date ,transaction_type 
FROM pipeline, fpcommodities WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND (`transaction_type` =  'SOHKEMSA' OR  `transaction_type` =  'SOHPSI') AND
pipeline.id='$fpid'");

		return $supplyplan;
	}
public static function getid_pipeline($fpid) {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT pipeline.id,date_receive, fpcommodities.fp_name, fpcommodities.Unit,pipeline.fp_quantity,pipeline.fp_date ,transaction_type 
FROM pipeline, fpcommodities WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND (`transaction_type` =  'INCOUNTRY' OR  `transaction_type` =  'RECEIVED') AND
pipeline.id='$fpid'");

		return $supplyplan;
	}
	public static function getsummary_monthly($date_now,$date_next,$month,$year) {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT fp.fp_name,fp.Unit, 
SUM( IF( pi.transaction_type =  'SOHKEMSA' AND MONTH(pi.fp_date)=$month AND YEAR(pi.fp_date)=$year,pi.fp_quantity, 0 ) ) AS SOHKEMSA, 
SUM( IF( pi.transaction_type =  'SOHPSI' AND MONTH(pi.fp_date)=$month AND YEAR(pi.fp_date)=$year, pi.fp_quantity, 0 ) ) AS SOHPSI,
IF( temp.com_trans_type = 'PENDINGKEMSA'  , temp.total, 0 )  AS PENDINGKEMSA, 
IF( temp.com_trans_type =  'PENDINGPSI' , temp.total, 0 )  AS PENDINGPSI, 
SUM( IF( pi.transaction_type =  'INCOUNTRY', pi.fp_quantity, 0 ) ) AS RECEIVED_KEMSA, 
SUM( IF( pi.transaction_type =  'INCOUNTRY_PSI', pi.fp_quantity, 0 ) ) AS RECEIVED_PSI
FROM pipeline pi
RIGHT JOIN 
(SELECT c.id as fp_id, c.fp_name as com_name, c.Unit as com_unit, p.transaction_type as com_trans_type, 
SUM( p.fp_quantity ) AS total
FROM pipeline p
RIGHT JOIN fpcommodities c ON c.id = p.fpcommodity_Id
WHERE p.fp_date BETWEEN  '$date_now'
AND  '$date_next'
AND (
p.transaction_type LIKE  '%PENDINGKEMSA%'
OR p.transaction_type LIKE  '%PENDINGPSI%'
)
GROUP BY p.fpcommodity_Id, p.transaction_type
ORDER BY c.fp_name ASC ) as temp ON temp.fp_id=pi.fpcommodity_Id
RIGHT JOIN fpcommodities fp ON fp.id = pi.fpcommodity_Id
GROUP BY fp.fp_name
ORDER BY  fp.fp_name ASC ");

		return $supplyplan;
	}

	public static function getsummary_plan($fyear) {

		$supplyplan = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT * 
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year, fp_name, funding_sources.funding_source, Unit,fp_quantity, fp_date, transaction_type, date_receive, qty_receive,`delay_to` 
FROM pipeline, fpcommodities, funding_sources
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND funding_sources.id = pipeline.funding_source
AND (
`transaction_type` =  'INCOUNTRY'
OR  `transaction_type` =  'DELAYED'
OR  `transaction_type` =  'PENDINGKEMSA'
)
GROUP BY fp_name, MONTH(  `fp_date` ) , funding_source, transaction_type
ORDER BY  `fpcommodity_Id` DESC ,  `pipeline`.`fp_date` ASC
) AS temp
WHERE financial_year =  '$fyear'");

		return $supplyplan;
	}
}
