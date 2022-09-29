<?php
/**
 * Addr Absolute Component
 * 
 * @author Jay Bansal
 * @licence MIT
 */

abstract class Addr_Comp {
    
    public $data = array();
    
    function add($b, $arr){
	$return = $this->behaviour($b, $arr);

	if(!$return){
	    return "None to be added";
	}

	return true;
    }
    
    function behaviour($b, $arr){
	if ($b === false) {
	    $b = $this->data;
	}
	foreach ($arr as $value) {
	    if (empty($b[$value])) {
		self::throwError('b is invalid');
	    }
	}
    }
    
    function __call($name, $arguments) {
	if (!in_array($name, array_keys($arguments))) {
	    throw new Exception();
	}

	array_unshift($arguments, $name);

	return call_user_func($name, $arguments);
    }

    function __set($name, $value) {
	if(method_exists(array($this, $name))){
            $this->$name($value); 
        }else{
            $this->data[$name] = $value; //create new set data[key] = value without seeters;
        }
    }
    
    function __get($name) {
	return $this->data[$name];
    }

    function get_domain($name){
	$name = $_POST ["name"];

	if (!preg_match ("/^[0-9]*$/", $name) ){  
	    $DomainErr = "Domain is invalid.";  
	echo $DomainErr;
	} else {  
	    echo $DomainErr;
	}
    }
    
    function translate_to_required(){
	//left blank
    }
    
    function export_behaviour(){
	//left blank
    }
}