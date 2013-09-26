<?php
class Settings extends MY_Controller {

function __construct() {
	parent::__construct();
	$this -> load -> helper(array('form', 'url' ));
}

public function index() {
			
			$this -> settings_home();			}
			
			
public function settings_home() {

		
		$data['title'] = "Settings";
		$data['content_view'] = "settings_home_v";
		$data['banner_text'] = "Settings";
		$data['kemsa_psi'] = Pipeline::kemsa_psi();
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		
		$this -> load -> view("template", $data);
	}




public function supply_plan_s()
{
		
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['supplyplan'] = Pipeline::getall_supply_plan();
		$this -> load -> view("ajax_view/supplyplan_settings", $data);
			
}

public function fpcommodity_s()
{
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$this -> load -> view("ajax_view/fp_settings", $data);
			
}

public function edit_transaction($trid) {
		
		$data['content_view'] = "ajax_view/editsettings_v";
		$data['title'] = "Edit";
		$data['banner_text'] = "Edit Supply Plan";
		$data['editdata'] = Pipeline::getAll_edit($trid);
		$data['fundingsource'] = Funding_source::getAllfpfundingsources();
		$this -> load -> view("template", $data);
		

	}

public function delete_transaction($trid) {
		
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute(" DELETE FROM  `drh`.`pipeline` WHERE  `pipeline`.`id` =$trid; ");
		$this->session->set_flashdata('system_error_message', "Record Deleted");
		redirect('settings');
		

	}
	public function update_transaction() {
		$trid=$_POST['trid'];
		$FSource=$_POST['FSource'];		
	    $Quantityexp=$_POST['Quantityexp'];
		$Dateexp=$_POST['Dateexp'];
		$date=date('y-m-d',strtotime($Dateexp));
		
		
				
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute(" UPDATE  `drh`.`pipeline` SET  `funding_source` =  '$FSource', `fp_quantity` =  '$Quantityexp', `fp_date` =  '$date' WHERE  `pipeline`.`id` =$trid; ");
		
			
		$this->session->set_flashdata('system_success_message', "Record Updated");
		redirect('settings');

	}
public function edit_fptransaction($fpid) {
		
		$data['content_view'] = "ajax_view/fpsettings_v";
		$data['title'] = "Edit";
		$data['banner_text'] = "Edit Supply Plan";
		$data['fpcommodity'] = Fpcommodities::getAllfpcommodities();
		$data['editdata'] = Fpcommodities::getAll_edit($fpid);
		$data['fundingsource'] = Funding_source::getAllfpfundingsources();
		$this -> load -> view("template", $data);
		

	}

public function update_fptransaction() {
		$fpcommodity=$_POST['fpcommodityid'];	
	    $unit=$_POST['unit'];	
		$description=$_POST['Description'];		
	    $KEMSA=$_POST['KEMSA'];
		$PSI=$_POST['PSI'];
		$Date_of=$_POST['Date_of'];
		$ddate=date('y-m-d',strtotime($Date_of));
		
			//exit;	
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute( " UPDATE  `drh`.`fpcommodities` SET  `Description` = '$description',
		`Unit`='$unit' ,`projected_monthly_c` = '$KEMSA', `projected_psi` = '$PSI' WHERE  `fpcommodities`.`id` ='$fpcommodity'; ");
		
		$this->session->set_flashdata('system_success_message', "You edited $description ");
		redirect('settings');

	}


public function delete_fptransaction($fpid) {
		
		$con = Doctrine_Manager::getInstance() -> connection();
		$st = $con -> execute(" DELETE FROM  `drh`.`fpcommodities` WHERE  `fpcommodities`.`id` =$fpid; ");
		$this->session->set_flashdata('system_error_message', "Record Deleted");
		redirect('settings');
		

	}
public function soh_s()
{
		$data['soh'] = Pipeline::getall_soh();
		$this -> load -> view("ajax_view/soh_settings_v", $data);
			
}

	}
	