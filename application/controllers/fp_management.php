<?php
class Fp_management extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		ini_set("max_execution_time", "1000000");
		
	}

	public function index() {

		$this -> pipeline();
	}

	public function pipeline() {

		
		$data['title'] = "Pipeline";
		$data['content_view'] = "pipeline_home_v";
		$data['banner_text'] = "Pipeline Management";
		$data['kemsa_psi'] = Pipeline::kemsa_psi();
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::get_supply_plan();
		$data['fundingsource'] = Funding_source::getAllfpfundingsources();
		$this -> load -> view("template", $data);
	}

	public function edit_transaction($trid) {
		
		$data['content_view'] = "edit_v";
		$data['title'] = "Edit";
		$data['banner_text'] = "Edit Supply Plan";
		$data['editdata'] = Pipeline::getAll_edit($trid);
		$this -> load -> view("template", $data);
		

	}
	
	public function Supply_plan() {

		$data['content_view'] = "new_consignment_v";
		$data['title'] = "Edit Supply Plan";
		$data['banner_text'] = "Edit Supply Plan";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline_management::get_supplyplan();
		$data['fundingsource'] = Funding_source::getAllfpfundingsources();
		$this -> load -> view("template", $data);

	}
	public function soh_home() {

		$data['content_view'] = "soh_v";
		$data['title'] = "New SOH";
		$data['banner_text'] = "Edit Supply Plan";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline_management::get_supplyplan();
		$data['fundingsource'] = Funding_source::getAllfpfundingsources();
		$this -> load -> view("template", $data);

	}


	public function editSupply_plan() {

		$data['content_view'] = "edit_supplyplan_v";
		$data['title'] = "Edit Supply Plan";
		$data['banner_text'] = "Edit Supply Plan";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::get_supply_plan();
		//$data= Pipeline::get_supply_plan();
		//var_export($data);
		$this -> load -> view("template", $data);

	}
	public function supply_plan_filter() {
		
		$fpids=$_POST['commoditychange'];		
	    $f_year=$_POST['financeyear'];
		//$fpids=1;		
	   // $f_year='2013-2014';
		$data['banner_text'] = "Edit Supply Plan";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::supply_plan_filter($f_year,$fpids);
		$this -> load -> view("ajax_view/filtered_plan", $data);

	}

	public function Supply_plan_vs_actual() {

		$data['content_view'] = "supplyplan_vs_actual";
		$data['title'] = "Supply Plan Vs Actual";
		$data['banner_text'] = "Supply Plan Vs Actual";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::get_supply_plan();
		$this -> load -> view("template", $data);

	}
	
		public function new_supplyplan()
	{
		
		$fpids=$_POST['pipecommodity'];		
	    $f_source=$_POST['funding_source'];
        $qty=$_POST['quantity'];
		$thedate=$_POST['etadetails'];
		$transaction_type='PENDINGKEMSA';
		 $j=sizeof ($fpids);
		
       $count=0;
	   
        for($me=0;$me<$j;$me++){
        	        	
			if ($qty[$me]>0) {
				$count++;
				
				$mydata = array('fpcommodity_Id' => $fpids[$me], 'funding_source'=>$f_source[$me],'fp_quantity'=> $qty[$me] ,
				 'fp_date'=>date('y-m-d',strtotime($thedate[$me])),'transaction_type'=>$transaction_type);
				
				$u = new Pipeline();

    			$u->fromArray($mydata);

    			$u->save();
				
			}
			
		}
        
		 $this->session->set_flashdata('system_success_message', "Your Supply Plan has been Populated");
		 redirect('fp_management/editSupply_plan');
		
	}
	
	public function new_soh()
	{
		
		$fpids=$_POST['actualcommodity'];		
	    $store=$_POST['store'];
        $actualqty=$_POST['actualqty'];
		$thedate=$_POST['dateofstock'];
		
		 $j=sizeof ($fpids);
		
       $count=0;
	   
        for($me=0;$me<$j;$me++){
        	        	
			if ($actualqty[$me]>0) {
				$count++;
				
				$mydata = array('fpcommodity_Id' => $fpids[$me], 'fp_quantity'=> $actualqty[$me] ,
				 'fp_date'=>date('y-m-d',strtotime($thedate[$me])),'transaction_type'=>$store[$me]);
				
				$u = new Pipeline();

    			$u->fromArray($mydata);

    			$u->save();
				
			}
			
		}
        
		 $this->session->set_flashdata('system_success_message', "Your Actual Stock has been Populated");
		 redirect('fp_management');
		
		
	}
	

	public function supply_plan_filtered() {
		$montharray = array(7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December', 1 => 'January', 2 => 'Febuary', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June');

		$commodity = $_POST['commoditychange'];
		$f_year = $_POST['financeyear'];
		//create array to carry months
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT fpcommodity_Id, SUM(sohkemsa) as sohkemsa, monthn, financial_year
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohkemsa,  `fpcommodity_Id` , MONTH(  `fp_date` ) AS monthn
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHKEMSA'
AND  `fpcommodity_Id` =$commodity
) AS temp
WHERE financial_year = '$f_year'
GROUP BY monthn
 ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);

		$monthnos = array();
		$actual = array();
		foreach ($result as $value) {

			$monthnos[] = $value['monthn'];
			$actual[] = (double)$value['sohkemsa'];

		}
		//query db for data
		//combine data for corespondence, ie map months with respective values
		$arraycombined = array_combine($monthnos, $actual);

		//clean the combined array
		$basket = array_replace($montharray, $arraycombined);

		//loop through to replace string values in array with int
		foreach ($basket as $key => $val) {
			if (is_string($val)) {
				$basket[$key] = 0;
			}

		}
		$actualbasket = array();
		foreach ($basket as $key => $val) {
			$actualbasket[] = $basket[$key];
		}
		//query db for data
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT * 
FROM ( SELECT CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS pending,  `fpcommodity_Id` , MONTHNAME( fp_date ) AS monthname, MONTH( fp_date ) AS monthno, YEAR( fp_date ) AS yearname
FROM pipeline, fpcommodities
WHERE  `fpcommodity_Id` =$commodity
AND fpcommodities.id = pipeline.`fpcommodity_Id` 
AND  `transaction_type` =  'PENDINGKEMSA'
) AS temp
WHERE financial_year =   '$f_year'");
		//sanitize for use in array
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		//arrays to hold separate values
		$monthno = array();
		$pend = array();
		//populate arrays
		foreach ($result as $value) {
			$monthno[] = $value['monthno'];
			$pend[] = (double)$value['pending'];
		}
		//combine data for corespondence, ie map months with respective values
		$arraycombined = array_combine($monthno, $pend);

		//clean the combined array
		$basket = array_replace($montharray, $arraycombined);

		//loop through to replace string values in array with int
		foreach ($basket as $key => $val) {
			if (is_string($val)) {
				$basket[$key] = 0;
			}

		}
		$arrayfinal = array_combine($montharray, $basket);

		$for_calculate = array();
		foreach ($arrayfinal as $key => $value) {
			$for_calculate[] = $arrayfinal[$key];
		}

		for ($i = 0; $i < 11; ) {

			foreach ($for_calculate as $key => $value) {
				//check for the 1st index

				if ($i == 0) {
					if ($for_calculate[$i] == 0) {
						$for_calculate[$key] = $actualbasket[0];

					}
				}

				//clean rest of the array
				if ($i == 1) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[0] - 1 < 0) {
							$for_calculate[1] = 0;
						} else {
							$for_calculate[1] = $for_calculate[0] - 1;
						}
					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[1] = $for_calculate[0] + $for_calculate[1];
					}
				}
				if ($i == 2) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[1] - 1 < 0) {
							$for_calculate[2] = 0;
						} else {
							$for_calculate[2] = $for_calculate[1] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[2] = $for_calculate[1] + $for_calculate[2];
					}
				}
				if ($i == 3) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[2] - 1 < 0) {
							$for_calculate[3] = 0;
						} else {
							$for_calculate[3] = $for_calculate[2] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[3] = $for_calculate[3] + $for_calculate[2];
					}
				}
				if ($i == 4) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[3] - 1 < 0) {
							$for_calculate[4] = 0;
						} else {
							$for_calculate[4] = $for_calculate[3] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[4] = $for_calculate[4] + $for_calculate[3];
					}
				}
				if ($i == 5) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[4] - 1 < 0) {
							$for_calculate[5] = 0;
						} else {
							$for_calculate[5] = $for_calculate[4] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[5] = $for_calculate[5] + $for_calculate[4];
					}
				}
				if ($i == 6) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[5] - 1 < 0) {
							$for_calculate[6] = 0;
						} else {
							$for_calculate[6] = $for_calculate[5] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[6] = $for_calculate[6] + $for_calculate[5];
					}
				}
				if ($i == 7) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[6] - 1 < 0) {
							$for_calculate[7] = 0;
						} else {
							$for_calculate[7] = $for_calculate[6] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[7] = $for_calculate[7] + $for_calculate[6];
					}
				}
				if ($i == 8) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[7] - 1 < 0) {
							$for_calculate[8] = 0;
						} else {
							$for_calculate[8] = $for_calculate[7] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[8] = $for_calculate[8] + $for_calculate[7];
					}
				}
				if ($i == 9) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[8] - 1 < 0) {
							$for_calculate[9] = 0;
						} else {
							$for_calculate[9] = $for_calculate[8] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[9] = $for_calculate[9] + $for_calculate[8];
					}
				}
				if ($i == 10) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[9] - 1 < 0) {
							$for_calculate[10] = 0;
						} else {
							$for_calculate[10] = $for_calculate[9] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[10] = $for_calculate[10] + $for_calculate[9];
					}
				}
				if ($i == 11) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[10] - 1 < 0) {
							$for_calculate[11] = 0;
						} else {
							$for_calculate[11] = $for_calculate[10] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[11] = $for_calculate[11] + $for_calculate[10];
					}
				}

				$i++;

			}
		}
		$arraytograph = array_combine($montharray, $for_calculate);
		$arrayto_graph = array();
		foreach ($arraytograph as $key => $value) {

			$arrayto_graph[] = $arraytograph[$key];

		}
		$mymontharray = array();
		foreach ($montharray as $key => $value) {
			$mymontharray[] = $montharray[$key];
		}
		$montharray = json_encode($mymontharray);
		$arrayto_graph = json_encode($arrayto_graph);
		$arrayactual = json_encode($actualbasket);
		$data['arrayto_graph'] = $arrayto_graph;
		$data['arrayactual'] = $arrayactual;
		$data['montharray'] = $montharray;
		//$data['content_view'] = "supply_plan_v";
		//$data['banner_text'] = "charts";

		$this -> load -> view("supply_plan_v", $data);
	}

	public function supply_plan_default() {
		$montharray = array('7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December', '1' => 'January', '2' => 'Febuary', '3' => 'March', '4'=> 'April', '5' => 'May', '6'=> 'June');

		//create array to carry months
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT fpcommodity_Id, SUM( sohkemsa ) AS sohkemsa, monthn, financial_year
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohkemsa,  `fpcommodity_Id` , MONTH(  `fp_date` ) AS monthn
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHKEMSA'
AND  `fpcommodity_Id` =10
) AS temp
WHERE financial_year =  '2013-2014'
GROUP BY monthn ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);

		$monthnos = array();
		$actual = array();
		foreach ($result as $value) {

			$monthnos[] = $value['monthn'];
			$actual[] = (double)$value['sohkemsa'];

		}
		//query db for data
		//combine data for corespondence, ie map months with respective values
		$arraycombined = array();
		$arraycombined = array_combine($monthnos, $actual);

		//clean the combined array
		$basket = array();
		$basket = array_replace($montharray, $arraycombined);

		//loop through to replace string values in array with int
		foreach ($basket as $key => $val) {
			if (is_string($val)) {
				$basket[$key] = 0;
			}

		}
		$actualbasket = array();
		foreach ($basket as $key => $val) {
			$actualbasket[] = $basket[$key];
		}
		
		//var_dump($actualbasket);
		//exit;
		
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT * 
FROM ( SELECT CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS pending,  `fpcommodity_Id` , MONTHNAME( fp_date ) AS monthname, MONTH( fp_date ) AS monthno, YEAR( fp_date ) AS yearname
FROM pipeline, fpcommodities
WHERE  `fpcommodity_Id` =10
AND fpcommodities.id = pipeline.`fpcommodity_Id` 
AND  `transaction_type` =  'PENDINGKEMSA'
) AS temp
WHERE financial_year =  '2013-2014'	");
		//sanitize for use in array
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		//arrays to hold separate values
		$monthno = array();
		$pend = array();
		//populate arrays
		foreach ($result as $value) {
			$monthno[] = $value['monthno'];
			$pend[] = (double)$value['pending'];
		}
		//combine data for corespondence, ie map months with respective values
		$arraycombined = array_combine($monthno, $pend);
		
		//var_dump($arraycombined);
		//exit;

		//clean the combined array
		$basket = array_replace($montharray, $arraycombined);

		//loop through to replace string values in array with int
		foreach ($basket as $key => $val) {
			if (is_string($val)) {
				$basket[$key] = 0;
			}

		}
		//var_dump($basket);
		//exit;
		$arrayfinal = array_combine($montharray, $basket);
		
		$for_calculate = array();
		foreach ($arrayfinal as $key => $value) {
			$for_calculate[] = $arrayfinal[$key];
		}
		//var_dump($for_calculate);
		//exit;
		for ($i = 0; $i < 11; ) {

			foreach ($for_calculate as $key => $value) {
				//check for the 1st index

				if ($i == 0) {
					if ($for_calculate[$i] == 0) {
						$for_calculate[$key] = $actualbasket[0];

					}
				}

				//clean rest of the array
				if ($i == 1) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[0] - 1 < 0) {
							$for_calculate[1] = 0;
						} else {
							$for_calculate[1] = $for_calculate[0] - 1;
						}
					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[1] = $for_calculate[0] + $for_calculate[1];
					}
				}
				if ($i == 2) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[1] - 1 < 0) {
							$for_calculate[2] = 0;
						} else {
							$for_calculate[2] = $for_calculate[1] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[2] = $for_calculate[1] + $for_calculate[2];
					}
				}
				if ($i == 3) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[2] - 1 < 0) {
							$for_calculate[3] = 0;
						} else {
							$for_calculate[3] = $for_calculate[2] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[3] = $for_calculate[3] + $for_calculate[2];
					}
				}
				if ($i == 4) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[3] - 1 < 0) {
							$for_calculate[4] = 0;
						} else {
							$for_calculate[4] = $for_calculate[3] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[4] = $for_calculate[4] + $for_calculate[3];
					}
				}
				if ($i == 5) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[4] - 1 < 0) {
							$for_calculate[5] = 0;
						} else {
							$for_calculate[5] = $for_calculate[4] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[5] = $for_calculate[5] + $for_calculate[4];
					}
				}
				if ($i == 6) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[5] - 1 < 0) {
							$for_calculate[6] = 0;
						} else {
							$for_calculate[6] = $for_calculate[5] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[6] = $for_calculate[6] + $for_calculate[5];
					}
				}
				if ($i == 7) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[6] - 1 < 0) {
							$for_calculate[7] = 0;
						} else {
							$for_calculate[7] = $for_calculate[6] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[7] = $for_calculate[7] + $for_calculate[6];
					}
				}
				if ($i == 8) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[7] - 1 < 0) {
							$for_calculate[8] = 0;
						} else {
							$for_calculate[8] = $for_calculate[7] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[8] = $for_calculate[8] + $for_calculate[7];
					}
				}
				if ($i == 9) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[8] - 1 < 0) {
							$for_calculate[9] = 0;
						} else {
							$for_calculate[9] = $for_calculate[8] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[9] = $for_calculate[9] + $for_calculate[8];
					}
				}
				if ($i == 10) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[9] - 1 < 0) {
							$for_calculate[10] = 0;
						} else {
							$for_calculate[10] = $for_calculate[9] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[10] = $for_calculate[10] + $for_calculate[9];
					}
				}
				if ($i == 11) {
					if ($for_calculate[$i] == 0) {

						if ($for_calculate[10] - 1 < 0) {
							$for_calculate[11] = 0;
						} else {
							$for_calculate[11] = $for_calculate[10] - 1;
						}

					} elseif ($for_calculate[$i] > 0) {
						$for_calculate[11] = $for_calculate[11] + $for_calculate[10];
					}
				}

				$i++;

			}
		}
		
		$arraytograph = array_combine($montharray, $for_calculate);
		$arrayto_graph = array();
		foreach ($arraytograph as $key => $value) {

			$arrayto_graph[] = $arraytograph[$key];

		}
		$mymontharray = array();
		foreach ($montharray as $key => $value) {
			$mymontharray[] = $montharray[$key];
		}
		//var_dump($mymontharray);
		//var_dump($arrayto_graph);
		//exit;
		$montharray = json_encode($mymontharray);
		$arrayto_graph = json_encode($arrayto_graph);
		$arrayactual = json_encode($actualbasket);
		$data['arrayto_graph'] = $arrayto_graph;
		$data['arrayactual'] = $arrayactual;
		$data['montharray'] = $montharray;
		//$data['content_view'] = "supply_plan_v";
		//$data['banner_text'] = "charts";

		$this -> load -> view("supply_plan_v", $data);
	}

