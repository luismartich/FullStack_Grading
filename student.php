<?php
  session_start();
  
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
  
  if (isset($_POST['fetch_exam'])) {
    $fetch_exam = "fetch_exam";

	$data = array(
		'fetch_exam' => $fetch_exam,
	);
	$fields = json_encode($data); 
	$dbURL = 'https://afsaccess4.njit.edu/~LAM62/front/front_back.php';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = json_decode(curl_exec($ch));
	$len = $resp[array_key_last($resp)];
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
      width: 80%;
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

  <br><br><br>
  <h1 class="my-5">Student Landing Page</h1>
  <h2 class="my-5">Hi, <b><?php echo $_SESSION["username"]; ?></b> Welcome to our site.</h2><br>  
  <h5>This is the student exam page. Click on the fetch button to view the available exams.</h5><br><br> 
	<form class="in-line" method="post" action= "student.php">
		<label><h5>Fetch Exams<h5></label>
		<p class="form-group"><input type="submit" value="Fetch" name="fetch_exam"></p>
	</form>
	<br>
	<?php
	for ($x = 1; $x <= $len; $x++) {
		foreach ( $resp[$x-1] as $i ) {
			echo "<form class='form-in-line' method='post' action='taketest.php'>";
			echo "<input type='hidden' id='testName' name='testName' value='".$i."'>";
			echo "<label>".$i."</label>";
			echo "<p class='form-group'><input type='submit' value='OPEN' name='open_test'></p>";
			echo "<br>";
			echo "</form>";
		} 
	 
	}
	?>
	<br><br><br>
</body>
</html>