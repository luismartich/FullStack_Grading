<?php

session_start();
$dbURL = 'https://afsaccess4.njit.edu/~LAM62/back/back_login.php';
$json = file_get_contents("php://input");
$data = json_decode($json, true);
 
 //LOGIN
if (isset($data['ucid']) && isset($data['password'])) { 
	$name = $data['ucid'];
	$password = $data['password'];

	$data = array(
		'ucid' => $name,
		'password' => $password
	);
	$fields = json_encode($data); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch);
	echo $resp;
} 
//Creating a question
else if (isset($data['topic']) && isset($data['test1'])) {	
	$topic = $data['topic'];
	$diff = $data['diff'];
	$question = $data['question'];
	$test1 = $data['test1'];
	$test2 = $data['test2'];
	$test3 = $data['test3'];
	$test4 = $data['test4'];
	$test5 = $data['test5'];

	$data = array(
		'topic' => $topic,
		'diff' => $diff,
		'question' => $question,
		'test1' => $test1,
		'test2' => $test2,
		'test3' => $test3,
		'test4' => $test4,
		'test5' => $test5,
	);
	$fields = json_encode($data); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch);
	echo $resp;
} 
//Creating an exam
else if (isset($data['testName']) && isset($data['quest1'])) {
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
	curl_setopt($ch, CURLOPT_URL, $dbURL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch); 
	echo $resp;
} 
//Sending exam's answers to DB
else if (isset($data['answer1']) && isset($data['answer2'])) {
	$ucid0 = $data['ucid0'];
	$testname = $data['testname'];
	$answer1 = $data['answer1'];
	$answer2 = $data['answer2'];
	$answer3 = $data['answer3'];
	$answer4 = $data['answer4'];
	$answer5 = $data['answer5'];

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
	curl_setopt($ch, CURLOPT_URL, $dbURL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);	
	curl_close($ch);
	echo $resp;
}
//Filtering question bank for create exam
else if(isset($data['filter_topic'])){
	$filter_topic = $data['filter_topic'];
	$filter_diff = $data['filter_diff'];
	$filter_key = strval($data['filter_key']);
	
	$data = array(
		'filter_topic' => $filter_topic,
		'filter_diff' => $filter_diff,
		'filter_key' => $filter_key,
	);
	$fields = json_encode($data); 
	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $dbURL);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
	curl_close($ch);
	echo $resp;
}
//
else if(isset($data['fetch_exam'])){
	$fetch_exam = $data['fetch_exam'];
	$data = array(
		'fetch_exam' => $fetch_exam,
	);

	$fields = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$resp = curl_exec($ch);
	curl_close($ch);
	echo $resp;
}
//
else if(isset($data['fetch_result'])){
	$fetch_result = $data['fetch_result'];
	$data = array(
		'fetch_result' => $fetch_result,
	);

	$fields = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL);
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
  	curl_setopt($ch, CURLOPT_URL, $dbURL);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
  	echo $resp;

} 
else if (isset($data['ansID2'])) {
	$fields = json_encode($data); 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $dbURL);
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
  	curl_setopt($ch, CURLOPT_URL, $dbURL);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
  	echo $resp;
}
//Show result
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
  	curl_setopt($ch, CURLOPT_URL, $dbURL);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	$resp = curl_exec($ch);
  	curl_close($ch);
	echo $resp;
} 
else {
	$len = count($data);
	$ansID = $data[0];
	$user = $data[1];
	$testName = $data[2];

	if ($len == 12) {
		$final = [];	
		$c = 0;
		for ($x = 3; $x < $len; $x+=3) {   	//Iteration per question on exam
			$one = [];
			$two = [];
			$onequest = $data[$x];			// question ID
			$weight = $data[$x+1]; 			// question weight ***
			$Answer = $data[$x+2]; 			// response ***
			$AnswerArr = explode(" ", $Answer);
			$index_answer = array_search('def',$AnswerArr) + 1;
			$FN = explode('(',$AnswerArr[$index_answer]);		// Submitted FN
			$FN_Answer = $FN[0];
			$data2 = array(
				'onequest' => $onequest,
			);
			$info = json_encode($data2);		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $dbURL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resp = json_decode(curl_exec($ch));
			curl_close($ch);
			
			$arr1 = [];
			foreach ($resp as $i){						//for test case in question
				$myfile = fopen('test.py','w');
				$test_cases_arr = explode("=",$i);
				$test_case = $test_cases_arr[0];		//Test case
				$expected_output = $test_cases_arr[1];	//Expected test case output
				$z = $Answer . PHP_EOL . "print(".$test_case.")";
				fwrite($myfile, $z);
				fclose($myfile);
				$two[] = $test_case;					//---->Test Cases 
				$two[] = $expected_output;				//---->Test Cases expected output 
				$calc = ((80 / count($resp)) / 100 ) * $weight; 
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
			if ( count($arr1) == 2 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
				);
			} else if ( count($arr1) == 3 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
				);
			} else if ( count($arr1) == 4 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
					"grade".$c."4" => $arr1[3],
				);
			} else if ( count($arr1) == 5 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
					"grade".$c."4" => $arr1[3],
					"grade".$c."5" => $arr1[4],
				);
			}
			
			$info3 = json_encode($data4);
			$ch3 = curl_init();
			curl_setopt($ch3, CURLOPT_URL, $dbURL);
			curl_setopt($ch3, CURLOPT_POSTFIELDS, $info3);
			curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
			$resp3 = curl_exec($ch3);
			
			curl_close($ch3);
			$c+=1;
		} 
		$final[] = $ansID;
		$final[] = "EXAM HAS BEEN GRADED";
		echo json_encode($final);

	}
	else if ($len == 15) {
		$final = [];	
		$c = 0;
		for ($x = 3; $x < $len; $x+=3) {   	//Iteration per question on exam
			$one = [];
			$two = [];
			$onequest = $data[$x];			// question ID
			$weight = $data[$x+1]; 			// question weight ***
			$Answer = $data[$x+2]; 			// response ***
			$AnswerArr = explode(" ", $Answer);
			$index_answer = array_search('def',$AnswerArr) + 1;
			$FN = explode('(',$AnswerArr[$index_answer]);		// Submitted FN
			$FN_Answer = $FN[0];
			$data2 = array(
				'onequest' => $onequest,
			);
			$info = json_encode($data2);		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $dbURL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resp = json_decode(curl_exec($ch));
			curl_close($ch);
			
			$arr1 = [];
			foreach ($resp as $i){						//for test case in question
				$myfile = fopen('test.py','w');
				$test_cases_arr = explode("=",$i);
				$test_case = $test_cases_arr[0];		//Test case
				$expected_output = $test_cases_arr[1];	//Expected test case output
				$z = $Answer . PHP_EOL . "print(".$test_case.")";
				fwrite($myfile, $z);
				fclose($myfile);
				$two[] = $test_case;					//---->Test Cases 
				$two[] = $expected_output;				//---->Test Cases expected output 
				$calc = ((80 / count($resp)) / 100 ) * $weight; 
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
			if ( count($arr1) == 2 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
				);
			} else if ( count($arr1) == 3 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
				);
			} else if ( count($arr1) == 4 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
					"grade".$c."4" => $arr1[3],
				);
			} else if ( count($arr1) == 5 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
					"grade".$c."4" => $arr1[3],
					"grade".$c."5" => $arr1[4],
				);
			}
			
			$info3 = json_encode($data4);
			$ch3 = curl_init();
			curl_setopt($ch3, CURLOPT_URL, $dbURL);
			curl_setopt($ch3, CURLOPT_POSTFIELDS, $info3);
			curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
			$resp3 = curl_exec($ch3);
			
			curl_close($ch3);
			$c+=1;
		} 
		$final[] = $ansID;
		$final[] = "EXAM HAS BEEN GRADED";
		echo json_encode($final);
		
	} else if ($len == 18) {
		$final = [];	
		$c = 0;
		for ($x = 3; $x < $len; $x+=3) {   	//Iteration per question on exam
			$one = [];
			$two = [];
			$onequest = $data[$x];			// question ID
			$weight = $data[$x+1]; 			// question weight ***
			$Answer = $data[$x+2]; 			// response ***
			$AnswerArr = explode(" ", $Answer);
			$index_answer = array_search('def',$AnswerArr) + 1;
			$FN = explode('(',$AnswerArr[$index_answer]);		// Submitted FN
			$FN_Answer = $FN[0];
			$data2 = array(
				'onequest' => $onequest,
			);
			$info = json_encode($data2);		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $dbURL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$resp = json_decode(curl_exec($ch));
			curl_close($ch);
			
			$arr1 = [];
			foreach ($resp as $i){						//for test case in question
				$myfile = fopen('test.py','w');
				$test_cases_arr = explode("=",$i);
				$test_case = $test_cases_arr[0];		//Test case
				$expected_output = $test_cases_arr[1];	//Expected test case output
				$z = $Answer . PHP_EOL . "print(".$test_case.")";
				fwrite($myfile, $z);
				fclose($myfile);
				$two[] = $test_case;					//---->Test Cases 
				$two[] = $expected_output;				//---->Test Cases expected output 
				$calc = ((80 / count($resp)) / 100 ) * $weight; 
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
			if ( count($arr1) == 2 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
				);
			} else if ( count($arr1) == 3 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
				);
			} else if ( count($arr1) == 4 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
					"grade".$c."4" => $arr1[3],
				);
			} else if ( count($arr1) == 5 ) {
				$data4 = array(
					'ansID' => $ansID,
					"FNgrade".($c+1) => $arr2[0],
					"grade".$c."1" => $arr1[0],
					"grade".$c."2" => $arr1[1],
					"grade".$c."3" => $arr1[2],
					"grade".$c."4" => $arr1[3],
					"grade".$c."5" => $arr1[4],
				);
			}
			
			$info3 = json_encode($data4);
			$ch3 = curl_init();
			curl_setopt($ch3, CURLOPT_URL, $dbURL);
			curl_setopt($ch3, CURLOPT_POSTFIELDS, $info3);
			curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
			$resp3 = curl_exec($ch3);
			
			curl_close($ch3);
			$c+=1;
		} 
		$final[] = $ansID;
		$final[] = "EXAM HAS BEEN GRADED";
		echo json_encode($final);

	}

}

?>