public function kemsa_psidata() {
		//get available fps at kemsa aggregated
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT fpcommodity_Id, SUM( sohkemsa ) AS sohkemsa, financial_year
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohkemsa,  `fpcommodity_Id` 
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHKEMSA'
) AS temp
WHERE financial_year =  '2013-2014'
GROUP BY temp.fpcommodity_Id ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		$arrayfp = array();
		$arraypending = array();
		foreach ($result as $value) {

			$arrayfp[] = $value['fpcommodity_Id'];
			$arraypending[] = (double)$value['sohkemsa'];
		}
		
		$arraycombined = array_combine($arrayfp,$arraypending);
		
		//var_dump($arraycombined);
		
		
		$commodities = Fpcommodities::getAllfpcommodities();
		//$rowcount=count($commodities);
		$arrayfpname = array();
		//for ($i=1; $i <= $rowcount;) { 
			
		
		foreach ($commodities as $values) {

			$arrayfpname[$values -> id] = $values -> fp_name;
//$i++;
		//}
		
		}
		//echo json_encode($arrayfpname);
		
		//exit;
		 
///error in how combine is done, doesnt quite work, wrong array mapping
		ksort($arrayfpname);
		//var_dump($arrayfpname);
		$basketkemsa = array_replace($arrayfpname, $arraycombined);
		//ksort($basketkemsa);
		
		foreach ($basketkemsa as $key => $val) {
			if (is_string($val)) {
				$basketkemsa[$key] = 0;
			}
		}
		
		$array_finalkemsa = array();
		foreach ($basketkemsa as $key => $val) {

			$array_finalkemsa[] = $basketkemsa[$key];

		}
		foreach ($arrayfpname as $key => $val) {

			$array_finalfp[] = $arrayfpname[$key];

		}
		//var_dump($array_finalfp);
		//var_dump($array_finalkemsa);
		//echo $array_finalkemsa = json_encode($array_finalkemsa);
		//echo $array_finalfp = json_encode($array_finalfp);
		//exit;
		//query for second graph psi
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT fpcommodity_Id, SUM( sohpsi ) AS sohpsi, financial_year
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohpsi,  `fpcommodity_Id` 
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHPSI'
) AS temp
WHERE financial_year =  '2013-2014'
GROUP BY temp.fpcommodity_Id ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		$arrayfp = array();
		$arraypending = array();
		
		foreach ($result as $value) {

			$arrayfp[] = $value['fpcommodity_Id'];
			$arraypending[] = (double)$value['sohpsi'];
		}

		$arraycombined = array_combine($arrayfp, $arraypending);

		$basketpsi = array_replace($arrayfpname, $arraycombined);

		foreach ($basketpsi as $key => $val) {
			if (is_string($val)) {
				$basketpsi[$key] = 0;
			}

		}

		$array_finalpsi = array();
		foreach ($basketpsi as $key => $val) {

			$array_finalpsi[] = $basketpsi[$key];

		}
		//var_dump($array_finalpsi);
		//var_dump($array_finalkemsa);
		//echo $array_finalkemsa = json_encode($array_finalkemsa);
		//echo $array_finalfp = json_encode($array_finalfp);
		//exit;
		//query for second graph pending
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT * FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
					THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
					END AS financial_year, SUM(  `fp_quantity` ) / fpcommodities.projected_monthly_c AS sohpending,  `fpcommodity_Id` 
					FROM pipeline, fpcommodities WHERE fpcommodities.id = pipeline.`fpcommodity_Id` AND  `transaction_type` = 'PENDINGKEMSA' GROUP BY fpcommodity_Id ) AS temp
					WHERE financial_year =  '2013-2014' ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		$arrayfp = array();
		$arraypending = array();
		foreach ($result as $value) {

			$arrayfp[] = $value['fpcommodity_Id'];
			$arraypending[] = (double)$value['sohpending'];
		}

		$arraycombined = array_combine($arrayfp, $arraypending);

		$basketpend = array_replace($arrayfpname, $arraycombined);

		foreach ($basketpend as $key => $val) {
			if (is_string($val)) {
				$basketpend[$key] = 0;
			}

		}

		$array_finalpend = array();
		foreach ($basketpend as $key => $val) {

			$array_finalpend[] = $basketpend[$key];

		}
		
		$array_finalkemsa = json_encode($array_finalkemsa);
		$array_finalfp = json_encode($array_finalfp);
		$array_finalpsi = json_encode($array_finalpsi);
		$array_finalpend = json_encode($array_finalpend);
		$data['array_finalpsi'] = $array_finalpsi;
		$data['array_finalkemsa'] = $array_finalkemsa;
		$data['array_finalpend'] = $array_finalpend;
		$data['arrayfpname'] = $array_finalfp;
		$this -> load -> view("ajax_view/kemsapsi_ajax_v", $data);

	}


}
