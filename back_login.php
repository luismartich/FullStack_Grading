<?php
//include config file
require_once "config.php";

$json = file_get_contents("php://input");
$data = json_decode($json, true);

// LOGIN
if(isset($data['ucid'])){
    $username = $data['ucid'];
    $password = $data['password'];
	$username2 = $role = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$sql = "SELECT id, username, password, role FROM users WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			$param_username = $username;
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt) == 1){
					mysqli_stmt_bind_result($stmt, $id, $username2, $hashed_password, $role);
					if(mysqli_stmt_fetch($stmt)){
						$auth = 0;
						if(password_verify($password, $hashed_password)){
							$auth = 1;
						} else{
							$auth = 0;
						}
						$arr = http_build_query(array('auth' => $auth, 'role' => substr($role,0,1 ), 'UCID' => $username));
						$json2 = json_encode($arr);
						echo $json2;
					}
				}
			}
			mysqli_stmt_close($stmt);
		}
	}
} 
//Create a question 
else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['topic']) && isset($data['test1'])){
	if(isset($data['test2']) && (!isset($data['test3']))){
		$sql = "INSERT INTO questions (topic, difficulty, question, test_case1, test_case2) VALUES (?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssss", $topic, $diff, $question, $test1, $test2);
			$topic = $data['topic'];
			$diff = $data['diff'];
			$question = $data['question'];
			$test1 = $data['test1'];
			$test2 = $data['test2'];
		}
	} else if(isset($data['test3']) && (!isset($data['test4']))){
		$sql = "INSERT INTO questions (topic, difficulty, question, test_case1, test_case2, test_case3) VALUES (?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssss", $topic, $diff, $question, $test1, $test2, $test3);
			$topic = $data['topic'];
			$diff = $data['diff'];
			$question = $data['question'];
			$test1 = $data['test1'];
			$test2 = $data['test2'];
			$test3 = $data['test3'];
		}
	} else if(isset($data['test4']) && (!isset($data['test5']))){
		$sql = "INSERT INTO questions (topic, difficulty, question, test_case1, test_case2, test_case3, test_case4) VALUES (?, ?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssssss", $topic, $diff, $question, $test1, $test2, $test3, $test4);
			$topic = $data['topic'];
			$diff = $data['diff'];
			$question = $data['question'];
			$test1 = $data['test1'];
			$test2 = $data['test2'];
			$test3 = $data['test3'];
			$test4 = $data['test4'];
		}
	} else if(isset($data['test5'])){
		$sql = "INSERT INTO questions (topic, difficulty, question, test_case1, test_case2, test_case3, test_case4, test_case5) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssssss", $topic, $diff, $question, $test1, $test2, $test3, $test4, $test5);
			$topic = $data['topic'];
			$diff = $data['diff'];
			$question = $data['question'];
			$test1 = $data['test1'];
			$test2 = $data['test2'];
			$test3 = $data['test3'];
			$test4 = $data['test4'];
			$test5 = $data['test5'];
		}
	}
		
	if(mysqli_stmt_execute($stmt)){
		echo "<div id=\"success\"><h2>Your question has been posted!</h2></div>";
		echo "<script>setTimeout(\"location.href = 'https://afsaccess4.njit.edu/~LAM62/front/professor.php';\",1500);</script>";
	} else{
		echo "Oops! Something went wrong. Please try again.";
	}
	mysqli_stmt_close($stmt);
} 
//Create Exam
else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($data['testName']) && isset($data['quest1'])){
	if(isset($data['quest3']) && (!isset($data['quest4']))){
		$sql = "INSERT INTO exams (testName, quest1, weight1, quest2, weight2, quest3, weight3) VALUES (?, ?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssssss", $testName, $quest1, $weight1, $quest2, $weight2, $quest3, $weight3);
				$testName = $data['testName'];
				$quest1 = $data['quest1'];
				$weight1 = $data['weight1'];
				$quest2 = $data['quest2'];
				$weight2 = $data['weight2'];
				$quest3 = $data['quest3'];
				$weight3 = $data['weight3'];
		}
	} else if(isset($data['quest4']) && (!isset($data['quest5']))){
		$sql = "INSERT INTO exams (testName, quest1, weight1, quest2, weight2, quest3, weight3, quest4, weight4) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssssssss", $testName, $quest1, $weight1, $quest2, $weight2, $quest3, $weight3, $quest4, $weight4);
				$testName = $data['testName'];
				$quest1 = $data['quest1'];
				$weight1 = $data['weight1'];
				$quest2 = $data['quest2'];
				$weight2 = $data['weight2'];
				$quest3 = $data['quest3'];
				$weight3 = $data['weight3'];
				$quest4 = $data['quest4'];
				$weight4 = $data['weight4'];
		}
	} else if(isset($data['quest4']) && (isset($data['quest5']))){
		$sql = "INSERT INTO exams (testName, quest1, weight1, quest2, weight2, quest3, weight3, quest4, weight4, quest5, weight5) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssssssssss", $testName, $quest1, $weight1, $quest2, $weight2, $quest3, $weight3, $quest4, $weight4, $quest5, $weight5);
			$testName = $data['testName'];
			$quest1 = $data['quest1'];
			$weight1 = $data['weight1'];
			$quest2 = $data['quest2'];
			$weight2 = $data['weight2'];
			$quest3 = $data['quest3'];
			$weight3 = $data['weight3'];
			$quest4 = $data['quest4'];
			$weight4 = $data['weight4'];
			$quest5 = $data['quest5'];
			$weight5 = $data['weight5'];
		}
	}
		
	if(mysqli_stmt_execute($stmt)){
		echo "<div id=\"success\"><h2>Your question has been posted!</h2></div>";
		echo "<script>setTimeout(\"location.href = 'https://afsaccess4.njit.edu/~LAM62/front/maker.php';\",1500);</script>";
	} else{
		echo "Oops! Something went wrong. Please try again.";
	}
	mysqli_stmt_close($stmt);
		
} 
//Filter questionback 
else if(isset($data['filter_topic'])){
	$filter_topic = $data['filter_topic'];
	$filter_diff = $data['filter_diff'];
	$filter_key = strval($data['filter_key']);
	
	if(strlen($filter_key) >= intval(1)){
		$sql = "SELECT ID, question FROM questions WHERE locate('$filter_key', question)>0";
	} else {
		$sql = "SELECT ID, question FROM questions WHERE topic LIKE '%$filter_topic%' AND difficulty LIKE '%$filter_diff%'";
	}
	$result = mysqli_query($link, $sql);
	//$post = array();
	if (mysqli_num_rows($result) > 0) {
		$a = 1;
		echo "<table>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td align='left' style='font-weight: bold;text-align: left;' id='ans".$a."' ondragstart='drag(event)' draggable='true'>".$row['ID']."</td>";
			echo "<td align='left'> - ".$row['question']."</td>";
			echo "</tr>";
			$a++;
		}
		echo "</tr></table>";
	} else {
		echo "<p style='font-weight: bold;text-align: left;'>No questions store in Database</p>";
	}
}
//Display-fetch all the exams
else if(isset($data['fetch_exam'])){
	$sql = "SELECT testName FROM exams";
	$result = mysqli_query($link, $sql);
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	$len = count($post);
	$post[] = $len;
	echo json_encode($post);

} 
//Display-fetch all the taken exams (answers)
else if(isset($data['fetch_result'])){
	$sql = "SELECT ucid, testName FROM answers";
	$result = mysqli_query($link, $sql);
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	//$len = count($post);
	$post[] = $len;
	echo json_encode($post);
	
} 
//Send an especific exam data (questions)
else if(isset($data['open_test'])){
	$open_test = "open_test";
	$testName = $data["testName"];
	
	$sql = "SELECT * FROM exams WHERE testName LIKE '%$testName%'";

	$result = mysqli_query($link, $sql);
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	echo json_encode($post);
}
//Pull question from DB using question ID FK
else if(isset($data['FK'])){
	$FK = $data['FK'];
	$num = $data['num'];
	$testName = $data['testName'];   
	$quesID = $data['quesID'];
	
	$sql = "SELECT Q.question FROM exams E INNER JOIN questions Q ON E.quest".strval($num)." = Q.ID WHERE E.testName LIKE '%$testName%' ";
	
	$result = mysqli_query($link, $sql);
	$post = array();
	$row = mysqli_fetch_assoc($result);
	$a = $row['question'];
	echo json_encode($a);
	
}
//Send an especific exam results along with exam questions (foreign key)
else if(isset($data['open_result'])){
	$open_result = $data['open_result'];
  	$num = $data['num'];
	$user = $data["user"];
	$testname = $data["testname"];

	$sql = "SELECT answers.ID, answers.ucid, answers.testName, exams.quest1, exams.weight1, answers.answer1, exams.quest2, exams.weight2, 
			answers.answer2, exams.quest3, exams.weight3, answers.answer3, exams.quest4, exams.weight4, answers.answer4, exams.quest5, 
			exams.weight5, answers.answer5 FROM answers INNER JOIN exams ON answers.testName = exams.testName WHERE answers.testName LIKE '%$testname%'";
	$result = mysqli_query($link, $sql);
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	$answers = [];
	if(is_array($post) || is_object($post)){
		foreach ($post as $row){
			if(is_array($row) || is_object($row)){
				foreach ($row as $element){
					if ( strlen($element) > 0 ) {
						$answers[]= $element;
					}
				}
			}
		}
	}
	echo json_encode($answers);

} 
else if(isset($data['ansID3'])){
	$ansID3 = $data['ansID3'];
	$a = $data['a'];
	
	if ($a == 0) {
		$sql = "SELECT FNgrade1, FNcomment1, grade01, grade02, grade03, grade04, grade05,
			comment01, comment02, comment03, comment04, comment05 FROM answers WHERE ID LIKE '%$ansID3%'";
	} else if ($a == 1) {
		$sql = "SELECT FNgrade2, FNcomment2, grade11, grade12, grade13, grade14, grade15,
			comment11, comment12, comment13, comment14, comment15 FROM answers WHERE ID LIKE '%$ansID3%'";
	} else if ($a == 2) {
		$sql = "SELECT FNgrade3, FNcomment3, grade21, grade22, grade23, grade24, grade25,
			comment21, comment22, comment23, comment24, comment25 FROM answers WHERE ID LIKE '%$ansID3%'";
	} else if ($a == 3) {
		$sql = "SELECT FNgrade4, FNcomment4, grade31, grade32, grade33, grade34, grade35,
			comment31, comment32, comment33, comment34, comment35 FROM answers WHERE ID LIKE '%$ansID3%'";
	} else if ($a == 4) {
		$sql = "SELECT FNgrade5, FNcomment5, grade41, grade42, grade43, grade44, grade45,
			comment41, comment42, comment43, comment44, comment45 FROM answers WHERE ID LIKE '%$ansID3%'";
	}

	$result = mysqli_query($link, $sql);
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	$answers = [];
	if(is_array($post) || is_object($post)){
		foreach ($post as $row){
			if(is_array($row) || is_object($row)){
				foreach ($row as $element){
					if ( strlen($element) > 0 ) {
						$answers[]= $element;
					}
				}
			}
		}
	}
	echo json_encode($answers);

}
else if(isset($data['onequest'])){
	$onequest = $data['onequest'];
	$sql = "SELECT test_case1, test_case2, test_case3, test_case4, test_case5 FROM questions WHERE ID LIKE '%$onequest%'";
	$result = mysqli_query($link, $sql);
	$post = array();
	while($row = mysqli_fetch_assoc($result)) {
		$post[] = $row;
	}
	$answers = [];
	if(is_array($post) || is_object($post)){
		foreach ($post as $row){
			if(is_array($row) || is_object($row)){
				foreach ($row as $element){
					if ( strlen($element) > 0 ) {
						$answers[]= $element;
					}
				}
			}
		}
	}
	echo json_encode($answers);
}
else if(isset($data['onequest2'])){
	$onequest2 = $data['onequest2'];
	$sql = "SELECT question FROM questions WHERE ID LIKE '%$onequest2%'";

	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	echo json_encode($row);
}
//Insert into answers the answer to an exam
 else if (isset($data['answer1']) && isset($data['answer2'])) {
	 if (isset($data['answer3']) && (!isset($data['answer4']))) {
		$sql = "INSERT INTO answers (ucid, testName, answer1, answer2, answer3) VALUES (?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssss", $ucid0, $testname, $answer1, $answer2, $answer3);
			$ucid0 = $data['ucid0'];
			$testname = $data['testname'];
			$answer1 = $data['answer1'];
			$answer2 = $data['answer2'];
			$answer3 = $data['answer3'];
		}
	 } else if (isset($data['answer4']) && (!isset($data['answer5']))) {
		$sql = "INSERT INTO answers (ucid, testName, answer1, answer2, answer3, answer4) VALUES (?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssss", $ucid0, $testname, $answer1, $answer2, $answer3, $answer4);
			$ucid0 = $data['ucid0'];
			$testname = $data['testname'];
			$answer1 = $data['answer1'];
			$answer2 = $data['answer2'];
			$answer3 = $data['answer3'];
			$answer4 = $data['answer4'];
		}
	 } else if (isset($data['answer4']) && (isset($data['answer5']))) {
		$sql = "INSERT INTO answers (ucid, testName, answer1, answer2, answer3, answer4, answer5) VALUES (?, ?, ?, ?, ?, ?, ?)";		
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "sssssss", $ucid0, $testname, $answer1, $answer2, $answer3, $answer4, $answer5);
			$ucid0 = $data['ucid0'];
			$testname = $data['testname'];
			$answer1 = $data['answer1'];
			$answer2 = $data['answer2'];
			$answer3 = $data['answer3'];
			$answer4 = $data['answer4'];
			$answer5 = $data['answer5'];
		}
	 }
	if(mysqli_stmt_execute($stmt)){
		echo "<div id=\"success\"><h2>Your answers were submitted successfully!</h2></div>";
		echo "<script>setTimeout(\"location.href = 'https://afsaccess4.njit.edu/~LAM62/front/student.php';\",1500);</script>";
	} else{
		echo "Oops! Something went wrong. Please try again.";
	}
	mysqli_stmt_close($stmt);
	 
} 
else if (isset($data['ansID'])) {	
	if (isset($data['grade01']) && isset($data['FNgrade1'])) {
		if (isset($data['grade02']) && (!isset($data['grade03']))){
			$ansID = $data['ansID'];
			$grade01 = $data['grade01'];
			$grade02 = $data['grade02'];
			$FNgrade = $data['FNgrade1'];
			$sql = "UPDATE answers SET grade01 = '$grade01', grade02 = '$grade02', FNgrade1 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade03']) && (!isset($data['grade04']))){
			$ansID = $data['ansID'];
			$grade01 = $data['grade01'];
			$grade02 = $data['grade02'];
			$grade03 = $data['grade03'];
			$FNgrade = $data['FNgrade1'];
			$sql = "UPDATE answers SET grade01 = '$grade01', grade02 = '$grade02', grade03 = '$grade03', FNgrade1 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade04']) && (!isset($data['grade05']))) {
			$ansID = $data['ansID'];
			$grade01 = $data['grade01'];
			$grade02 = $data['grade02'];
			$grade03 = $data['grade03'];
			$grade04 = $data['grade04'];
			$FNgrade = $data['FNgrade1'];
			$sql = "UPDATE answers SET grade01 = '$grade01', grade02 = '$grade02', grade03 = '$grade03', grade04 = '$grade04', FNgrade1 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade04']) && (isset($data['grade05']))) {			
			$ansID = $data['ansID'];
			$grade01 = $data['grade01'];
			$grade02 = $data['grade02'];
			$grade03 = $data['grade03'];
			$grade04 = $data['grade04'];
			$grade05 = $data['grade05'];
			$FNgrade = $data['FNgrade1'];
			$sql = "UPDATE answers SET grade01 = '$grade01', grade02 = '$grade02', grade03 = '$grade03', grade04 = '$grade04', grade05 = '$grade05', FNgrade1 = '$FNgrade' WHERE ID = '$ansID'";		
		}
		if ($link->query($sql) === TRUE) {
			echo "EXAM HAS BEEN GRADED";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else if (isset($data['grade11']) && isset($data['FNgrade2'])) {
		if (isset($data['grade12']) && (!isset($data['grade13']))){
			$ansID = $data['ansID'];
			$grade11 = $data['grade11'];
			$grade12 = $data['grade12'];
			$FNgrade = $data['FNgrade2'];
			$sql = "UPDATE answers SET grade11 = '$grade11', grade12 = '$grade12', FNgrade2 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade13']) && (!isset($data['grade14']))){
			$ansID = $data['ansID'];
			$grade11 = $data['grade11'];
			$grade12 = $data['grade12'];
			$grade13 = $data['grade13'];
			$FNgrade = $data['FNgrade2'];
			$sql = "UPDATE answers SET grade11 = '$grade11', grade12 = '$grade12', grade13 = '$grade13', FNgrade2 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade14']) && (!isset($data['grade15']))) {
			$ansID = $data['ansID'];
			$grade11 = $data['grade11'];
			$grade12 = $data['grade12'];
			$grade13 = $data['grade13'];
			$grade14 = $data['grade14'];
			$FNgrade = $data['FNgrade2'];
			$sql = "UPDATE answers SET grade11 = '$grade11', grade12 = '$grade12', grade13 = '$grade13', grade14 = '$grade14', FNgrade2 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade14']) && (isset($data['grade15']))) {			
			$ansID = $data['ansID'];
			$grade11 = $data['grade11'];
			$grade12 = $data['grade12'];
			$grade13 = $data['grade13'];
			$grade14 = $data['grade14'];
			$grade15 = $data['grade15'];
			$FNgrade = $data['FNgrade2'];
			$sql = "UPDATE answers SET grade11 = '$grade11', grade12 = '$grade12', grade13 = '$grade13', grade14 = '$grade14', grade15 = '$grade15', FNgrade2 = '$FNgrade' WHERE ID = '$ansID'";		
		}
		if ($link->query($sql) === TRUE) {
			echo "EXAM HAS BEEN GRADED";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else if (isset($data['grade21']) && isset($data['FNgrade3'])) {
		if (isset($data['grade22']) && (!isset($data['grade23']))){
			$ansID = $data['ansID'];
			$grade21 = $data['grade21'];
			$grade22 = $data['grade22'];
			$FNgrade = $data['FNgrade3'];
			$sql = "UPDATE answers SET grade21 = '$grade21', grade22 = '$grade22', FNgrade3 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade23']) && (!isset($data['grade24']))){
			$ansID = $data['ansID'];
			$grade21 = $data['grade21'];
			$grade22 = $data['grade22'];
			$grade23 = $data['grade23'];
			$FNgrade = $data['FNgrade3'];
			$sql = "UPDATE answers SET grade21 = '$grade21', grade22 = '$grade22', grade23 = '$grade23', FNgrade3 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade24']) && (!isset($data['grade25']))) {
			$ansID = $data['ansID'];
			$grade21 = $data['grade21'];
			$grade22 = $data['grade22'];
			$grade23 = $data['grade23'];
			$grade24 = $data['grade24'];
			$FNgrade = $data['FNgrade3'];
			$sql = "UPDATE answers SET grade21 = '$grade21', grade22 = '$grade22', grade23 = '$grade23', grade24 = '$grade24', FNgrade3 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade24']) && (isset($data['grade25']))) {			
			$ansID = $data['ansID'];
			$grade21 = $data['grade21'];
			$grade22 = $data['grade22'];
			$grade23 = $data['grade23'];
			$grade24 = $data['grade24'];
			$grade25 = $data['grade25'];
			$FNgrade = $data['FNgrade3'];
			$sql = "UPDATE answers SET grade21 = '$grade21', grade22 = '$grade22', grade23 = '$grade23', grade24 = '$grade24', grade25 = '$grade25', FNgrade3 = '$FNgrade' WHERE ID = '$ansID'";		
		}
		if ($link->query($sql) === TRUE) {
			echo "EXAM HAS BEEN GRADED";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else if (isset($data['grade31']) && isset($data['FNgrade4'])) {
		if (isset($data['grade32']) && (!isset($data['grade33']))){
			$ansID = $data['ansID'];
			$grade31 = $data['grade31'];
			$grade32 = $data['grade32'];
			$FNgrade = $data['FNgrade4'];
			$sql = "UPDATE answers SET grade31 = '$grade31', grade32 = '$grade32', FNgrade4 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade33']) && (!isset($data['grade34']))){
			$ansID = $data['ansID'];
			$grade31 = $data['grade31'];
			$grade32 = $data['grade32'];
			$grade33 = $data['grade33'];
			$FNgrade = $data['FNgrade4'];
			$sql = "UPDATE answers SET grade31 = '$grade31', grade32 = '$grade32', grade33 = '$grade33', FNgrade4 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade34']) && (!isset($data['grade35']))) {
			$ansID = $data['ansID'];
			$grade31 = $data['grade31'];
			$grade32 = $data['grade32'];
			$grade33 = $data['grade33'];
			$grade34 = $data['grade34'];
			$FNgrade = $data['FNgrade4'];
			$sql = "UPDATE answers SET grade31 = '$grade31', grade32 = '$grade32', grade33 = '$grade33', grade34 = '$grade34', FNgrade4 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade34']) && (isset($data['grade35']))) {			
			$ansID = $data['ansID'];
			$grade31 = $data['grade31'];
			$grade32 = $data['grade32'];
			$grade33 = $data['grade33'];
			$grade34 = $data['grade34'];
			$grade35 = $data['grade35'];
			$FNgrade = $data['FNgrade4'];
			$sql = "UPDATE answers SET grade31 = '$grade31', grade32 = '$grade32', grade33 = '$grade33', grade34 = '$grade34', grade35 = '$grade35', FNgrade4 = '$FNgrade' WHERE ID = '$ansID'";		
		}
		if ($link->query($sql) === TRUE) {
			echo "EXAM HAS BEEN GRADED";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else if (isset($data['grade41']) && isset($data['FNgrade5'])) {
		if (isset($data['grade42']) && (!isset($data['grade43']))){
			$ansID = $data['ansID'];
			$grade41 = $data['grade41'];
			$grade42 = $data['grade42'];
			$FNgrade = $data['FNgrade5'];
			$sql = "UPDATE answers SET grade41 = '$grade41', grade42 = '$grade42', FNgrade5 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade43']) && (!isset($data['grade44']))){
			$ansID = $data['ansID'];
			$grade41 = $data['grade41'];
			$grade42 = $data['grade42'];
			$grade43 = $data['grade43'];
			$FNgrade = $data['FNgrade5'];
			$sql = "UPDATE answers SET grade41 = '$grade41', grade42 = '$grade42', grade43 = '$grade43', FNgrade5 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade44']) && (!isset($data['grade45']))) {
			$ansID = $data['ansID'];
			$grade41 = $data['grade41'];
			$grade42 = $data['grade42'];
			$grade43 = $data['grade43'];
			$grade44 = $data['grade44'];
			$FNgrade = $data['FNgrade5'];
			$sql = "UPDATE answers SET grade41 = '$grade41', grade42 = '$grade42', grade43 = '$grade43', grade44 = '$grade44', FNgrade5 = '$FNgrade' WHERE ID = '$ansID'";		
		}else if (isset($data['grade44']) && (isset($data['grade45']))) {			
			$ansID = $data['ansID'];
			$grade41 = $data['grade41'];
			$grade42 = $data['grade42'];
			$grade43 = $data['grade43'];
			$grade44 = $data['grade44'];
			$grade45 = $data['grade45'];
			$FNgrade = $data['FNgrade5'];
			$sql = "UPDATE answers SET grade41 = '$grade41', grade42 = '$grade42', grade43 = '$grade43', grade44 = '$grade44', grade45 = '$grade45', FNgrade5 = '$FNgrade' WHERE ID = '$ansID'";		
		}
		if ($link->query($sql) === TRUE) {
			echo "EXAM HAS BEEN GRADED";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

} else if (isset($data['ansID2'])) {
	$ansID2 = $data['ansID2'];
	$check = [];
	$data2 = array();
	foreach (array_slice($data,1) as $a) {
		if ( $a == "Submit" ) {
			continue;
		}
		$var = array_keys($data,$a);
		foreach ($var as $z) {
			$data2 += [$z => $a];
		}
	}
	foreach($data2 as $key => $value){
		$sql = "UPDATE answers SET ".$key." = '$value' WHERE ID = '$ansID2'";	
		if ($link->query($sql) === TRUE) {
			$check[] = 1;
		} else {
			$check[] = 0;
		}	
	}
	if (in_array(0,$check)){
		echo "SOME DATA MAY BE LOST";
	} else {
		echo "EXAM HAS BEEN REVISED";
		echo "<script>setTimeout(\"location.href = 'https://afsaccess4.njit.edu/~LAM62/front/professor.php';\",2000);</script>";
	}
}

mysqli_close($link);


?>
