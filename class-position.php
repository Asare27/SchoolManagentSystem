<?php
class ClassPosition{
	var $_position;
	var $_Position_Ends;
	
	public function setClassPosition($batchid,$totalscore){
@$score=array();
		include("dbstring.php");
		$_SQL=mysqli_query($con,"SELECT  SUM(mk.mark) AS TotalMark FROM tblmark mk 
		INNER JOIN tblsystemuser su ON mk.userid=su.userid
		INNER JOIN tblsubjectassignment sa ON mk.assignmentid=sa.assignmentid
		WHERE sa.batchid='$batchid' AND su.systemtype='Student' GROUP BY su.userid");
		
		$count=mysqli_num_rows($_SQL);
		$k=0;
		while($row=mysqli_fetch_array($_SQL,MYSQLI_ASSOC)){
			$score[$k]=$row['TotalMark'];
			//echo $score[$k]."<br/>";
			$k++;
		}

//Sorting in Ascending order
		@$_Temp=0;
		$count=count($score);
		for($j=0;$j<$count;$j++)
		{
			for($i=0;$i<$count;$i++)
			{
				if($score[$j]>$score[$i])
				{
				$_Temp=$score[$j];
				$score[$j]=$score[$i];
				$score[$i]=$_Temp;
				}
		  }
		}
		

		for($t=0;$t<$count;$t++){
			//echo $score[$t]." ". ($t+1) ."<br/>";
			if($totalscore==$score[$t]){
				$this->_position=($t+1);

				$_final_position=$this->_position;
				switch ($_final_position) 
				{
					case '1':
						$this->_Position_Ends ="1st";
						return $this->_Position_Ends;
						break;
					case '2':
						$this->_Position_Ends="2nd";
						return $this->_Position_Ends;
						break;
					case '3':
						$this->_Position_Ends="3rd";
						return $this->_Position_Ends;
						break;

					case '4':
						$this->_Position_Ends="4th";
						return $this->_Position_Ends;
						break;

					case '5':
						$this->_Position_Ends="5th";
						return $this->_Position_Ends;
						break;

					case '6':
						$this->_Position_Ends="6th";
						return $this->_Position_Ends;
						break;

					case '7':
						$this->_Position_Ends="7th";
						return $this->_Position_Ends;
						break;

					case '8':
						$this->_Position_Ends="8th";
						return $this->_Position_Ends;
						break;

					case '9':
						$this->_Position_Ends="9th";
						return $this->_Position_Ends;
						break;

					case '10':
						$this->_Position_Ends="10th";
						return $this->_Position_Ends;
						break;

					case '11':
						$this->_Position_Ends="11th";
						return $this->_Position_Ends;
						break;

					case '12':
						$this->_Position_Ends="12th";
						return $this->_Position_Ends;
						break;

					case '13':
						$this->_Position_Ends="13th";
						return $this->_Position_Ends;
						break;

					case '14':
						$this->_Position_Ends="14th";
						return $this->_Position_Ends;
						break;

					case '15':
						$this->_Position_Ends="15th";
						return $this->_Position_Ends;
						break;

					case '16':
						$this->_Position_Ends="16th";
						return $this->_Position_Ends;
						break;

					case '17':
						$this->_Position_Ends="17th";
						return $this->_Position_Ends;
						break;

					case '18':
						$this->_Position_Ends="18th";
						return $this->_Position_Ends;
						break;

					case '19':
						$this->_Position_Ends="19th";
						return $this->_Position_Ends;
						break;

					case '20':
						$this->_Position_Ends="20th";
						return $this->_Position_Ends;
						break;

					case '21':
						$this->_Position_Ends="21st";
						return $this->_Position_Ends;
						break;

					case '22':
						$this->_Position_Ends="22nd";
						return $this->_Position_Ends;
						break;

					case '23':
						$this->_Position_Ends="23rd";
						return $this->_Position_Ends;
						break;

					case '24':
						$this->_Position_Ends="24th";
						return $this->_Position_Ends;
						break;

					case '25':
						$this->_Position_Ends="25th";
						return $this->_Position_Ends;
						break;

					case '26':
						$this->_Position_Ends="26th";
						return $this->_Position_Ends;
						break;

					case '27':
						$this->_Position_Ends="27th";
						return $this->_Position_Ends;
						break;

					case '28':
						$this->_Position_Ends="28th";
						return $this->_Position_Ends;
						break;

					case '29':
						$this->_Position_Ends="29th";
						return $this->_Position_Ends;
						break;

					case '30':
						$this->_Position_Ends="30th";
						return $this->_Position_Ends;
						break;

					case '31':
						$this->_Position_Ends="31st";
						return $this->_Position_Ends;
						break;

					case '32':
						$this->_Position_Ends="32nd";
						return $this->_Position_Ends;
						break;


					case '33':
						$this->_Position_Ends="33rd";
						return $this->_Position_Ends;
						break;

					case '34':
						$this->_Position_Ends="34th";
						return $this->_Position_Ends;
						break;

					case '35':
						$this->_Position_Ends="35th";
						return $this->_Position_Ends;
						break;

					case '36':
						$this->_Position_Ends="36th";
						return $this->_Position_Ends;
						break;

					case '37':
						$this->_Position_Ends="37th";
						return $this->_Position_Ends;
						break;

					case '38':
						$this->_Position_Ends="38th";
						return $this->_Position_Ends;
						break;

					case '39':
						$this->_Position_Ends="39th";
						return $this->_Position_Ends;
						break;

					case '40':
						$this->_Position_Ends="40th";
						return $this->_Position_Ends;
						break;

					case '41':
						$this->_Position_Ends="41st";
						return $this->_Position_Ends;
						break;

					case '42':
						$this->_Position_Ends="42nd";
						return $this->_Position_Ends;
						break;

					case '43':
						$this->_Position_Ends="43rd";
						return $this->_Position_Ends;
						break;

					case '44':
						$this->_Position_Ends="44th";
						return $this->_Position_Ends;
						break;

					case '45':
						$this->_Position_Ends="45th";
						return $this->_Position_Ends;
						break;

					case '46':
						$this->_Position_Ends="46th";
						return $this->_Position_Ends;
						break;

					case '47':
						$this->_Position_Ends="47th";
						return $this->_Position_Ends;
						break;

					case '48':
						$this->_Position_Ends="48th";
						return $this->_Position_Ends;
						break;

					case '49':
						$this->_Position_Ends="49th";
						return $this->_Position_Ends;
						break;

					case '50':
						$this->_Position_Ends="50th";
						return $this->_Position_Ends;
						break;

					case '51':
						$this->_Position_Ends="51st";
						return $this->_Position_Ends;
						break;

					case '52':
						$this->_Position_Ends="52nd";
						return $this->_Position_Ends;
						break;

					case '53':
						$this->_Position_Ends="53rd";
						return $this->_Position_Ends;
						break;

					case '54':
						$this->_Position_Ends="54th";
						return $this->_Position_Ends;
						break;

					case '55':
						$this->_Position_Ends="55th";
						return $this->_Position_Ends;
						break;

					case '56':
						$this->_Position_Ends="56th";
						return $this->_Position_Ends;
						break;

					case '57':
						$this->_Position_Ends="57th";
						return $this->_Position_Ends;
						break;

					case '58':
						$this->_Position_Ends="58th";
						return $this->_Position_Ends;
						break;

					case '59':
						$this->_Position_Ends="59th";
						return $this->_Position_Ends;
						break;

					case '60':
						$this->_Position_Ends="60th";
						return $this->_Position_Ends;
						break;

					case '61':
						$this->_Position_Ends="61st";
						return $this->_Position_Ends;
						break;

					case '62':
						$this->_Position_Ends="62nd";
						return $this->_Position_Ends;
						break;

					case '63':
						$this->_Position_Ends="63rd";
						return $this->_Position_Ends;
						break;

					case '64':
						$this->_Position_Ends="64th";
						return $this->_Position_Ends;
						break;

					case '65':
						$this->_Position_Ends="65th";
						return $this->_Position_Ends;
						break;

					case '66':
						$this->_Position_Ends="66th";
						return $this->_Position_Ends;
						break;

					case '67':
						$this->_Position_Ends="67th";
						return $this->_Position_Ends;
						break;

					case '68':
						$this->_Position_Ends="68th";
						return $this->_Position_Ends;
						break;

					case '69':
						$this->_Position_Ends="69th";
						return $this->_Position_Ends;
						break;

					case '70':
						$this->_Position_Ends="70th";
						return $this->_Position_Ends;
						break;

					case '71':
						$this->_Position_Ends="71st";
						return $this->_Position_Ends;
						break;

					case '72':
						$this->_Position_Ends="72nd";
						return $this->_Position_Ends;
						break;

					case '73':
						$this->_Position_Ends="73rd";
						return $this->_Position_Ends;
						break;

					case '74':
						$this->_Position_Ends="74th";
						return $this->_Position_Ends;
						break;

					case '75':
						$this->_Position_Ends="75th";
						return $this->_Position_Ends;
						break;

					case '76':
						$this->_Position_Ends="76th";
						return $this->_Position_Ends;
						break;

					case '77':
						$this->_Position_Ends="77th";
						return $this->_Position_Ends;
						break;

					case '78':
						$this->_Position_Ends="78th";
						return $this->_Position_Ends;
						break;

					case '79':
						$this->_Position_Ends="79th";
						return $this->_Position_Ends;
						break;

					case '80':
						$this->_Position_Ends="80th";
						return $this->_Position_Ends;
						break;

					case '81':
						$this->_Position_Ends="81st";
						return $this->_Position_Ends;
						break;

					case '82':
						$this->_Position_Ends="82nd";
						return $this->_Position_Ends;
						break;

					case '83':
						$this->_Position_Ends="83rd";
						return $this->_Position_Ends;
						break;

					case '84':
						$this->_Position_Ends="84th";
						return $this->_Position_Ends;
						break;

					case '85':
						$this->_Position_Ends="85th";
						return $this->_Position_Ends;
						break;

					case '86':
						$this->_Position_Ends="86th";
						return $this->_Position_Ends;
						break;

					case '87':
						$this->_Position_Ends="87th";
						return $this->_Position_Ends;
						break;

					case '88':
						$this->_Position_Ends="88th";
						return $this->_Position_Ends;
						break;

					case '89':
						$this->_Position_Ends="88th";
						return $this->_Position_Ends;
						break;

					case '90':
						$this->_Position_Ends="90th";
						return $this->_Position_Ends;
						break;

					case '91':
						$this->_Position_Ends="91st";
						return $this->_Position_Ends;
						break;

					case '92':
						$this->_Position_Ends="92nd";
						return $this->_Position_Ends;
						break;

					case '93':
						$this->_Position_Ends="93rd";
						return $this->_Position_Ends;
						break;

					case '94':
						$this->_Position_Ends="94th";
						return $this->_Position_Ends;
						break;

					case '95':
						$this->_Position_Ends="95th";
						return $this->_Position_Ends;
						break;

					case '96':
						$this->_Position_Ends="96th";
						return $this->_Position_Ends;
						break;

					case '97':
						$this->_Position_Ends="97th";
						return $this->_Position_Ends;
						break;

					case '98':
						$this->_Position_Ends="98th";
						return $this->_Position_Ends;
						break;

					case '99':
						$this->_Position_Ends="99th";
						return $this->_Position_Ends;
						break;

					case '100':
						$this->_Position_Ends="100th";
						return $this->_Position_Ends;
						break;


					default:
						$this->_Position_Ends="0th";
						return $this->_Position_Ends;
						break;
				}
				//**************************************
			}
			
		}

	}
	public function getClassPosition(){
		return $this->_Position_Ends;
	}
}
?>