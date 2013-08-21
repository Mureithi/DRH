<?php
class Stocks_management extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
	}

	public function index() {
		$data['title'] = "Stocks";
		$data['content_view'] = "stocks_home_v";
		$data['banner_text'] = "Stocks";
		$data['stock_entry'] = Fpcommodities::getAllfpcommodities();
		$this -> load -> view("template", $data);
	}

	public function submit_stock_status() {

		$fpid = $_POST['fpid'];
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

			$con = Doctrine_Manager::getInstance() -> connection();
			$st = $con -> execute("SELECT fpcommodities.fp_name, SUM( pipeline_management.`pending` ) / fpcommodities.projected_monthly_c AS pending, SUM( pipeline_management.`received` ) / fpcommodities.projected_monthly_c AS received, SUM( pipeline_management.`delayed` ) / fpcommodities.projected_monthly_c AS delays
			FROM  `pipeline_management` , fpcommodities
			WHERE fpcommodities.id = pipeline_management.`fpcommodity_Id`
			GROUP BY fpcommodities.fp_name ");
			$result = $st -> fetchAll(PDO::FETCH_ASSOC);
			$arrayfp = array();
			$arraypending = array();
			$arraydelayed = array();
			$arrayreceived = array();
			foreach ($result as $value) {

			$arrayfp[] = $value['fp_name'];
			$arraypending[] = (double)$value['pending'];
			$arraydelayed[] = (double)$value['received'];
			$arrayreceived[] = (double)$value['delays'];

			}

			$arrayfp = json_encode($arrayfp);
			$arraypending = json_encode($arraypending);
			$arraydelayed = json_encode($arraydelayed);
			$arrayreceived = json_encode($arrayreceived);

			$data['title'] = "Pipeline";
			$data['content_view'] = "pipeline_home_v";
			$data['banner_text'] = "Pipeline Management";
			$data['arrayfp'] = $arrayfp;
			$data['arraypending'] = $arraypending;
			$data['arraydelayed'] = $arraydelayed;
			$data['arrayreceived'] = $arrayreceived;
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

	public function pipeline_chart() {
		
		//$pipecommodity = $_POST['pipecommodity'];
		$strXML = "<chart caption='Expected Months of Stock (M.O.S) for Male Condoms' yAxisName='Months of Stock (M.O.S)' bgColor='FFFFFF' labelPadding ='10' yAxisValuesPadding ='10' showValues='1' rotateValues='0'  valuePosition='Below' >
<categories>

        <category label='July' />

        <category label='Aug' />

        <category label='Sept' />

        <category label='Oct' />

        <category label='Nov' />

        <category label='Dec' />
        
        <category label='Jan' />

        <category label='Feb' />

        <category label='Mar' />

        <category label='Apr' />

        <category label='May' />
        
        <category label='Jun' />

    </categories>
    
 <dataset seriesName='Actual MOS' color='A66EDD' >
<set  value='5' />
<set  value='3' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />

</dataset>

<dataset seriesName='Available/Expected MOS' color='F6BD0F'>
<set value='0' />
<set  value='0' />
<set  value='5.0457' />
<set value='4.0457' />
<set  value='3.0457' />
<set  value='8.914' />
<set  value='7.914' />
<set  value='6.914' />
<set  value='10.9842' />
<set  value='9.9842' />
<set  value='8.9842' />
<set  value='10.6661' />

</dataset>
</chart>";
		echo $strXML;
	}
	
	public function pipeline_chart1() {
		
		//$pipecommodity = $_POST['pipecommodity'];
		$strXML = "<chart caption='Months of Stock (M.O.S) Injectables' yAxisName='Months of Stock (M.O.S)' bgColor='FFFFFF'  labelPadding ='10' yAxisValuesPadding ='10' showValues='1' rotateValues='0'  valuePosition='Below' >
<categories>

        <category label='July' />

        <category label='Aug' />

        <category label='Sept' />

        <category label='Oct' />

        <category label='Nov' />

        <category label='Dec' />
        
        <category label='Jan' />

        <category label='Feb' />

        <category label='Mar' />

        <category label='Apr' />

        <category label='May' />
        
        <category label='Jun' />

    </categories>
    
 <dataset seriesName='Actual MOS' color='A66EDD' >
<set  value='2' />
<set  value='1' />
<set  value='5' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />
<set  value='' />

</dataset>

<dataset seriesName='Available/Expected MOS' color='F6BD0F'>
<set value='2' />
<set  value='1' />
<set  value='4' />
<set value='3' />
<set  value='2' />
<set  value='1' />
<set  value='5' />
<set  value='4' />
<set  value='3' />
<set  value='2' />
<set  value='1' />
<set  value='3' />

</dataset>
</chart>";
		echo $strXML;
	}
	
	public function loadgraph()
{
$this->load->view("ajax_view/pipeline_ajax_v" );
	}

	public function getmonths()
	{
	//create array to carry months
	$montharray = array(
	7 => 'July',
	8 => 'August',
	9 => 'September',
	10 => 'October',
	11 => 'November',
	12 => 'December',
	1 => 'January',
	2 => 'Febuary',
	3 => 'March',
	4 => 'April',
	5 => 'May',
	6 => 'June'
	);
	//query db for data
	$con = Doctrine_Manager::getInstance() -> connection();
	$st = $con -> execute("SELECT *
	FROM (

	SELECT CASE
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
	var_dump($arraycombined);
	echo '</br></br>';
	var_dump($montharray);
	echo '</br></br>';
	//clean the combined array
	$basket = array_replace($montharray, $arraycombined);
	var_dump($basket);
	echo '</br></br>';
	//loop through to replace string values in array with int
	foreach($basket as $key => $val)
	{
	if (is_string($val)) {
	$basket[$key] = 0;
	}

	}
	var_dump($basket);
	echo '</br></br>';
	$arrayfinal=array_combine($montharray, $basket);
	var_dump($arrayfinal);
	}

	}
	