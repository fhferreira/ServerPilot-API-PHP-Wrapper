<?php

namespace ServerPilotAPI\Resources;

// load main Transport class for extending
require_once 'Resource.php';

// now use it
use ServerPilotAPI\Resources\Resource;

class Databases extends Resource
{
    protected function request($object_id=null, $data=array()) {
    	$path = '/dbs';
    	
    	if(!is_null($object_id)) {
	    	$path .= '/' . $object_id;
    	}
    
	    return parent::request($path, $data);
    }
    
	public function listAll($server_id=null, $app_id=null) {
		$results = $this->request();
		
		if(!is_null($server_id) || !is_null($app_id)) {
			foreach($results->data as $key => $result) {
				if((!is_null($server_id) && $result->serverid != $server_id) || (!is_null($app_id) && $result->appid != $app_id)) unset($results->data[$key]);
			}
		}
		
		return $results->data;
	}
}