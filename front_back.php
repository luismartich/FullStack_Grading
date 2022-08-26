<?php 
  session_start();
  $json = file_get_contents("php://input");
  $data = json_decode($json, true);
  $dbURL = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
  $dbURL2 = 'https://afsaccess4.njit.edu/~LAM62/middle/middle.php';

//LOGIN
if (isset($_POST['ucid']) && isset($_POST['password'])) { 
	$name = $_POST['ucid'];
	$password = $_POST['password'];

	$data = array(
		'ucid' => $name,
		'password' => $password
	);
	$fields = json_encode($data); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL2);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch);

	$res = str_replace(array('"',"\n","\r"), '', $resp);	
	parse_str($res);
	$rol = substr($role,0,1);
	$user = $UCID; 

	if($auth == 1){
		session_start();
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $user;
		if($rol == "S"){
			header("Location: student.php");
		} else if($rol == 'P'){
			header("Location: professor.php");
		} else {
			echo "Unknown Role";}
	} else{
		echo "Unauthorized";
	}
} 
//Creating a question
else if (isset($_POST['topic']) && isset($_POST['test1'])) {	
	$topic = $_POST['topic'];
	$diff = $_POST['diff'];
	$question = $_POST['question'];
  $constraint = $_POST['const'];
	$test1 = $_POST['test1'];
	$test2 = $_POST['test2'];
	$test3 = $_POST['test3'];
	$test4 = $_POST['test4'];
	$test5 = $_POST['test5'];

	$data = array(
		'topic' => $topic,
		'diff' => $diff,
		'question' => $question,
    'const' => $constraint,
		'test1' => $test1,
		'test2' => $test2,
		'test3' => $test3,
		'test4' => $test4,
		'test5' => $test5,
	);
	$fields = json_encode($data); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL2);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch);
	echo $resp;
} 
//Creating an exam
else if (isset($_POST['testName']) && isset($_POST['quest1'])) {
	$testName = $_POST['testName'];
	$quest1 = $_POST['quest1'];
	$weight1 = $_POST['weight1'];
	$quest2 = $_POST['quest2'];
	$weight2 = $_POST['weight2'];
	$quest3 = $_POST['quest3'];
	$weight3 = $_POST['weight3'];
	$quest4 = $_POST['quest4'];
	$weight4 = $_POST['weight4'];
	$quest5 = $_POST['quest5'];
	$weight5 = $_POST['weight5'];
	
	$sum = $weight1 + $weight2 + $weight3 + $weight4 + $weight5;
	if ($sum != 100){
		echo "Sum of all porcentages must be 100";
	} else {

		$data = array(
			'testName' => $testName,
			'quest1' => $quest1,
			'weight1' => $weight1,
			'quest2' => $quest2,
			'weight2' => $weight2,
			'quest3' => $quest3,
			'weight3' => $weight3,
			'quest4' => $quest4,
			'weight4' => $weight4,
			'quest5' => $quest5,
			'weight5' => $weight5,
		);
		$fields = json_encode($data); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $dbURL2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$resp = curl_exec($ch);	
		curl_close($ch); 
		echo $resp;
	}
} 
//Sending exam's answers to DB
else if (isset($_POST['answer1']) && isset($_POST['answer2'])) {
	$ucid0 = $_POST['ucid0'];
	$testname = $_POST['testname'];
	$answer1 = $_POST['answer1'];
	$answer2 = $_POST['answer2'];
	$answer3 = $_POST['answer3'];
	$answer4 = $_POST['answer4'];
	$answer5 = $_POST['answer5'];

	$data = array(
		'ucid0' => $ucid0,
		'testname' => $testname,
		'answer1' => $answer1,
		'answer2' => $answer2,
		'answer3' => $answer3,
		'answer4' => $answer4,
		'answer5' => $answer5,
	);
	$fields = json_encode($data); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL2);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch);
	echo $resp;
}
//Filtering question bank for create exam
else if(isset($_POST['filter_topic'])){
	$filter_topic = $_POST['filter_topic'];
	$filter_diff = $_POST['filter_diff'];
	$filter_key = strval($_POST['filter_key']);
	
	$data = array(
		'filter_topic' => $filter_topic,
		'filter_diff' => $filter_diff,
		'filter_key' => $filter_key,
	);
	$fields = json_encode($data); 
	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
	curl_close($ch);
	echo $resp;
}
//fetch exam
else if(isset($data['fetch_exam'])){
	$fetch_exam = $data['fetch_exam'];
	$data = array(
		'fetch_exam' => $fetch_exam,
	);

	$fields = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL2);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);
	curl_close($ch);
	echo $resp;

}
//Display-fetching resolved exams
else if(isset($data['fetch_result'])){
	$fetch_result = $data['fetch_result'];
	$data = array(
		'fetch_result' => $fetch_result,
	);

	$fields = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL2);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);
	curl_close($ch);
	echo $resp;

}
//fetch answers 
else if(isset($data['open_test'])){
	$open_test = "open_test";
	$testName = $data["testName"];
	$data = array(
		'open_test' => $open_test,
		'testName' => $testName,
	);
  	$fields = json_encode($data);
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
  	echo $resp;
}
else if(isset($data['ansID3'])){
	$ansID3 = $data['ansID3'];
	$a = $data['a'];
	$data = array(
		'ansID3' => $ansID3,
		'a' => $a,
	);
  	$fields = json_encode($data);
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
  	echo $resp;
}
//
else if(isset($data['open_result'])){
	$open_result = $data['open_result'];
  	$num = $data['num'];
	$user = $data["user"];
	$testname = $data["testname"];
  	
  	$data = array(
  		'open_result' => $open_result,
  		'num' => $num,
		'user' => $user,
		'testname' => $testname,
  	);
  	$fields = json_encode($data);
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);

	$ch2 = curl_init();
  	curl_setopt($ch2, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch2, CURLOPT_POSTFIELDS, $resp);
  	curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
  	$resp2 = curl_exec($ch2);

	echo $resp2;

}
else if(isset($data['open_result2'])){
	
	$open_result = $data['open_result2'];
	$user = $data["user2"];
	$testname = $data["testname2"];
  	
  	$data = array(
  		'open_result' => $open_result,
		'user' => $user,
		'testname' => $testname,
  	);

  	$fields = json_encode($data);
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
	echo $resp;

} 
else if(isset($_POST['ansID2'])){
	$data = array();
	foreach ($_POST as $a) {
		if (strlen($a) >= 1) {
			$var = array_keys($_POST,$a);
			foreach ($var as $b) {
				$data += [$b => $a];
			}
			
		}
	}
  	$fields = json_encode($data);
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL2);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
	echo $resp;
}
?>
