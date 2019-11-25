<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testunit extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
        $this->load->model(array('Spin_model','Move_model'));
        $this->load->library("unit_test");
		
	}

	public function index()
	{
        $test = $this->action_rover(array('X'=>1,'Y'=>2),'N','LMLMLMLMM');
		$expected_result = '1 3 N';
        $test_name = 'Mars rover';
        echo $this->unit->run($test, $expected_result, $test_name);

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

		return $result;

	}
}
