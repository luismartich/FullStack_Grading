<?php

  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
  }

  if (isset($_POST["len"])) {
  	  $len = $_POST["len"];
  	  for ($x = 1; $x <= $len; $x++) {
  		$a = "open_result".$x;
  		if (isset($_POST[$a])) {
 			$open_result = "open_result";
 			$num = $x;
			$user = $_POST["user"];
			$testname = $_POST["testname"];
  			$data = array(
 				'open_result' => $open_result,
 				'num' => $num,
				'user' => $user,
				'testname' => $testname,
  			); 
  			
  			$fields = json_encode($data);
  			$dbURL = 'https://afsaccess4.njit.edu/~sh363/front_back.php';
  			$ch = curl_init();
  			curl_setopt($ch, CURLOPT_URL, $dbURL);
  			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  			$resp = json_decode(curl_exec($ch));
  			curl_close($ch);
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
    padding: 12px;	
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
	<ul class="nav justify-content-center">
		<li class="nav-item">
			<div class="navit">
				<a class="nav-link active" href='https://afsaccess4.njit.edu/~LAM62/front/professor.php'><h5>Home</h5></a>
			</div>
		</li>
		<li class="nav-item">
			<div class="navit">
				<a class="nav-link" href='https://afsaccess4.njit.edu/~LAM62/front/maker.php'><h5>Create Exam</h5></a>
			</div>
		</li>
		<li class="nav-item">
			<div class="navit">
				<a class="nav-link" href='https://afsaccess4.njit.edu/~LAM62/front/result.php'><h5>Results</h5></a>
			</div>
		</li>
		<li class="nav item">
			<div class="logout">
				<a class="nav-link" href="logout.php"><h5>LOGOUT<h5></a>
			</div>
		</li>
	</ul>
<?php

$len = count($resp);

echo "<br><br><br><br>";
if ( $len == 10 ) {
	$a = 1;
	$total2 = [];
	echo "<h1 style='text-align:left'> ".$testname. " - " .end($resp)."</h1><br><br>";
	echo "<form class='form-horizontal' action='https://afsaccess4.njit.edu/~LAM62/front/front_back.php', method='post'>";
	echo "<input type='hidden' id='ansID2' name='ansID2' value=".$resp[8].">";
	for ($x = 0; $x < $len-2; $x+=2) {
		$quest = $resp[$x][0];
		$answ = $resp[$x][1];
		$weight = $resp[$x][2];
		$correctFN = $resp[$x][3];
		$SubFN = $resp[$x][4];
		$FNweight = $resp[$x][5];
		$FNgrade = $resp[$x][6];
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
    echo "<td>Overwrite</td>";
		echo "<td>Comment</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Function Name</th>";
    echo "<td>Check Name</td>";
		echo "<td>".$correctFN." </td>";
    echo "<td>".$SubFN."</td>";
		if ( $FNgrade > 1 ) {
			echo "<td style='width:5%' ><span>&#10003;</span> </td>";
			echo "<td style='width:5%' >".$FNgrade." / ".$FNweight."</td>";
			$total[] = $FNgrade;
			echo "<td><input type='number' id='FNgrade".$a."' name='FNgrade".$a."' style='width: 6em' placeholder='Overwrite'></td>";
			echo "<td><input type='text' id='FNcomment".$a."' name='FNcomment".$a."' style='width: 16em' placeholder='Comment'></td>";
		} else {
			echo "<td style='width:5%' ><span>&#10008;</span> </td>";
			echo "<td style='width:5%' >".$FNgrade." / ".$FNweight."</td>";
			echo "<td><input type='number' id='FNgrade".$a."' name='FNgrade".$a."' style='width: 6em' placeholder='Overwrite'></td>";
			echo "<td><input type='text' id='FNcomment".$a."' name='FNcomment".$a."' style='width: 16em' placeholder='Comment'></td>";
		}
		echo "</tr>";	
		
		$b = 1;
		for ($y = 0; $y < count($resp[$x+1]); $y+=6) {
			echo "<tr>";
			echo "<th style='background-color: #FFFFFF'>Test Case ".($b)."</th>";
			echo "<td>".$resp[$x+1][$y]."</td>";
      echo "<td>".$resp[$x+1][$y+1]."</td>";
      echo "<td>".$resp[$x+1][$y+5]."</td>";
			if ( $resp[$x+1][$y+3] == 1 ) {
				echo "<td style='width:5%' ><span>&#10003;</span> </td>";
				echo "<td style='width:5%' >".round($resp[$x+1][$y+4],1)." / ".round($resp[$x+1][$y+2],1)."</td>";
				echo "<td><input type='number' id='grade".($a-1).$b."' name='grade".($a-1).$b."' style='width: 6em' placeholder='Overwrite'></td>";
				echo "<td><input type='text' id='comment".($a-1).$b."' name='comment".($a-1).$b."' style='width: 16em' placeholder='Comment'></td>";
				$total[] = $resp[$x+1][$y+4];
			} else {
				echo "<td style='width:5%' ><span>&#10008;</span> </td>";
				echo "<td style='width:5%' >".round($resp[$x+1][$y+4],1)." / ".round($resp[$x+1][$y+2],1)."</td>";
				echo "<td><input type='number' id='grade".($a-1).$b."' name='grade".($a-1).$b."' style='width: 6em' placeholder='Overwrite'></td>";
				echo "<td><input type='text' id='comment".($a-1).$b."' name='comment".($a-1).$b."' style='width: 16em' placeholder='Comment'></td>";
			}
			echo "</tr>";
			$b+=1;
		}
		echo "<th style='background-color: #FFFFFF'>Total Score</th><td></td><td></td><td></td><td></td><td>".round(array_sum($total))."/".$weight."</td><td></td><td></td>";
		echo "</tr>";
		echo "</table>";
		$total2[]=array_sum($total);
		$a+=1;
	}
	echo "<br><h3>Total Score: ".array_sum($total2)."/100</h3><br>";	
	echo "<input class='name' type='submit' name='overwrite' value='Submit' />";
	echo "</form>";


} else if ( $len == 8 ) {
	$a = 1;
	$total2 = [];
	echo "<h1 style='text-align:left'> ".$testname. " - " .end($resp)."</h1><br><br>";
	echo "<form class='form-horizontal' action='https://afsaccess4.njit.edu/~LAM62/front/front_back.php', method='post'>";
	echo "<input type='hidden' id='ansID2' name='ansID2' value=".$resp[6].">";
	for ($x = 0; $x < $len-2; $x+=2) {
		$quest = $resp[$x][0];
		$answ = $resp[$x][1];
		$weight = $resp[$x][2];
		$correctFN = $resp[$x][3];
		$SubFN = $resp[$x][4];
		$FNweight = $resp[$x][5];
		$FNgrade = $resp[$x][6];
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
    echo "<td>Overwrite</td>";
		echo "<td>Comment</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Function Name</th>";
    echo "<td>Check Name</td>";
		echo "<td>".$correctFN." </td>";
    echo "<td>".$SubFN."</td>";
		if ( $FNgrade > 1 ) {
			echo "<td style='width:5%' ><span>&#10003;</span> </td>";
			echo "<td style='width:5%' >".$FNgrade." / ".$FNweight."</td>";
			$total[] = $FNgrade;
			echo "<td><input type='number' id='FNgrade".$a."' name='FNgrade".$a."' style='width: 6em' placeholder='Overwrite'></td>";
			echo "<td><input type='text' id='FNcomment".$a."' name='FNcomment".$a."' style='width: 16em' placeholder='Comment'></td>";
		} else {
			echo "<td style='width:5%' ><span>&#10008;</span> </td>";
			echo "<td style='width:5%' >".$FNgrade." / ".$FNweight."</td>";
			echo "<td><input type='number' id='FNgrade".$a."' name='FNgrade".$a."' style='width: 6em' placeholder='Overwrite'></td>";
			echo "<td><input type='text' id='FNcomment".$a."' name='FNcomment".$a."' style='width: 16em' placeholder='Comment'></td>";
		}
		echo "</tr>";	
		
		$b = 1;
		for ($y = 0; $y < count($resp[$x+1]); $y+=6) {
			echo "<tr>";
			echo "<th style='background-color: #FFFFFF'>Test Case ".($b)."</th>";
			echo "<td>".$resp[$x+1][$y]."</td>";
      echo "<td>".$resp[$x+1][$y+1]."</td>";
      echo "<td>".$resp[$x+1][$y+5]."</td>";
			if ( $resp[$x+1][$y+3] == 1 ) {
				echo "<td style='width:5%' ><span>&#10003;</span> </td>";
				echo "<td style='width:5%' >".round($resp[$x+1][$y+4],1)." / ".round($resp[$x+1][$y+2],1)."</td>";
				echo "<td><input type='number' id='grade".($a-1).$b."' name='grade".($a-1).$b."' style='width: 6em' placeholder='Overwrite'></td>";
				echo "<td><input type='text' id='comment".($a-1).$b."' name='comment".($a-1).$b."' style='width: 16em' placeholder='Comment'></td>";
				$total[] = $resp[$x+1][$y+4];
			} else {
				echo "<td style='width:5%' ><span>&#10008;</span> </td>";
				echo "<td style='width:5%' >".round($resp[$x+1][$y+4],1)." / ".round($resp[$x+1][$y+2],1)."</td>";
				echo "<td><input type='number' id='grade".($a-1).$b."' name='grade".($a-1).$b."' style='width: 6em' placeholder='Overwrite'></td>";
				echo "<td><input type='text' id='comment".($a-1).$b."' name='comment".($a-1).$b."' style='width: 16em' placeholder='Comment'></td>";
			}
			echo "</tr>";
			$b+=1;
		}
		echo "<th style='background-color: #FFFFFF'>Total Score</td><td></td><td></td><td></td><td></td><td>".round(array_sum($total))."/".$weight."</td><td></td><td></td>";
		echo "</tr>";
		echo "</table>";
		$total2[]=array_sum($total);
		$a+=1;
	}
	echo "<br><h3>Total Score: ".array_sum($total2)."/100</h3><br>";	
	echo "<input class='name' type='submit' name='overwrite' value='Submit' />";
	echo "</form>";

} else if ( $len == 12 ) {
	$a = 1;
	$total2 = [];
	echo "<h1 style='text-align:left'> ".$testname. " - " .end($resp)."</h1><br><br>";
	echo "<form class='form-horizontal' action='https://afsaccess4.njit.edu/~LAM62/front/front_back.php', method='post'>";
	echo "<input type='hidden' id='ansID2' name='ansID2' value=".$resp[10].">";
	for ($x = 0; $x < $len-2; $x+=2) {
		$quest = $resp[$x][0];
		$answ = $resp[$x][1];
		$weight = $resp[$x][2];
		$correctFN = $resp[$x][3];
		$SubFN = $resp[$x][4];
		$FNweight = $resp[$x][5];
		$FNgrade = $resp[$x][6];
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
    echo "<td>Overwrite</td>";
		echo "<td>Comment</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<th style='background-color: #FFFFFF'>Function Name</th>";
    echo "<td>Check Name</td>";
		echo "<td>".$correctFN." </td>";
    echo "<td>".$SubFN."</td>";
		if ( $FNgrade > 1 ) {
			echo "<td style='width:5%' ><span>&#10003;</span> </td>";
			echo "<td style='width:5%' >".$FNgrade." / ".$FNweight."</td>";
			$total[] = $FNgrade;
			echo "<td><input type='number' id='FNgrade".$a."' name='FNgrade".$a."' style='width: 6em' placeholder='Overwrite'></td>";
			echo "<td><input type='text' id='FNcomment".$a."' name='FNcomment".$a."' style='width: 16em' placeholder='Comment'></td>";
		} else {
			echo "<td style='width:5%' ><span>&#10008;</span> </td>";
			echo "<td style='width:5%' >".$FNgrade." / ".$FNweight."</td>";
			echo "<td><input type='number' id='FNgrade".$a."' name='FNgrade".$a."' style='width: 6em' placeholder='Overwrite'></td>";
			echo "<td><input type='text' id='FNcomment".$a."' name='FNcomment".$a."' style='width: 16em' placeholder='Comment'></td>";
		}
		echo "</tr>";	
		
		$b = 1;
		for ($y = 0; $y < count($resp[$x+1]); $y+=6) {
			echo "<tr>";
			echo "<th style='background-color: #FFFFFF'>Test Case ".($b)."</th>";
			echo "<td>".$resp[$x+1][$y]."</td>";
      echo "<td>".$resp[$x+1][$y+1]."</td>";
      echo "<td>".$resp[$x+1][$y+5]."</td>";
			if ( $resp[$x+1][$y+3] == 1 ) {
				echo "<td style='width:5%' ><span>&#10003;</span> </td>";
				echo "<td style='width:5%' >".round($resp[$x+1][$y+4],1)." / ".round($resp[$x+1][$y+2],1)."</td>";
				echo "<td><input type='number' id='grade".($a-1).$b."' name='grade".($a-1).$b."' style='width: 6em' placeholder='Overwrite'></td>";
				echo "<td><input type='text' id='comment".($a-1).$b."' name='comment".($a-1).$b."' style='width: 16em' placeholder='Comment'></td>";
				$total[] = $resp[$x+1][$y+4];
			} else {
				echo "<td style='width:5%' ><span>&#10008;</span> </td>";
				echo "<td style='width:5%' >".round($resp[$x+1][$y+4],1)." / ".round($resp[$x+1][$y+2],1)."</td>";
				echo "<td><input type='number' id='grade".($a-1).$b."' name='grade".($a-1).$b."' style='width: 6em' placeholder='Overwrite'></td>";
				echo "<td><input type='text' id='comment".($a-1).$b."' name='comment".($a-1).$b."' style='width: 16em' placeholder='Comment'></td>";
			}
			echo "</tr>";
			$b+=1;
		}
		echo "<th style='background-color: #FFFFFF'>Total Score</th><td></td><td></td><td></td><td></td><td>".round(array_sum($total))."/".$weight."</td><td></td><td></td>";
		echo "</tr>";
		echo "</table>";
		$total2[]=array_sum($total);
		$a+=1;
	}
	echo "<br><h3>Total Score: ".array_sum($total2)."/100</h3><br>";	
	echo "<input class='name' type='submit' name='overwrite' value='Submit' />";
	echo "</form>";

} else {
	print_r(count($resp));
}

?> 	
	
<br><br>
</body>
</html>