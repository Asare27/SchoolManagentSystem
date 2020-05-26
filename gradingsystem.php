<?php
class GradingSystem
{
	var $_Grade="";
	public function setMark($mark)
	{
		if($mark>=80 && $mark<=100){
			$this->_Grade="A1";
		}
		else if($mark>=70 && $mark<=79){
			$this->_Grade="B2";
		}
		else if($mark>=65 && $mark<=69){
			$this->_Grade="B3";
		}
		else if($mark>=60 && $mark<=64){
			$this->_Grade="C4";
		}
		else if($mark>=55 && $mark<=59){
			$this->_Grade="C5";
		}
		else if($mark>=50 && $mark<=54){
			$this->_Grade="C6";
		}
		else if($mark>=45 && $mark<=49){
			$this->_Grade="D7";
		}
		else if($mark>=40 && $mark<=44){
			$this->_Grade="E8";
		}
		else if($mark>=0 && $mark<=39){
			$this->_Grade="F9";
		}
	}
	public function getMark()
	{
		return $this->_Grade;		
	}
}
?>
