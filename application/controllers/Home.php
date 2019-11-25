<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->model(array('Spin_model','Move_model'));
		
	}

	public function index()
	{
		$this->load->view('home_view');
	}

	public function input_data(){

		$plateauInput = $_REQUEST['platue'];
		$roverInput = $_REQUEST['rover'];
		$movementInput = strtoupper ($_REQUEST['rotations']);

		$plateauInput_array = explode(' ',$plateauInput);
		if(count($plateauInput_array) == 2){
			$platue_position = array('PX'=>$plateauInput_array[0], 'PY'=>$plateauInput_array[1]);
		}else{
			echo "Please provide (X Y) co-ordinates with a space seprating X and Y value Ex:5 5";die;
		}
		

		$position_array = explode(' ',$roverInput);
		if(count($position_array) == 3){
			$position = array('X'=>$position_array[0], 'Y'=>$position_array[1]);
		}else{
			echo "Please provide (X Y) co-ordinates with a space seprating X and Y value along with direction Ex:1 2 N";die;
		}

		$direction = strtoupper($position_array[2]);
		$dir_arr = array('N','E','W','S');
		if(!in_array($direction,$dir_arr)){
			echo "Direction must be N or E or W or S. Check Rover Data";die;
		}
		
		$instruction = $movementInput;
		

		if(($position['X']<=$platue_position['PX']) && ($position['Y']<=$platue_position['PY'])){
			$this->action_rover($position,$direction,$instruction);
		}else{
			echo "Co-ordinates are out of range";die;
		}
		

	}

	public function action_rover($position,$direction,$instruction){
		$result = "";
		$instruction_array = str_split($instruction, 1);
		foreach($instruction_array as $spin_move){
			$allowed_spin_movements = array('L','R','M');
			if(!in_array($spin_move,$allowed_spin_movements)){
				echo "L M R are the only allowed movements. Please check Rover rotations";
			}
			switch ($spin_move) {
				case 'L':
					$direction = $this->Spin_model->spin_rover($direction,$spin_move);
					$result = implode(" ",$position)." ".$direction;
					break;
				case 'R':
					$direction = $this->Spin_model->spin_rover($direction,$spin_move);
					$result = implode(" ",$position)." ".$direction;
					break;
				case 'M':
					$result = $this->Move_model->move_rover($position,$direction);
					$new_position = explode(" ",$result);
					$position = array('X'=>$new_position[0], 'Y'=>$new_position[1]);
					$direction = $new_position[2];
					break; 
			}
			
		}

		echo $result;

	}
}
