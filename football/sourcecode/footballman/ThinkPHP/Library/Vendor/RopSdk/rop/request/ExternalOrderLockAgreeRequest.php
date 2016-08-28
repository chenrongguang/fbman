<?php
class ExternalOrderLockAgreeRequest
{
	private $ShipGUID;
	
	private $apiParas = array();
	
	public function setShipGUID($ShipGUID)
	{
		$this->ShipGUID = $ShipGUID;
		$this->apiParas["ShipGUID"] = $ShipGUID;
	}

	public function getShipGUID()
	{
		return $this->$ShipGUID;
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}
	
    public function getApiMethodName()
    {
        return "ruixue.external.order.lock.agree";
    }

	public function check()
	{
		
	}
}

	