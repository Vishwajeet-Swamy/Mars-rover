<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spin_model extends CI_Model {

    public function spin_rover($direction,$instruction){

        switch ($instruction) {
            case 'L':
                return $this->left_to_right($direction);
                break;
            case 'R':
                return $this->right_to_left($direction);
                break;
        }
    }

    public function left_to_right($direction){

        switch ($direction) {
            case 'N':
                return 'W';
                break;
            case 'E':
                return 'N';
                break;
            case 'S':
                return 'E';
                break;
            case 'W':
                return 'S';
                break;    
        }
    }

    public function right_to_left($direction){

        switch ($direction) {
            case 'N':
                return 'E';
                break;
            case 'E':
                return 'S';
                break;
            case 'S':
                return 'W';
                break;
            case 'W':
                return 'N';
                break;    
        }
    }
	
}
