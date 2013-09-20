<?php
class Fp_management extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		ini_set("max_execution_time", "1000000");
		//ini_set("upload_max_filesize", "500000000");
		ini_set("memory_limit", '2048M');
		
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
	public function update_transaction() {
		$action=$_POST['action'];	
		$trid=$_POST['trid'];		
	    $Receive=$_POST['Receive'];
		$qtyReceive=$_POST['qtyReceive'];
		$delay=$_POST['delay'];
		$comment=$_POST['comment'];
		$receivedate=date('y-m-d',strtotime($Receive));
		$delaydate=date('y-m-d',strtotime($delay));
		
		if ($action==1) {
			$updateaction='INCOUNTRY';
			
		}elseif ($action==2) {
			 $updateaction='DELAYED';
			
		}
		
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute(" UPDATE  `drh`.`pipeline` SET  `date_receive` =  '$receivedate', `qty_receive` = $qtyReceive,
		`transaction_type`='$updateaction' ,`delay_to` = '$delaydate', `comment` = '$comment' WHERE  `pipeline`.`id` =$trid; ");
		
			
		$this->session->set_flashdata('system_success_message', "Transaction Updated");
		redirect('fp_management/editSupply_plan');

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
public function soh_detailed() {
	   
		$year_from=date('Y');;		
	    $month=date('n');
		$data['kemsa_psi'] = Pipeline::soh_kemsa_psi($year_from,$month);
		$mycount=count(Pipeline::soh_kemsa_psi($year_from,$month));
		if ($mycount==0) {
			echo "<div>No Record</>";
		} elseif($mycount>0) {
		$data['content_view'] = "soh_detailed";
		$data['title'] = "SOH";
		$data['banner_text'] = "SOH Detailed";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::get_supply_plan();
		$this -> load -> view("template", $data);	
		}
		
		

	}

public function soh_filtered() {

		$year_from=$_POST['year_from'];		
	    $month=$_POST['month'];
		$data['kemsa_psi'] = Pipeline::soh_kemsa_psi($year_from,$month);
		$mycount=count(Pipeline::soh_kemsa_psi($year_from,$month));
		
		if ($mycount==0) {
			echo "<div style='margin-left:50%;margin-top:5%;font-size:18px'>No Record for $month $year_from</>";
		} elseif($mycount>0) {
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::get_supply_plan();
		$this -> load -> view("ajax_view/filter_soh", $data);

	}
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
	public function settings_home() {

		
		$data['title'] = "Settings";
		$data['content_view'] = "settings_home_v";
		$data['banner_text'] = "Settings";
		$data['kemsa_psi'] = Pipeline::kemsa_psi();
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::get_supply_plan();
		$data['fundingsource'] = Funding_source::getAllfpfundingsources();
		$this -> load -> view("template", $data);
	}
	

	
	public function supply_plan_default() {
				//create array to carry months
		
		$montharray = array('7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December', '1' => 'January', '2' => 'Febuary', '3' => 'March', '4'=> 'April', '5' => 'May', '6'=> 'June');
if ($this->input->post('financeyear') && $this->input->post('commoditychange1') && $this->input->post('commoditychange2')){
		$f_year=$_POST['financeyear'];		
	   $fpcommodity1=$_POST['commoditychange1'];
	   $fpcommodity2=$_POST['commoditychange2'];
	} else {
	 $f_year=2013-2014;		
	 $fpcommodity1=8;
	 $fpcommodity2=1;
		//exit;
	}
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT fpcommodity_Id, SUM( sohkemsa ) AS sohkemsa, monthn, financial_year, fp_name
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohkemsa,  `fpcommodity_Id` , MONTH(  `fp_date` ) AS monthn, fp_name
FROM pipeline, fpcommodities WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND ( `transaction_type` =  'SOHKEMSA' OR  `transaction_type` =  'INCOUNTRY')
AND `fpcommodity_Id` ='$fpcommodity1' ) AS temp WHERE financial_year =  '2013-2014' GROUP BY monthn, fpcommodity_Id ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		
$st2 = $con -> execute("SELECT fpcommodity_Id, SUM( sohkemsa ) AS sohkemsa, monthn, financial_year, fp_name
FROM ( SELECT CASE WHEN MONTH(  `fp_date` ) >=7
THEN CONCAT( YEAR(  `fp_date` ) ,  '-', YEAR(  `fp_date` ) +1 ) 
ELSE CONCAT( YEAR(  `fp_date` ) -1,  '-', YEAR(  `fp_date` ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS sohkemsa,  `fpcommodity_Id` , MONTH(  `fp_date` ) AS monthn, fp_name
FROM pipeline, fpcommodities WHERE pipeline.`fpcommodity_Id` = fpcommodities.id AND ( `transaction_type` =  'SOHKEMSA' OR  `transaction_type` =  'INCOUNTRY')
AND `fpcommodity_Id` ='$fpcommodity2' ) AS temp WHERE financial_year =  '2013-2014' GROUP BY monthn, fpcommodity_Id ");
		$result2 = $st2 -> fetchAll(PDO::FETCH_ASSOC);
				
		$monthnos =  array();
		$actual = array();
		$commodity = array();
		foreach ($result as $value) {

			$monthnos[] = $value['monthn'];
			$actual[] = (double)$value['sohkemsa'];
			$commodity[] = $value['fp_name'];

		}
		
		$monthnos2 =  array();
		$actual2 = array();
		$commodity2 = array();
		foreach ($result2 as $value) {

			$monthnos2[] = $value['monthn'];
			$actual2[] = (double)$value['sohkemsa'];
			$commodity2[] = $value['fp_name'];

		}
	
		$combined = array_combine($monthnos, $actual);
		$basket = array_replace($montharray, $combined);
		
		$combined2 = array_combine($monthnos2, $actual2);
		$basket2 = array_replace($montharray, $combined2);

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
		unset($combined);
		
		
		foreach ($basket2 as $key => $val) {
			if (is_string($val)) {
				$basket2[$key] = 0;
			}

		}
		$actualbasket2 = array();
		foreach ($basket2 as $key => $val) {
			$actualbasket2[] = $basket2[$key];
		}
		unset($combined2);
		
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT * 
FROM ( SELECT CASE WHEN MONTH( fp_date ) >=7
THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) 
END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS pending,  `fpcommodity_Id` , MONTHNAME( fp_date ) AS monthname, MONTH( fp_date ) AS monthno, YEAR( fp_date ) AS yearname
FROM pipeline, fpcommodities WHERE  `fpcommodity_Id` ='$fpcommodity1' AND fpcommodities.id = pipeline.`fpcommodity_Id` AND  (`transaction_type` =  'PENDINGKEMSA'
OR  `transaction_type` =  'DELAYED' OR  `transaction_type` =  'INCOUNTRY' )) AS temp WHERE financial_year =  '2013-2014'");
		//sanitize for use in array
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		//arrays to hold separate values
		 $st2 = $con -> execute("SELECT * FROM ( SELECT CASE WHEN MONTH( fp_date ) >=7 THEN CONCAT( YEAR( fp_date ) ,  '-', YEAR( fp_date ) +1 ) 
ELSE CONCAT( YEAR( fp_date ) -1,  '-', YEAR( fp_date ) ) END AS financial_year,  `fp_quantity` / fpcommodities.projected_monthly_c AS pending,  `fpcommodity_Id` , MONTHNAME( fp_date ) AS monthname, MONTH( fp_date ) AS monthno, YEAR( fp_date ) AS yearname
FROM pipeline, fpcommodities WHERE  `fpcommodity_Id` ='$fpcommodity2' AND fpcommodities.id = pipeline.`fpcommodity_Id` AND  (`transaction_type` =  'PENDINGKEMSA'
OR  `transaction_type` =  'DELAYED' OR  `transaction_type` =  'INCOUNTRY' )) AS temp WHERE financial_year =  '2013-2014'");
		//sanitize for use in array
		
		$result2 = $st2 -> fetchAll(PDO::FETCH_ASSOC);
		$monthno = array();
		$pend = array();
		//populate arrays
		foreach ($result as $value) {
			$monthno[] = $value['monthno'];
			$pend[] = (double)$value['pending'];
		}
		if (count($pend)==0) {
			$pend[]=0;
			$monthno[]=7;
		} 
		
		$monthno2 = array();
		$pend2 = array();
		//populate arrays
		foreach ($result2 as $value) {
			$monthno2[] = $value['monthno'];
			$pend2[] = (double)$value['pending'];
		}
		if (count($pend2)==0) {
			$pend2[]=0;
			$monthno2[]=7;
		} 
		
		//combine data for corespondence, ie map months with respective values
		$arraycombined = array_combine($monthno, $pend);
		$basket = array_replace($montharray, $arraycombined);
		
		$arraycombined2 = array_combine($monthno2, $pend2);
		$basket2 = array_replace($montharray, $arraycombined2);

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
		//var_dump($for_calculate);
		//exit;
		

			foreach ($for_calculate as $key => $value) {
				//check for the 1st index
$i = 0;
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

foreach ($basket2 as $key => $val) {
			if (is_string($val)) {
				$basket2[$key] = 0;
			}

		}
		
		$arrayfinal2 = array_combine($montharray, $basket2);
		
		$for_calculate2 = array();
		foreach ($arrayfinal2 as $key => $value) {
			$for_calculate2[] = $arrayfinal2[$key];
		}
		//var_dump($for_calculate);
		//exit;
		

			foreach ($for_calculate2 as $key => $value) {
				//check for the 1st index
$j = 0;
				if ($j == 0) {
					if ($for_calculate2[$j] == 0) {
						$for_calculate2[$key] = $actualbasket2[0];

					}
				}

				//clean rest of the array
				if ($j == 1) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[0] - 1 < 0) {
							$for_calculate2[1] = 0;
						} else {
							$for_calculate2[1] = $for_calculate2[0] - 1;
						}
					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[1] = $for_calculate2[0] + $for_calculate2[1];
					}
				}
				if ($j == 2) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[1] - 1 < 0) {
							$for_calculate2[2] = 0;
						} else {
							$for_calculate2[2] = $for_calculate2[1] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[2] = $for_calculate2[1] + $for_calculate2[2];
					}
				}
				if ($j == 3) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[2] - 1 < 0) {
							$for_calculate2[3] = 0;
						} else {
							$for_calculate2[3] = $for_calculate2[2] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[3] = $for_calculate2[3] + $for_calculate2[2];
					}
				}
				if ($j == 4) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[3] - 1 < 0) {
							$for_calculate2[4] = 0;
						} else {
							$for_calculate2[4] = $for_calculate2[3] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[4] = $for_calculate2[4] + $for_calculate2[3];
					}
				}
				if ($j == 5) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[4] - 1 < 0) {
							$for_calculate2[5] = 0;
						} else {
							$for_calculate2[5] = $for_calculate2[4] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[5] = $for_calculate2[5] + $for_calculate2[4];
					}
				}
				if ($j == 6) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[5] - 1 < 0) {
							$for_calculate2[6] = 0;
						} else {
							$for_calculate2[6] = $for_calculate2[5] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[6] = $for_calculate2[6] + $for_calculate2[5];
					}
				}
				if ($j == 7) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[6] - 1 < 0) {
							$for_calculate2[7] = 0;
						} else {
							$for_calculate2[7] = $for_calculate2[6] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[7] = $for_calculate2[7] + $for_calculate2[6];
					}
				}
				if ($j == 8) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[7] - 1 < 0) {
							$for_calculate2[8] = 0;
						} else {
							$for_calculate2[8] = $for_calculate2[7] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[8] = $for_calculate2[8] + $for_calculate2[7];
					}
				}
				if ($j == 9) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[8] - 1 < 0) {
							$for_calculate2[9] = 0;
						} else {
							$for_calculate2[9] = $for_calculate2[8] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[9] = $for_calculate2[9] + $for_calculate2[8];
					}
				}
				if ($j == 10) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[9] - 1 < 0) {
							$for_calculate2[10] = 0;
						} else {
							$for_calculate2[10] = $for_calculate2[9] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[10] = $for_calculate2[10] + $for_calculate2[9];
					}
				}
				if ($j == 11) {
					if ($for_calculate2[$j] == 0) {

						if ($for_calculate2[10] - 1 < 0) {
							$for_calculate2[11] = 0;
						} else {
							$for_calculate2[11] = $for_calculate2[10] - 1;
						}

					} elseif ($for_calculate2[$j] > 0) {
						$for_calculate2[11] = $for_calculate2[11] + $for_calculate2[10];
					}
				}

				$j++;

			}
		
		
		$arraytograph2 = array_combine($montharray, $for_calculate2);
		$arrayto_graph2 = array();
		foreach ($arraytograph2 as $key => $value) {

			$arrayto_graph2[] = $arraytograph2[$key];

		}
		$arraytograph = array_combine($montharray, $for_calculate2);
		$arrayto_graph = array();
		foreach ($arraytograph as $key => $value) {

			$arrayto_graph[] = $arraytograph[$key];

		}
		$mymontharray = array();
		foreach ($montharray as $key => $value) {
			$mymontharray[] = $montharray[$key];
		}
				
		$data['commodityname'] = $commodity[0];
		$data['commodityname2'] = $commodity2[0];
		$data['arrayto_graph'] = json_encode($arrayto_graph);
		$data['arrayactual'] = json_encode($actualbasket);
		$data['arrayto_graph2'] = json_encode($arrayto_graph2);
		$data['arrayactual2'] = json_encode($actualbasket2);
		$data['montharray'] = json_encode($mymontharray);
		$this -> load -> view("supply_plan_v", $data);
	}

