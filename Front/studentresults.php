<?php
  session_start();
  
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
  
  if (isset($_POST['fetch_result'])) {
    $fetch_result = "fetch_result";

	  $data = array(
		'fetch_result' => $fetch_result,
	);

	$fields = json_encode($data); 
	$dbURL = 'https://afsaccess4.njit.edu/~LAM62/front/front_back.php';
	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = json_decode(curl_exec($ch));
	$len = count($resp) - 1;
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
  
	body{ 
      font: 15px sans-serif; 
      text-align: center; 
      background: linear-gradient(120deg, #2980b9, #FFFAF0);
      height: 100vh;
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
   h1, h2{
     color: white;
     font-weight: 500;
   }
   h5{
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
   input[type="Submit"]{
      width: 5%;
      height: 30px;
      border: 1px solid;
      background: #2691d9;
      border-radius: 25px;
      font-size:18px;
      color: #e9f4fb;
      font-weight: 500;
      cursor: pointer;
      outline:none;
    }
    
   table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  tr:nth-child(even) {
    background-color: #dddddd;
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
</header>
<br><br><br>
<h1 class="my-5">Edit Exam Results</h1>
<h2 class="my-5">Edit exam results.</h2><br>
    <main><br><br>  
        <form class="in-line" method="post" action= "studentresults.php">
			<label>Fetch Exams</label>
			<p class="form-group"><input type="submit" value="Fetch" name="fetch_result"></p>
		</form>
		<br>
		<?php 
		for ($x = 0; $x <= $len-1; $x++) {

			$user = "";
			$testname = "";
			$flag = 0;
			foreach ( $resp[$x] as $i ) {
				if ( $flag == 0 ){
					$user = $i;
					$flag = 1;
				}else {
					$testname = $i;
				}
			}
			if ($user == $_SESSION["username"]){
				$a = $user . " - " . $testname;
				echo "<form class='form-in-line' method='post' action='studentres.php'>";
				echo "<label>".$a."</label>";
				echo "<input type='hidden' id='len2' name='len2' value='".$len."'>";
				echo "<input type='hidden' id='user2' name='user2' value='".$user."'>";
				echo "<input type='hidden' id='testname2' name='testname2' value='".$testname."'>";
				echo "<p class='form-group'><input type='submit' value='OPEN' name='open_result".($x+1)."'></p>";
				echo "</form>";
			}
		}
		?> 
    </main>   
</body>
</html>