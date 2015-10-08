<?php

function connect()
{
	$db_handle = mysql_connect("localhost","root","");
	mysql_select_db("7amada",$db_handle);
}
function in_request_queue($username)
{
	$result = mysql_query("select * from requests where Username = '".$username."'");
	return mysql_fetch_assoc($result);
}
function get_id_from_username($username)
{
	$result = mysql_query("select ID from users where Username = '".$username."'");
	$row = mysql_fetch_assoc($result);
	return $row['ID'];
}
function get_user_details($user_id)
{
	$result = mysql_query("select * from users where ID = '".$user_id."'");
	return mysql_fetch_assoc($result);
	
}
function update_user($user_id,$column_name,$value)
{
	mysql_query("update users set ".$column_name." = '".$value."' where ID = '".$user_id."'");
}
function select_users($type) // returns an array of "FirstName SecondName (username)"
{
	$ret = array();
	$query = "select FirstName,LastName,Username from users where AccountType = '".$type."'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)){
		$ret[] = $row['FirstName']." ".$row['LastName']." (".$row['Username'].")";
	}
	return $ret;
}
function get_questions() // returns an array of arrays of question details
{
	$ret = array();
	$query = "select * from questions";
	$result = mysql_query($query);
	while ($record = mysql_fetch_assoc($result))
		$ret[] = $record;
	return $ret;
}
function get_question($id)
{
	$query = "select * from questions where ID = '".$id."'";
	return mysql_fetch_assoc(mysql_query($query));
}

function add_question($question,$correct,$distractor1,$distractor2,$distractor3)
{
	$question = mysql_real_escape_string($question);
	$correct = mysql_real_escape_string($correct);
	$distractor1 = mysql_real_escape_string($distractor1);
	$distractor2 = mysql_real_escape_string($distractor2);
	$distractor3 = mysql_real_escape_string($distractor3);
	$query = "insert into questions (Question,CorrectAnswer,Distractor1,Distractor2,Distractor3) 
				VALUES ('".$question."','".$correct."','".$distractor1."','".$distractor2."','".$distractor3."')";
	mysql_query($query);
}
function edit_question($id,$question,$correct,$distractor1,$distractor2,$distractor3)
{
	$question = mysql_real_escape_string($question);
	$correct = mysql_real_escape_string($correct);
	$distractor1 = mysql_real_escape_string($distractor1);
	$distractor2 = mysql_real_escape_string($distractor2);
	$distractor3 = mysql_real_escape_string($distractor3);
	$query = "update questions
				set Question = '".$question."', CorrectAnswer = '".$correct."', Distractor1 = '".$distractor1."', Distractor2 = '".$distractor2."', 
				Distractor3 = '".$distractor3."'
				where ID = '".$id."'";
	mysql_query($query);
}
function delete_question($id)
{
	mysql_query("delete from questions where ID = '".$id."'");
}
function get_exams()
{
	$ret = array();
	$query = "select * from exams";
	$result = mysql_query($query);
	while ($record = mysql_fetch_assoc($result))
		$ret[] = $record;
	return $ret;
}
function get_exam_questions($exam_id)
{
	$ret = array();
	$query = "select questions.ID,questions.Question,questions.CorrectAnswer,questions.Distractor1,questions.Distractor2,questions.Distractor3
	from questions,questionexampairs where questions.ID = questionexampairs.QuestionID and questionexampairs.ExamID = '".$exam_id."'";
	
	//$query = "select * from questions";
	$result = mysql_query($query);
	while($record = mysql_fetch_assoc($result))
		$ret[] = $record;
		
	return $ret;
}
function clear_exam($exam_id)
{
	mysql_query("delete from questionexampairs where examid = '".$exam_id."'");
}
function add_question_to_exam($question_id,$exam_id)
{
	mysql_query("insert into questionexampairs (QuestionID,ExamID) values ('".$question_id."','".$exam_id."')");
}
function add_exam($exam_name)
{
	mysql_query("insert into exams (name) values ('".$exam_name."')");
}
function delete_exam($exam_id)
{
	mysql_query("delete from exams where id = '".$exam_id."'");
	mysql_query("delete from questionexampairs where ExamID = '".$exam_id."'");
}
function add_result($result,$student_id,$exam_id)
{
	mysql_query("insert into testresults (StudentID,ExamID,Result,Date) values ('".$student_id."','".$exam_id."','".$result."','".
	date('y-m-d')."')");
}
function get_exam_results($exam_id,$user_id) // returns array of array of strings
{
	$result = mysql_query("select * from testresults where ExamID = '".$exam_id."' and StudentID = '".$user_id."'");
	$ret = array();
	while ($record = mysql_fetch_assoc($result))
		$ret[] = $record;
	return $ret;
}
function remove_user($username)
{
	mysql_query("delete from users where Username = '".$username."'");
}
function remove_user_from_requests($username)
{
	mysql_query("delete from requests where Username = '".$username."'");
}

?>


