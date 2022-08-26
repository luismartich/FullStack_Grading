<?php

  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
  }

  if (isset($_POST["len2"])) {
  	  $len = $_POST["len2"];
  	  for ($x = 1; $x <= $len; $x++) {
  		$a = "open_result".$x;
  		if (isset($_POST[$a])) {
 			$open_result2 = "open_result2";
 			$num2 = $x;
			$user2 = $_POST["user2"];
			$testname2 = $_POST["testname2"];
  			$data = array(
  				'open_result2' => $open_result2,
				'num2' => $num2,
				'user2' => $user2,
				'testname2' => $testname2,
  			); 
  			$fields = json_encode($data);
  			$dbURL = 'https://afsaccess4.njit.edu/~LAM62/front/front_back.php';
  			$ch = curl_init();
  			curl_setopt($ch, CURLOPT_URL, $dbURL);
  			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  			$resp = json_decode(curl_exec($ch));
  			curl_close($ch);
			$len = count($resp);
			$ansID = $resp[0];
			$user = $resp[1];
			$testName = $resp[2];
			
			if ($len == 15) {
				$final = [];	
				$c = 0;
				for ($x = 3; $x < $len; $x+=3) {   	//Iteration per question on exam
					$one = [];
					$two = [];
					$onequest = $resp[$x];			// question ID
					$weight = $resp[$x+1]; 			// question weight ***
					$Answer = $resp[$x+2]; 			// response ***
					$AnswerArr = explode(" ", $Answer);
					$index_answer = array_search('def',$AnswerArr) + 1;
					$FN = explode('(',$AnswerArr[$index_answer]);		// Submitted FN
					$FN_Answer = $FN[0];
					$data2 = array(
						'onequest' => $onequest,
					);
					$info = json_encode($data2);				
					$ch = curl_init();
					$dbURL = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
					curl_setopt($ch, CURLOPT_URL, $dbURL);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$resp2 = json_decode(curl_exec($ch),true);
					curl_close($ch);
					
					$arr1 = [];
					foreach ($resp2 as $i){						//for test case in question
						$myfile = fopen('test.py','w');
						$test_cases_arr = explode("=",$i);
						$test_case = $test_cases_arr[0];		//Test case
						$expected_output = $test_cases_arr[1];	//Expected test case output
						$z = $Answer . PHP_EOL . "print(".$test_case.")";
						fwrite($myfile, $z);
						fclose($myfile);
						$two[] = $test_case;					//---->Test Cases 
						$two[] = $expected_output;				//---->Test Cases expected output 
						$calc = ((80 / count($resp2)) / 100 ) * $weight; 
						$two[] = $calc;							//---->Weight of each test case

						$output = null;
						$retval = null;
						exec('python test.py', $output, $retval);
						if (strval(trim($output[0])) == strval(trim($expected_output))) {
							$two[] = True;						//---->Matched? 
							$two[] = $calc;						//---->test case grade 
							$two[] = trim($output[0]);
							$arr1[] = $calc;
						} else {
							$two[] = False;
							$two[] = 0;
							$two[] = trim($output[0]);
							$arr1[] = 0;
						}
					}
					$data3 = array(
						'onequest2' => $onequest,
					);
					$info2 = json_encode($data3);
					$ch2 = curl_init();
					curl_setopt($ch2, CURLOPT_URL, $dbURL);
					curl_setopt($ch2, CURLOPT_POSTFIELDS, $info2);
					curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
					$Question = array_values(get_object_vars(json_decode(curl_exec($ch2))));
					curl_close($ch2);

					$one[] = $Question[0];						//--->question
					$one[] = $Answer;							//--->answer 	
					$one[] = $weight;							//--->weight
					$resp_arr = explode(" ",$Question[0]); 
					$index = array_search('called',$resp_arr) + 1;
					$word = $resp_arr[$index];
					$one[] = $word;								//--->Correct Function Name
					$one[] = $FN_Answer;
					$item = 0.20 * $weight;	
					$one[] = $item;
					$arr2 = [];
					if (strpos($Answer, trim($word)) !== false) {
						$one[] = $item;				//--->Point for correct function name
						$arr2[] = $item;
					} else {
						$one[] = 0;
						$arr2[] = 0;
					}
					$final[] = $one;
					$final[] = $two;
					$c+=1;
				} 
				$final[] = $ansID;
				$final[] = "EXAM HAS BEEN GRADED";
			}
			
			
			
			
			
			
		}
  	}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
		body{ 
        font: 15px sans-serif; 
        text-align: center; 
        background: linear-gradient(120deg, #2980b9, #FFFAF0);
        height: 150vh;
      }
    
    .logout{
       position:fixed;
       right:10px;
       top:5px;
    }
    ul{
     top: 0;
     position:fixed;
     width: 100%;
     background: white;
     padding: 2px;
     box-shadow:0 0 10px gray;
   }
   
   ul h5{
     color: #2980b9;
     font-weight: 400;
   }
   h1, h2, h3, h5{
     color: white;
     font-weight: 500;
   }
   .form-group{
     color: #2980b9;
     font-weight: 500;
     text-align: center;
   }
   label{
     font-weight: 500;
     color: white;
   }
   .name {
      padding:8px 20px;
      width: 10%;
      height: 50px;
      border: 1px solid;
      background: #2691d9;
      border-radius: 25px;
      font-size:18px;
      color: #e9f4fb;
      font-weight: 700;
      cursor: pointer;
      outline:none;
  	  box-shadow:0 0 10px gray;
  	  margin-bottom:0px;
  	  margin-top:0px;
	}
    
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		border: 1px solid;
		width: 85%;
		float: left;
		margin:15px;
    box-shadow:0 0 10px gray;
    border-radius: 15px;
	}
  	th {
		background-color: #EDEDED;
		color: #2691d9;
		padding: 15px;
		text-align: left;
		border: 1px solid #2691d9;
		width:150px;
	}
	td {
		font-size: 20px;
		border: 1px solid #2691d9;
		text-align: left;
    background-color: #E8E8E8;		
	}
	
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	.forcedWidth{
		width:200px;
		word-wrap:break-word;
		display:inline-block;
	}
    </style>
</head>
<body><br>
	<ul class="nav navbar-light bg-light justify-content-center">
		<li class="nav-item">
			<a class="nav-link active" href='https://afsaccess4.njit.edu/~LAM62/front/student.php'><h5>Home</h5></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href='https://afsaccess4.njit.edu/~LAM62/front/student.php'><h5>Take Test</h5></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href='https://afsaccess4.njit.edu/~LAM62/front/studentresults.php'><h5>Results</h5></a>
		</li>
     <li class="nav item">
     <div class="logout">
       <a class="nav-link" href="logout.php"><h5>LOGOUT<h5></a>
       </div>
     </li>
	</ul>

<?php

$len = count($final);

echo "<br><br><br><br>";
if ( $len == 10 ) {
	$a = 1;
	$total2 = [];
	$ansID = $final[8];
	echo "<h1 style='text-align:left'> ".end($final)."</h1><br><br>";
	for ($x = 0; $x < $len-2; $x+=2) {
		$quest = $final[$x][0];
		$answ = $final[$x][1];
		$weight = $final[$x][2];
		$correctFN = $final[$x][3];
		$SubFN = $final[$x][4];
		$FNweight = $final[$x][5];
		$FNgrade = $final[$x][6];
		$total = [];		
		echo "<table>";
		
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Question ".$a."</th>"; 
		echo "<td colspan='7'>".$quest."</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Answer</th>";
		echo "<td colspan='7'>".$answ."</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Question Weight</th>";
		echo "<td colspan='7'>".$weight." / 100</td>";
		echo "</tr>";
   
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Check Answers</th>";
		echo "<td>Test Case</td>";
		echo "<td>Expected</td>";
		echo "<td>Output</td>";
		echo "<td>Check</td>";
		echo "<td>Score</td>";
		echo "<td>Comment</td>";
		echo "</tr>";
			
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Function Name</th>";
		echo "<td>Check Name</td>";
		echo "<td>".$correctFN." </td>";
		echo "<td>".$SubFN."</td>";
		
		$DB = array(
				'ansID3' => $ansID,
				'a' => ($a-1),
		); 
		$DBfields = json_encode($DB);
		$dbURL = 'https://afsaccess4.njit.edu/~LAM62/front/front_back.php';
		$ch0 = curl_init();
		curl_setopt($ch0, CURLOPT_URL, $dbURL);
		curl_setopt($ch0, CURLOPT_POSTFIELDS, $DBfields);
		curl_setopt($ch0, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch0, CURLOPT_RETURNTRANSFER, 1);
		$DBinfo = json_decode(curl_exec($ch0));
		curl_close($ch0);
		
		
		if ( $FNgrade > 1 ) {
			echo "<td style='width:5%' ><span>&#10003;</span> </td>";
			echo "<td style='width:5%' >".$DBinfo[0]." / ".$FNweight."</td>";
			$total[] = $FNgrade;
		} else {
			echo "<td style='width:5%' ><span>&#10008;</span> </td>";
			echo "<td style='width:5%' >".$DBinfo[0]." / ".$FNweight."</td>";
		}
		echo "<td style='width:10%' >".$DBinfo[1]."</td>";
		echo "</tr>";	
		
		$b = 1;
		for ($y = 0; $y < count($final[$x+1]); $y+=6) {
			echo "<tr>";
			echo "<th style='background-color: #FFFFFF'>Test Case ".($b)."</th>";
			echo "<td>".$final[$x+1][$y]."</td>";
			echo "<td>".$final[$x+1][$y+1]."</td>";
			echo "<td>".$final[$x+1][$y+5]."</td>";
			if ( $final[$x+1][$y+3] == 1 ) {
				echo "<td style='width:5%' ><span>&#10003;</span> </td>";
				echo "<td style='width:5%' >".round($DBinfo[$b+1],1)." / ".round($final[$x+1][$y+2],1)."</td>";
				$total[] = $final[$x+1][$y+4];
			} else {
				echo "<td style='width:5%' ><span>&#10008;</span> </td>";
				echo "<td style='width:5%' >".round($DBinfo[$b+1],1)." / ".round($final[$x+1][$y+2],1)."</td>";
			}
			echo "<td style='width:15%' >".$DBinfo[$b+2]."</td>";
			echo "</tr>";
			$b+=1;
		}
		echo "<th style='background-color: #FFFFFF'>Total Score</th><td></td><td></td><td></td><td></td><td>".round(array_sum($total))."/".$weight."</td><td></td>";
		echo "</tr>";
		echo "</table>";
		$total2[]=array_sum($total);
		$a+=1;
	}
	echo "<br><h3>Total Score: ".array_sum($total2)."/100</h3><br>";	














} else {
	print_r(count($final));
}

?>
	<br><br>
</body>
</html>