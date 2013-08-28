<?php
class Stocks_management extends MY_Controller {

function __construct() {
	parent::__construct();
	$this -> load -> helper(array('form', 'url' ));
}

			public function index() {
			$data['title'] = "Stocks";
			$data['content_view'] = "stocks_home_v";
			$data['banner_text'] = "Stocks";
			$data['stock_entry'] = Fpcommodities::getAllfpcommodities();
			$this -> load -> view("template" , $data);
			}
public function submit_stock_status() {

			$fpid = $_POST[
		'fpid'];
			$SOHKEMSA = $_POST['SOHKEMSA'];
			$SOHPSI = $_POST['SOHPSI'];
			$PendingKEMSA = $_POST['PendingKEMSA'];
			$PendingPSI = $_POST['PendingPSI'];
			$thedate = $_POST['date_stock'];
			$j = sizeof($fpid);
			$count = 0;

			for ($me = 0; $me < $j; $me++) {

			if ($SOHKEMSA[$me] > 0) {
			$count++;

			$mydata = array('fpcommodity_id' => $fpid[$me], 'soh_Kemsa' => $SOHKEMSA[$me], 'soh_Psi' => $SOHPSI[$me], 'pending_Kemsa' => $PendingKEMSA[$me], 'pending_Psi' => $PendingPSI[$me], 'date' => date('y-m-d', strtotime($thedate)));

			$u = new Fp_Stocks();

			$u -> fromArray($mydata);

			$u -> save();

			}

			}

			$this -> session -> set_flashdata('system_success_message', "Successful Data entry");
			redirect('stocks_management_controller' );
			}

public function pipeline() {
				//query for first graph

			$con = Doctrine_Manager::getInstance() -> connection();
			$st = $con -> execute("SELECT fpcommodities.fp_name, SUM( pipeline_management.`pending` ) / fpcommodities.projected_monthly_c AS pending, SUM( pipeline_management.`received` ) / fpcommodities.projected_monthly_c AS received, SUM( pipeline_management.`delayed` ) / fpcommodities.projected_monthly_c AS delays FROM  `pipeline_management` , fpcommodities	WHERE fpcommodities.id = pipeline_management.`fpcommodity_Id` GROUP BY fpcommodities.fp_name ");
			$result = $st -> fetchAll(PDO::FETCH_ASSOC);
			$arrayfp = array();
			$arraypending = array();
			$arraydelayed = array();
			$arrayreceived = array();
			foreach ($result as $value) {

			$arrayfp[] = $value['fp_name'];
			$arraypending[] = (double)$value['pending'];
			$arraydelayed[] = (double)$value['delays'];
			$arrayreceived[] = (double)$value['received'];

			}

			$arrayfp = json_encode($arrayfp);
			$arraypending = json_encode($arraypending);
			$arraydelayed = json_encode($arraydelayed);
			$arrayreceived = json_encode($arrayreceived);
			//$e=Pipeline_management::get_supplyplan();
			//var_dump($e);
			//exit;
			//create array to carry months
	$montharray = array(
	7 => 'July',8 => 'August',9 => 'September',	10 => 'October',11 => 'November',12 => 'December',1 => 'January',2 => 'Febuary',3 => 'March',4 => 'April',5 => 'May',6 => 'June');
	//query db for data
	$con = Doctrine_Manager::getInstance() -> connection();
	$st = $con -> execute("SELECT *
	FROM (	SELECT CASE
	WHEN MONTH( eta_details ) >=7
	THEN CONCAT( YEAR( eta_details ) ,  '-', YEAR( eta_details ) +1 )
	ELSE CONCAT( YEAR( eta_details ) -1,  '-', YEAR( eta_details ) )
	END AS financial_year,  `pending`/fpcommodities.projected_monthly_c AS pending ,  `fpcommodity_Id` , MONTHNAME( eta_details ) AS monthname, MONTH( eta_details ) AS monthno, YEAR( eta_details ) AS yearname
	FROM pipeline_management,fpcommodities
	WHERE  `fpcommodity_Id` =3
	AND  fpcommodities.id = pipeline_management.`fpcommodity_Id`
	) AS temp
	WHERE financial_year =  '2013-2014'

	");
	//sanitize for use in array
	$result = $st -> fetchAll(PDO::FETCH_ASSOC);
	//arrays to hold separate values
	$monthno=array();
	$pend=array();
	//populate arrays
	foreach ($result as $value) {
	$monthno[] = $value['monthno'];
	$pend[] = (double)$value['pending'];
	}
	//combine data for corespondence, ie map months with respective values
	$arraycombined=array_combine($monthno, $pend);
	
	//clean the combined array
	$basket = array_replace($montharray, $arraycombined);
	
	//loop through to replace string values in array with int
	foreach($basket as $key => $val)
	{
	if (is_string($val)) {
	$basket[$key] = 0;
	}

	}
	$arrayfinal=array_combine($montharray, $basket);
	
	$for_calculate=array();
	foreach ($arrayfinal as $key => $value) {
	$for_calculate[]=$arrayfinal[$key];
	}
	$i=0;
	foreach ($for_calculate as $key => $value) {
		//check for the 1st index
		
		if($i==0){
		if ($for_calculate[$i]==0) {
			$for_calculate[$key]=3;
			 
		}	
		}
		//clean rest of the array
		if($i==1){
		if ($for_calculate[$i]==0) {
			$for_calculate[1]=$for_calculate[0]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[1]=$for_calculate[0]+$for_calculate[1];
		}	
		}
		if($i==2){
		if ($for_calculate[$i]==0) {
			$for_calculate[2]=$for_calculate[1]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[2]=$for_calculate[1]+$for_calculate[2];
		}	
		}
		if($i==3){
		if ($for_calculate[$i]==0) {
			$for_calculate[3]=$for_calculate[2]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[3]=$for_calculate[3]+$for_calculate[2];
		}	
		}
		if($i==4){
		if ($for_calculate[$i]==0) {
			$for_calculate[4]=$for_calculate[3]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[4]=$for_calculate[4]+$for_calculate[3];
		}	
		}
		if($i==5){
		if ($for_calculate[$i]==0) {
			$for_calculate[5]=$for_calculate[4]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[5]=$for_calculate[5]+$for_calculate[4];
		}	
		}
		if($i==6){
		if ($for_calculate[$i]==0) {
			$for_calculate[6]=$for_calculate[5]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[6]=$for_calculate[6]+$for_calculate[5];
		}	
		}
		if($i==7){
		if ($for_calculate[$i]==0) {
			$for_calculate[7]=$for_calculate[6]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[7]=$for_calculate[7]+$for_calculate[6];
		}	
		}
		if($i==8){
		if ($for_calculate[$i]==0) {
			$for_calculate[8]=$for_calculate[7]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[8]=$for_calculate[8]+$for_calculate[7];
		}	
		}
		if($i==9){
		if ($for_calculate[$i]==0) {
			$for_calculate[9]=$for_calculate[8]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[9]=$for_calculate[9]+$for_calculate[8];
		}	
		}
		if($i==10){
		if ($for_calculate[$i]==0) {
			$for_calculate[10]=$for_calculate[9]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[10]=$for_calculate[10]+$for_calculate[9];
		}	
		}
		if($i==11){
		if ($for_calculate[$i]==0) {
			$for_calculate[11]=$for_calculate[10]-1;
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[11]=$for_calculate[11]+$for_calculate[10];
		}	
		}
		
		
   $i++;
   
	}
		$arraytograph=array_combine($montharray, $for_calculate);
		$arrayto_graph = array();
			foreach ($arraytograph as $key => $value) {

			$arrayto_graph[] = $arraytograph[$key];
			
			}
		$arrayto_graph = json_encode($arrayto_graph);
		
		$mymontharray=array();
		foreach ($montharray as $key => $value ) {
			$mymontharray[]=$montharray[$key];
		}
		 $montharray = json_encode($mymontharray);
	//exit;
	//var_dump($arraytograph);

			$data['title'] = "Pipeline";
			$data['content_view'] = "pipeline_home_v";
			$data['banner_text'] = "Pipeline Management";
			$data['arrayto_graph'] = $arrayto_graph;
			$data['montharray'] = $montharray;
			$data['arrayfp'] = $arrayfp;
			$data['arraypending'] = $arraypending;
			$data['arraydelayed'] = $arraydelayed;
			$data['arrayreceived'] = $arrayreceived;
			$data['supplyplan'] =Pipeline_management::get_supplyplan();
			$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
			$data['fundingsource'] = Funding_source::getAllfpfundingsources();
			$this -> load -> view("template", $data);
			}

public function submit_pipeline() {

			$pipecommodity = $_POST[
		'pipecommodity'];
		$funding_source = $_POST['funding_source'];
		$quantity = $_POST['quantity'];
		$datetime = $_POST['etadetails'];
		//$thedate=date('y-m-d', strtotime($datetime));

		
			//$response = array('msg' => 'You have entered a wrong password.', 'response' => 'false');
			//echo json_encode($response);
	

			$u1 = new Pipeline_management();
			$u1 -> fpcommodity_Id = $pipecommodity;
			$u1 -> funding_source = $funding_source;
			$u1 -> eta_details = date('y-m-d', strtotime($datetime));
			$u1 -> pending = $quantity;
			$u1 -> save();

			$response = array('msg' => 'Successfull Entry.', 'response' => 'true');
			//$this->session->set_flashdata('system_success_message', 'Success!!! Your password has been changed.');
			echo json_encode($response);

			//$this->session->set_flashdata('system_success_message', 'Success!!! Your password has been changed.');
			//redirect('Home_Controller');
		

	}

	
	
public function supply_plan_filtered()
	{
		
		$commodity=$_POST['commoditychange'];
	//create array to carry months
	$montharray = array(
	7 => 'July',	8 => 'August',	9 => 'September',	10 => 'October',	11 => 'November',	12 => 'December',1 => 'January',	2 => 'Febuary',	3 => 'March',	4 => 'April',	5 => 'May',	6 => 'June'	);
	//query db for data
	$con = Doctrine_Manager::getInstance() -> connection();
	$st = $con -> execute("SELECT *	FROM (	SELECT CASE	WHEN MONTH( eta_details ) >=7 THEN CONCAT( YEAR( eta_details ) ,  '-', YEAR( eta_details ) +1 )	ELSE CONCAT( YEAR( eta_details ) -1,  '-', YEAR( eta_details ) ) END AS financial_year,  `pending`/fpcommodities.projected_monthly_c AS pending ,  `fpcommodity_Id` , MONTHNAME( eta_details ) AS monthname, MONTH( eta_details ) AS monthno, YEAR( eta_details ) AS yearname FROM pipeline_management,fpcommodities WHERE  `fpcommodity_Id` =$commodity AND  fpcommodities.id = pipeline_management.`fpcommodity_Id`) AS temp	WHERE financial_year =  '2013-2014'	");
	//sanitize for use in array
	$result = $st -> fetchAll(PDO::FETCH_ASSOC);
	//arrays to hold separate values
	$monthno=array();
	$pend=array();
	//populate arrays
	foreach ($result as $value) {
	$monthno[] = $value['monthno'];
	$pend[] = (double)$value['pending'];
	}
	//combine data for corespondence, ie map months with respective values
	$arraycombined=array_combine($monthno, $pend);
	
	//clean the combined array
	$basket = array_replace($montharray, $arraycombined);
	
	//loop through to replace string values in array with int
	foreach($basket as $key => $val)
	{
	if (is_string($val)) {
	$basket[$key] = 0;
	}

	}
	$arrayfinal=array_combine($montharray, $basket);
	
	$for_calculate=array();
	foreach ($arrayfinal as $key => $value) {
	$for_calculate[]=$arrayfinal[$key];
	}
	
	for ($i=0; $i <11 ;) { 
		
	
	foreach ($for_calculate as $key => $value) {
		//check for the 1st index
		
		if($i==0){
		if ($for_calculate[$i]==0) {
			$for_calculate[$key]=3;
			 
		}	
		}
		
		//clean rest of the array
		if($i==1){
		if ($for_calculate[$i]==0) {
			
			 if ($for_calculate[0]-1 <0) {
				 $for_calculate[1]=0;
			 }else {
				 $for_calculate[1]=$for_calculate[0]-1;
			 }
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[1]=$for_calculate[0]+$for_calculate[1];
		}	
		}
		if($i==2){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[1]-1 < 0) {
				 $for_calculate[2]=0;
			 }else {
				 $for_calculate[2]=$for_calculate[1]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[2]=$for_calculate[1]+$for_calculate[2];
		}	
		}
		if($i==3){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[2]-1 < 0) {
				 $for_calculate[3]=0;
			 }else {
				 $for_calculate[3]=$for_calculate[2]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[3]=$for_calculate[3]+$for_calculate[2];
		}	
		}
		if($i==4){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[3]-1 < 0) {
				 $for_calculate[4]=0;
			 }else {
				 $for_calculate[4]=$for_calculate[3]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[4]=$for_calculate[4]+$for_calculate[3];
		}	
		}
		if($i==5){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[4]-1 < 0) {
				 $for_calculate[5]=0;
			 }else {
				 $for_calculate[5]=$for_calculate[4]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[5]=$for_calculate[5]+$for_calculate[4];
		}	
		}
		if($i==6){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[5]-1 < 0) {
				 $for_calculate[6]=0;
			 }else {
				 $for_calculate[6]=$for_calculate[5]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[6]=$for_calculate[6]+$for_calculate[5];
		}	
		}
		if($i==7){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[6]-1 < 0) {
				 $for_calculate[7]=0;
			 }else {
				 $for_calculate[7]=$for_calculate[6]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[7]=$for_calculate[7]+$for_calculate[6];
		}	
		}
		if($i==8){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[7]-1 < 0) {
				 $for_calculate[8]=0;
			 }else {
				 $for_calculate[8]=$for_calculate[7]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[8]=$for_calculate[8]+$for_calculate[7];
		}	
		}
		if($i==9){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[8]-1 < 0) {
				 $for_calculate[9]=0;
			 }else {
				 $for_calculate[9]=$for_calculate[8]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[9]=$for_calculate[9]+$for_calculate[8];
		}	
		}
		if($i==10){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[9]-1 < 0) {
				 $for_calculate[10]=0;
			 }else {
				 $for_calculate[10]=$for_calculate[9]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[10]=$for_calculate[10]+$for_calculate[9];
		}	
		}
		if($i==11){
		if ($for_calculate[$i]==0) {
			
			if ($for_calculate[10]-1 < 0) {
				 $for_calculate[11]=0;
			 }else {
				 $for_calculate[11]=$for_calculate[10]-1;
			 }
			 
		}elseif ($for_calculate[$i]>0) {
			$for_calculate[11]=$for_calculate[11]+$for_calculate[10];
		}	
		}
		
		
   $i++;
   
	}
	}
		$arraytograph=array_combine($montharray, $for_calculate);
		$arrayto_graph = array();
			foreach ($arraytograph as $key => $value) {

			$arrayto_graph[] = $arraytograph[$key];
			
			}
			$mymontharray=array();
		foreach ($montharray as $key => $value ) {
			$mymontharray[]=$montharray[$key];
		}
		 $montharray = json_encode($mymontharray);
		$arrayto_graph = json_encode($arrayto_graph);
		
		$data['arrayto_graph'] = $arrayto_graph;
		$data['montharray'] = $montharray;
		//$data['content_view'] = "supply_plan_v";
		//$data['banner_text'] = "charts";

		$this -> load -> view("supply_plan_v", $data);
	}

	}
	