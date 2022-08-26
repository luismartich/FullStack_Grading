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
    <title>Faculty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    
	* {box-sizing: border-box;}
 
  .logout{
   position:fixed;
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
    font: 15px sans-serif; 
    text-align: center; 
    background: linear-gradient(120deg, #2980b9, #FFFAF0);
    height: 200vh;
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
   }
 
 
  </style>
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
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
<script>
/*Drag and drop function*/
function allowDrop(ev) {
	ev.preventDefault();
}
function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.id);
}
function drop(ev) {
	ev.preventDefault();

	var data = ev.dataTransfer.getData("text");
	ev.target.value = $("#"+data).html();
}
/*Submit form with AJAX*/
$(document).ready(function(){
	$('#filt').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: "https://afsaccess4.njit.edu/~LAM62/front/front_back.php",
			type: "POST",
			data: $(this).serialize(),
			success: function(data){
				$("#postData").html(data);
			},
			error: function(){
				alert("Form submission failed!");
			}
		});
	});
});

$(document).ready(function(){
	$('#examform').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: "https://afsaccess4.njit.edu/~LAM62/front/front_back.php",
			type: "POST",
			data: $(this).serialize(),
			success: function(data){
				$("#porcetage").html(data);
			},
			error: function(){
				alert("Form submission failed!");
			}
		});
	});
});

/*Input fields */
var i = 1; 
var p = 0;
function textBoxCreate(){
	if (i >= 3 && p==0) {
		let div10 = document.createElement("div");
		div10.setAttribute("class","form-group");
		var n = document.createElement("p");
		n.setAttribute("class","form-group");
		var m = document.createElement("input");
		m.setAttribute("class","name");
		m.setAttribute("type","submit");
		m.setAttribute("value","Post");
		m.setAttribute("name","post");
		
		div10.appendChild(n);
		n.appendChild(m);
		document.getElementById("submitbottom").appendChild(div10);
		p = 1;
	}
	
	if (i <= 5) {
		let div1 = document.createElement("div");
		div1.setAttribute("class","form-row");
		let div2 = document.createElement("div");
		div2.setAttribute("class","form-group col-xs-4");
		var a = document.createElement("label");
		a.setAttribute("class", "control-label");
		a.innerText = "Question " + i;
		var b = document.createElement("textarea");
		b.setAttribute("class", "form-control");
		b.setAttribute("id", "quest" + i);
		b.setAttribute("Name", "quest" + i);
		b.setAttribute("ondrop", "drop(event)");
		b.setAttribute("ondragover", "allowDrop(event)");
		b.setAttribute("rows", "2");
		b.setAttribute("cols", "80");
		b.setAttribute("required", "");
		b.setAttribute("readonly", "");
		
		
		let div3 = document.createElement("div");
		div3.setAttribute("class","col-xs-1");
		var c = document.createElement("label");
		c.setAttribute("class", "control-label");
		c.innerText = "Percent /100";
		var d = document.createElement("input");
		d.setAttribute("class", "form-control");
		d.setAttribute("type", "text");
		d.setAttribute("id", "weight" + i);
		d.setAttribute("Name", "weight" + i);
		d.setAttribute("size", "5");
		d.setAttribute("required", "");
		
		div1.appendChild(div2);
		div1.appendChild(div3);
		div2.appendChild(a);
		div2.appendChild(b);
		div3.appendChild(c);
		div3.appendChild(d);

		document.getElementById("myForm").appendChild(div1);
		i++;
	} else {
		const x = document.createElement("p");
		x.innerText = "Reached MAX amount of questions";
		document.getElementById("noMore").appendChild(x);
	}

}



	</script>
    <br><br><br>
    <h1 class="my-5">Create an Exam</h1>
    <h2 class="my-5">Create an exam using the questions in the database.</h2>
    <h5>Search the databank and drag the wanted questions to the questions table to add to the exam.</h5><br><br>
	<div class="row d-flex justify-content-center text-center">
		<div class="column" style="background-color:#EDEDED; box-shadow: 20px 20px 50px grey; border-radius: 20px 0px 0px 20px;">
    		<h2 class="form-group">CREATE AN EXAM</h2>
        	<form class="form-horizontal" id="examform">
				<div class="form-row">
					<div class="form-group col-xs-4">   
						<label class="control-label">Exams Name</label>
						<div class="col-xs-4">
							<input class="form-control" type="text" id="testName" name="testName" size="40" required>
						</div>
					</div>
				</div>
				<p id="myForm"></p>
				<p id="porcetage"></p>
				<p id="submitbottom"></p>
				<p id="noMore"></p>
				
        	</form>
			<button class="name" onclick="textBoxCreate()" style="float: left;">Add Question (Min=3 | Max=5)</button> 
  		</div>
		<div class="column" style="background-color:#E5E5E5; box-shadow: 20px 20px 50px grey; border-radius: 0px 20px 20px 0px;">
			<h2 class="form-group">FIND QUESTIONS IN DATABANK</h2>
			<form class="form-horizontal" id="filt">
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
					<input class="name" type="submit" name="filter" value="Filter" align="left" />
				</div>
			</form>
			<br>
			<div id='postData'></div>
  		</div>
	</div>   
	<br>
</body>
</html>
