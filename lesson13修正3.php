<?php
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;
const HAND_TYPE = array(STONE => 'グー', SCISSORS => 'チョキ', PAPER => 'パー');

const DRAW = 0;
const LOSE = 1;
const WIN =2;
const RESULT_TYPE = array(DRAW => 'あいこ', LOSE => '負け', WIN => '勝ち');

const YES = 1;
const NO = 2;
const ANSER = array(YES => 'はい', NO => 'いいえ');

function rockPaperScissors(){
	$format = '%d:%s %d:%s %d:%s 対応する数値を入力して下さい';
	echo sprintf($format, STONE, HAND_TYPE[STONE], SCISSORS, HAND_TYPE[SCISSORS], PAPER, HAND_TYPE[PAPER]) . PHP_EOL;
	echo 'じゃん　けん　ぽん！' . PHP_EOL;
	game();
}
function game(){
	$myHand = inputMyHand();
	$comHand = getComHand();
	echo sprintf("自分:%s", HAND_TYPE[$myHand]) . PHP_EOL;
	echo sprintf("相手:%s", HAND_TYPE[$comHand]) . PHP_EOL;
	$result = result($myHand, $comHand);
	show($result);
	if ($result == DRAW) {
		return game();
	}
	echo 'もう一度やりますか？' . PHP_EOL;
	echo sprintf('%d:%s %d:%s', YES, ANSER[YES], NO, ANSER[NO]) . PHP_EOL;
	$answer = inputReChallenge();
	if ($answer == YES) {
		return rockPaperScissors();
	}elseif ($answer == NO) {
		exit;
	}
}
function inputMyHand(){
	$myHand = trim(fgets(STDIN));
	if (handCheck($myHand) === false){
		echo '再度入力して下さい' . PHP_EOL;
		return inputMyHand();
	}
	return $myHand;
}
function getComHand(){
	$comHandNum = mt_rand(0,2);
	return $comHandNum;
}
function result($myHand, $comHand){
	$result = ($myHand - $comHand + 3) % 3;
	return $result;
}
function show($result) {
	switch ($result) {
		case DRAW:
		echo 'あいこでしょ！' . PHP_EOL;
		break;
		case LOSE:
		echo 'あなたの負け' . PHP_EOL;
		break;
		case WIN:
		echo 'あなたの勝ち' . PHP_EOL;
		break;
	}
}
function inputReChallenge(){
	$reChallenge = trim(fgets(STDIN));
	if (reChallengeCheck($reChallenge) === false) {
		echo '数字で入力して下さい' . PHP_EOL;
		return inputReChallenge();
	}
	return $reChallenge;
}

function handCheck($myHand) {
	if ($myHand === '') { //(!isset($myHand))
		return false;
	}
	if (!array_key_exists($myHand, HAND_TYPE)) { //(!isset(HAND_TYPE[$myHand])) {
		return false;
	}
	return true;
}
function reChallengeCheck($reChallenge){
	if (empty($reChallenge)) {
		return false;
	}
	if (!array_key_exists($reChallenge, ANSER)) { //(!isset(ANSER[$reChallenge])) {
		return false;
	}
	return true;
}

rockPaperScissors();
?>