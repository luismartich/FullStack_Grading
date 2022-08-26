<?php

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Professor Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    
	* {box-sizing: border-box;}
 
   ul .logout{    
     position: fixed;   
     right:10px;
     top:5px;
  }

	/* Create two equal columns that floats next to each other */
	.column {
  	float: left;
  	width: 45%;
  	padding: 15px;
	}

	/* Clear floats after the columns */
	.row:after {
  	content: "";
  	display: table;
  	clear: both;
	}
	body{ 
    width: 100%;
    font: 15px sans-serif; 
    text-align: center; 
    background: linear-gradient(120deg, #2980b9, #FFFAF0);
    height: 200vh;
    overflow-x: hidden;
  }
	
	.name {
      padding:8px 20px;
      width: 100%;
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
   .form-group{
     color: #2980b9;
     font-weight: 500;
     text-align: center;
   }
   label{
     font-weight: 500;
   }
   
   </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 
</head>
<body>
<script>
/*Submit form with AJAX*/
$(document).ready(function(){
	$('#filt2').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: "https://afsaccess4.njit.edu/~sh363/front_back.php",
			type: "POST",
			data: $(this).serialize(),
			success: function(data){
				$("#postData2").html(data);
			},
			error: function(){
				alert("Form submission failed!");
			}
		});
	});
});

var i = 1; 
var p = 0;
function textBoxCreate(){
	if (i >= 2 && p==0) {
		let div10 = document.createElement("p");
		div10.setAttribute("class","form-group");
		var m = document.createElement("input");
		m.setAttribute("class","name");
		m.setAttribute("type","submit");
		m.setAttribute("value","Submit");
		m.setAttribute("name","submit");
		
		div10.appendChild(m);
		document.getElementById("submitbottom").appendChild(div10);
		p = 1;
	}
	
	if (i <= 5) {
		let div1 = document.createElement("div");
		div1.setAttribute("class","form-group");
		var a = document.createElement("label");
		a.setAttribute("class", "control-label");
		a.innerText = "Test Case " + i;
		var b = document.createElement("input");
		b.setAttribute("type", "text");
		b.setAttribute("class", "form-control");
		b.setAttribute("id", "test" + i);
		b.setAttribute("Name", "test" + i);
		b.setAttribute("placeholder", "Enter Test Case " + i);
		b.setAttribute("required", "");

		div1.appendChild(a);
		div1.appendChild(b);

		document.getElementById("myForm").appendChild(div1);
		i++;
	} else {
		const x = document.createElement("p");
		x.innerText = "Reached MAX amount of questions";
		document.getElementById("noMore").appendChild(x);
	}

}
</script>

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
 
    <br><br><br>
    <h1 class="my-5">Exam questions</h1>
    <h2 class="my-5">Hi, <b><?php echo $_SESSION["username"]; ?></b> - Welcome to our site.</h2>
	<div class="row d-flex justify-content-center text-center">
  		<div class="column" style="background-color:#EDEDED; box-shadow: 20px 20px 50px grey; border-radius: 20px 0px 0px 20px;">
    		<h2 class="form-group">SAVE QUESTIONS TO DATABASE</h2>
        	<form method="post" action= "https://afsaccess4.njit.edu/~LAM62/front/front_back.php">
				<div class="form-group">
					<label>Topic</label>
					<select class="form-control" id="topic" name="topic" required>
						<option>Variables</option>
						<option>Conditionals</option>
						<option>For loops</option>
						<option>While Loops</option>
						<option>Lists</option>
						<option>Dictionaries</option>
					</select>
				</div>
				<div class="form-group">
					<label>Difficulty</label>
					<select class="form-control" id="diff" name="diff" required>
						<option>Easy</option>
						<option>Medium</option>
						<option>Hard</option>
					</select>
				</div>
        <div class="form-group">
					<label>Constraints</label>
					<select class="form-control" id="const" name="const" required>
						<option>None</option>
						<option>For</option>
						<option>While</option>
					</select>
				</div>
				<div class="form-group">
					<label>Input Question</label>
                	<textarea class="form-control" type="text" name="question" id="question" rows="3" placeholder="Enter Question" required></textarea>
            	</div>
				<p id="myForm"></p>
				<p id="submitbottom"></p>
				<p id="noMore"></p>
        	</form>
			<button class="name" onclick="textBoxCreate()" style="float: left;">Add Test Case (Min=2 | Max=5)</button> 
  		</div>
  		<div class="column" style="background-color:#E5E5E5; box-shadow: 20px 20px 50px grey; border-radius: 0px 20px 20px 0px;">
    		<h2 class="form-group">FIND QUESTIONS IN DATABANK</h2>
			<form class="form-horizontal" id="filt2">
				<div class="form-row">
					<div class="form-group col-xs-2">
						<label class="control-label">Topic</label>
						<select class="form-group col-xs-2" id="filter_topic" name="filter_topic" cols="20" required>
							<option>Variables</option>
							<option>Conditionals</option>
							<option>For loops</option>
							<option>While Loops</option>
							<option>Lists</option>
							<option>Dictionaries</option>
						</select>
					</div>
					<div class="form-group col-xs-2">
						<label class="control-label">Diffuculty</label>
						<select class="form-group col-xs-2" id="filter_diff" name="filter_diff" cols="20" required>
							<option>Easy</option>
							<option>Medium</option>
							<option>Hard</option>
						</select>
					</div>
					<div class="form-group col-xs-2">
						<label class="control-label">Key</label>
						<input class="form-group col-xs-2" type="text" id="filter_key" name="filter_key" size="20" placeholder="Enter a word">
					</div>
				</div>
				<div class="form-row">
					<input class="name" type="submit" name="filter" value="Filter" align="left" >
				</div>
			</form>
			<br>
			<div id='postData2'></div>
 		</div>
	</div>   
	<br>
</body>
</html>