public function kemsa_data() {
	if ($this->input->post('year_kemsapsi') && $this->input->post('monthkemsapsi') ){
		$year_from=$_POST['year_kemsapsi'];		
	   $month=$_POST['monthkemsapsi'];
	} else {
		 $year_from=2013;		
	     $month=8;
	}
		
		//get available fps at kemsa aggregated
		//get available fps at kemsa aggregated
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT SUM(  `fp_quantity` / fpcommodities.projected_monthly_c ) AS sohkemsa,  `fpcommodity_Id` 
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHKEMSA'
AND MONTH(  `fp_date` ) =$month
AND YEAR(  `fp_date` ) =$year_from
GROUP BY fpcommodity_Id ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		$arrayfp = array();
		$arraypending = array();
		foreach ($result as $value) {

			$arrayfp[] = $value['fpcommodity_Id'];
			$arraypending[] = (double)$value['sohkemsa'];
		}
		if (count($arraypending)==0) {
			$arraypending[]=0;
			$arrayfp[]=0;
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
		$st = $con -> execute("SELECT SUM(  `fp_quantity` ) / fpcommodities.projected_monthly_c AS sohpending,  `fpcommodity_Id` 
FROM pipeline, fpcommodities
WHERE fpcommodities.id = pipeline.`fpcommodity_Id` 
AND (
`transaction_type` =  'PENDINGKEMSA'
OR  `transaction_type` =  'DELAYED'
)
AND MONTH(  `fp_date` ) =$month
AND YEAR(  `fp_date` ) =$year_from
GROUP BY fpcommodity_Id  ");
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		$arrayfp1 = array();
		$arraypending1 = array();
		foreach ($result as $value) {

			$arrayfp1[] = $value['fpcommodity_Id'];
			$arraypending1[] = (double)$value['sohpending'];
		}
if (count($arraypending1)==0) {
			$arraypending1[]=0;
			$arrayfp1[]=0;
		} 
		 $arraycombine = array_combine($arrayfp1, $arraypending1);
		//var_dump( $arraycombine);
		//var_dump( $arraypending1);
//exit;
		$basketpend = array_replace($arrayfpname, $arraycombine);

		foreach ($basketpend as $key => $val) {
			if (is_string($val)) {
				$basketpend[$key] = 0;
			}

		}

		$array_finalpend = array();
		foreach ($basketpend as $key => $val) {

			$array_finalpend[] = $basketpend[$key];

		}
		//var_dump($array_finalpsi);
		//var_dump($array_finalkemsa);
		//echo $array_finalkemsa = json_encode($array_finalkemsa);
		//echo $array_finalfp = json_encode($array_finalfp);
		//exit;
		//query for second graph pending
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute("SELECT SUM(  `fp_quantity` / fpcommodities.projected_monthly_c ) AS sohpsi,  `fpcommodity_Id` 
FROM pipeline, fpcommodities
WHERE pipeline.`fpcommodity_Id` = fpcommodities.id
AND  `transaction_type` =  'SOHPSI'
AND MONTH(  `fp_date` ) =$month
AND YEAR(  `fp_date` ) =$year_from
GROUP BY fpcommodity_Id  ");
		
		
		$result = $st -> fetchAll(PDO::FETCH_ASSOC);
		$arrayfp = array();
		$arraypending = array();
		
		foreach ($result as $value) {

			$arrayfp[] = $value['fpcommodity_Id'];
			$arraypending[] = (double)$value['sohpsi'];
		}
if (count($arraypending)==0) {
			$arraypending[]=0;
			$arrayfp[]=0;
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
		
		$array_finalkemsa = json_encode($array_finalkemsa);
		$array_finalfp = json_encode($array_finalfp);
		$array_finalpsi = json_encode($array_finalpsi);
		$array_finalpend = json_encode($array_finalpend);
		$data['array_finalpsi'] = $array_finalpsi;
		$data['array_finalkemsa'] = $array_finalkemsa;
		$data['array_finalpend'] = $array_finalpend;
		$data['arrayfpname'] = $array_finalfp;
		$this -> load -> view("ajax_view/kemsa_ajax_v", $data);

	}

}
