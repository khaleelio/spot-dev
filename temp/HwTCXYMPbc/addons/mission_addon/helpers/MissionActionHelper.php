<?php

namespace App\Http\Helpers;

use App\Mission;

class MissionActionHelper{

    private $actions;
	public function __construct() {
		$this->actions = array();
	}

    public function get($status,$type=null)
    {
        if($status == Mission::REQUESTED_STATUS)
        {
                return $this->requested();
        }elseif($status == Mission::APPROVED_STATUS)
        {
            return $this->accepted();
        }elseif($status == Mission::CLOSED_STATUS)
        {
            return $this->closed();
        }elseif($status == Mission::RECIVED_STATUS)
        {
            return $this->received();
        }elseif($status == Mission::DONE_STATUS)
        {
            return $this->done();
        }else
        {
            return $this->default();
        }
    }


    private function requested()
    {
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Approve & Assign');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.shipments.action.approve',['to'=>Mission::APPROVED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['js_function_caller'] = 'openCaptainModel(this,event)';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;
            
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Reject');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::CLOSED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;

            return $this->actions;
    }

    private function requestedPickup()
    {

            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Approve');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::APPROVED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;
            
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Reject');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::CLOSED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;

            

            return $this->actions;
    }

    private function done()
    {
            
            
            

            return $this->actions;
    }

    private function accepted()
    {
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Reject');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::CLOSED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;

            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Receive Manifest');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::RECIVED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;
            
            return $this->actions;
    }

    private function received()
    {
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Confirm Manifest / Done');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::DONE_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;
            
            return $this->actions;
    }

    private function closed()
    {
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = translate('Approve');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::APPROVED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['index'] = true;
            return $this->actions;
    }

    private function default()
    {
           
            return $this->actions;
    }
}