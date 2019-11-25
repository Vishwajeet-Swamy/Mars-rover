<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Move_model extends CI_Model {

    public function move_rover($position,$spin){
        switch ($spin) {
            case 'N':
                return $this->move_along_Y($position,$spin);
                break;
            case 'E':
                return $this->move_along_X($position,$spin);
                break;
            case 'S':
                return $this->move_along_Y($position,$spin);
                break;
            case 'W':
                return $this->move_along_X($position,$spin);
                break;    
        }
    }

    Public function move_along_Y($position,$spin){
        if($spin == 'N'){
            $position['Y']=$position['Y']+1;
            $new_position = implode(' ',$position);
            return $new_position." ".$spin;
        }else if($spin == 'S'){
            $position['Y']=$position['Y']-1;
            $new_position = implode(' ',$position);
            return $new_position." ".$spin;
        }
    }

    Public function move_along_X($position,$spin){
        if($spin == 'E'){
            $position['X']=$position['X']+1;
            $new_position = implode(' ',$position);
            return $new_position." ".$spin;
        }else if($spin == 'W'){
            $position['X']=$position['X']-1;
            $new_position = implode(' ',$position);
            return $new_position." ".$spin;
        }
    }
	
}
