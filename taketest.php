<?php

session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

if (isset($_POST["open_test"])) {
	$open_test = "open_test";
	$testName = $_POST["testName"];
	$data = array(
		'open_test' => $open_test,
		'testName' => $testName,
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
    /* To hide the questions */
     .container{
        margin-top:50px;
    }
    .multiple_section{
        display:none;
    }
	* {box-sizing: border-box;}
 
	/* Create two equal columns that floats next to each other */
	.column {
  	width: 80%;
  	padding: 15px;
	}

	/* Clear floats after the columns */
	.row:after {
  	content: "";
  	display: table;
  	clear: both;
	}
	body{ 
      font: 15px sans-serif; 
      text-align: center; 
      background: linear-gradient(120deg, #2980b9, #FFFAF0);
      height: 180vh;
    }
 
  .logout{
     position:fixed;
     right:10px;
     top:5px;
  }
  
  ul {
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
   .form-control{
    width: 900px;
    height: 150px;
    resize: none;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  input[type="submit"]{
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
    }

    </style>
</head>
<body>
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

	$question = [];
	if(is_array($resp) || is_object($resp)){
		foreach ($resp as $row){
			foreach ($row as $element){
				if(strlen($element) == 0){
					continue;
				} else{
					$question[]= $element;
				}
			}
		}
	}
	$exam_name = $question[0];
	$ct = (count($question ) - 1) / 2;
  $x=1;
  $y=1;
	?> 
 
<script>
    $(document).ready(function(){
        $(".next-prev").click(function(){
            var section = $(this).attr("data-next-prev");
            $(".multiple_section").css("display","none");
            $("#"+section).css("display","block");
        });
    });
</script>	 
    <?php 
          echo "<br><br><br>";
          echo "<h1 class='my-5'>".$exam_name. "</h1>";
          echo "<form method='post' action= 'https://afsaccess4.njit.edu/~LAM62/front/front_back.php'>";
          echo "<input type='hidden' id='testname' name='testname' value='".$exam_name."' >"; 
		      echo "<input type='hidden' id='ucid0' name='ucid0' value='".$_SESSION["username"]."' >"; 
     
          echo "<div class='container'>";
          echo "<div class='multiple_section' id='1' style='display:block'>"    ;     
          echo "<h2>Question ".$x."<h2>"; 
          echo "<h5>$x out of $ct questions<h5>";
          echo "<h5>points: ".$question[$y+1]."</h5>";
          
          $FK = "FK";
    			$num = $x;
    			$testName2 = $exam_name;
    			$quesID = $question[$y];
    			$data2 = array(
    				'FK' => $FK,
    				'num' => $num,
    				'testName' => $testName2,
    				'quesID' => $quesID,
    			);
    
    			$fields2 = json_encode($data2);
    
    			$dbURL2 = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
    			$ch2 = curl_init();
    			curl_setopt($ch2, CURLOPT_URL, $dbURL2);
    			curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields2);
    			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    			$resp2 = json_decode(curl_exec($ch2));
    			curl_close($ch2);
   
    			echo "<h5>".$resp2."<h5><br>";
    			echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer' required></textarea><br><br>";
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='2'>Next</button>";
    	    echo "</div></div>";
          $x++;
    			$y = $y + 2;      
          ?>
        
    <?php 
          echo "<div class='multiple_section' id='2'>";     
          echo "<h2>Question ".$x."<h2>"; 
          echo "<h5>$x out of $ct questions<h5>";
          echo "<h5>points: ".$question[$y+1]."</h5>";
          
          $FK = "FK";
    			$num = $x;
    			$testName2 = $exam_name;
    			$quesID = $question[$y];
    			$data2 = array(
    				'FK' => $FK,
    				'num' => $num,
    				'testName' => $testName2,
    				'quesID' => $quesID,
    			);
    
    			$fields2 = json_encode($data2);
    
    			$dbURL2 = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
    			$ch2 = curl_init();
    			curl_setopt($ch2, CURLOPT_URL, $dbURL2);
    			curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields2);
    			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    			$resp2 = json_decode(curl_exec($ch2));
    			curl_close($ch2);
   
    			echo "<h5>".$resp2."<h5><br>";
    			echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer' required></textarea><br><br>";
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='1'>Prev</button>";
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='3'>Next</button>";
    	    echo "</div></div>";
          $x++;
    			$y = $y + 2;      
          ?>
        
    <?php 
          echo "<div class='multiple_section' id='3'>";     
          echo "<h2>Question ".$x."<h2>"; 
          echo "<h5>$x out of $ct questions<h5>";
          echo "<h5>points: ".$question[$y+1]."</h5>";
          
          $FK = "FK";
    			$num = $x;
    			$testName2 = $exam_name;
    			$quesID = $question[$y];
    			$data2 = array(
    				'FK' => $FK,
    				'num' => $num,
    				'testName' => $testName2,
    				'quesID' => $quesID,
    			);
    
    			$fields2 = json_encode($data2);
    
    			$dbURL2 = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
    			$ch2 = curl_init();
    			curl_setopt($ch2, CURLOPT_URL, $dbURL2);
    			curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields2);
    			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    			$resp2 = json_decode(curl_exec($ch2));
    			curl_close($ch2);
   
    			echo "<h5>".$resp2."<h5><br>";                
          if($ct == '3'){
			    echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer'></textarea><br><br>"; 
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='2'>Prev</button>";
          echo "<br><br>";
          echo "<input type='submit' value='Submit Answers' name='Submit Answers'>";
          echo "</div></div>";
          $x++;
    			$y = $y + 2;}
          else {
    			echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer'></textarea><br><br>"; 
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='2'>Prev</button>";
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='4'>Next</button>";
          echo "</div></div>";        
          $x++;
    			$y = $y + 2; }
          ?>
        
    <?php 
          echo "<div class='multiple_section' id='4'>";     
          echo "<h2>Question ".$x."<h2>"; 
          echo "<h5>$x out of $ct questions<h5>";
          echo "<h5>points: ".$question[$y+1]."</h5>";
          
          $FK = "FK";
    			$num = $x;
    			$testName2 = $exam_name;
    			$quesID = $question[$y];
    			$data2 = array(
    				'FK' => $FK,
    				'num' => $num,
    				'testName' => $testName2,
    				'quesID' => $quesID,
    			);
    
    			$fields2 = json_encode($data2);
    
    			$dbURL2 = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
    			$ch2 = curl_init();
    			curl_setopt($ch2, CURLOPT_URL, $dbURL2);
    			curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields2);
    			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    			$resp2 = json_decode(curl_exec($ch2));
    			curl_close($ch2);
   
    			echo "<h5>".$resp2."<h5><br>";
          if($ct == '4'){
    			echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer'></textarea><br><br>"; 
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='3'>Prev</button>";
          echo "<br><br>";
          echo "<input type='submit' value='Submit Answers' name='Submit Answers'>";
    	    echo "</div></div>";
          $x++;
    			$y = $y + 2;}
          else {
    			echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer'></textarea><br><br>"; 
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='3'>Prev</button>";
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='5'>Next</button>";
          echo "</div></div>";
          $x++;
    			$y = $y + 2;}       
          ?>

    <?php 
          echo "<div class='multiple_section' id='5'>";     
          echo "<h2>Question ".$x."<h2>"; 
          echo "<h5>$x out of $ct questions<h5>";
          echo "<h5>points: ".$question[$y+1]."</h5>";
          
          $FK = "FK";
    			$num = $x;
    			$testName2 = $exam_name;
    			$quesID = $question[$y];
    			$data2 = array(
    				'FK' => $FK,
    				'num' => $num,
    				'testName' => $testName2,
    				'quesID' => $quesID,
    			);
    
    			$fields2 = json_encode($data2);
    
    			$dbURL2 = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
    			$ch2 = curl_init();
    			curl_setopt($ch2, CURLOPT_URL, $dbURL2);
    			curl_setopt($ch2, CURLOPT_POSTFIELDS, $fields2);
    			curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    			$resp2 = json_decode(curl_exec($ch2));
    			curl_close($ch2);
   
    			echo "<h5>".$resp2."<h5><br>";
    			echo "<textarea class='form-control' type='text' id='answer".$x."' name='answer".$x."' rows='3' placeholder='Input Answer'></textarea><br><br>";
          echo "<button type='button' class='btn btn-primary next-prev' data-next-prev='4'>Prev</button>";
          echo "<br><br>";
          echo "<input type='submit' value='Submit Answers' name='Submit Answers'>";
    			echo "</div></div>";
    	    $x++;
    			$y = $y + 2;    
          ?>
</form>
</body>
</html>
