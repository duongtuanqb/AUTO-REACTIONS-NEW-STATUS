<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

define('ENDPOINT', 'https://graph.fb.me/');
define('ACCESS_TOKEN', 'YOUR_ACCESS_TOKEN'); // Thay YOUR_ACCESS_TOKEN thành Token của bạn
define('CRUSH_USER_ID', 'USER_ID'); // Thay USER_ID thành ID của Cursh
define('YOUR_USER_ID', 'USER_ID'); // Thay USER_ID thành ID của bạn

$list_reaction = ['LIKE', 'LOVE', 'WOW', 'HAHA', 'SAD', 'ANGRY']; // List Reactions

$posts = curl(ENDPOINT.CRUSH_USER_ID.'/posts?fields=id&limit=1&access_token='.ACCESS_TOKEN); // Get list status

$idFirstPost = $posts->data[0]->id; // Get first ID status

if(!checkReaction($idFirstPost)) {

	$reaction = $list_reaction[array_rand($list_reaction)];

	$url = ENDPOINT.$idFirstPost.'/reactions?type='.$reaction.'&method=POST&access_token='.ACCESS_TOKEN;

	$log = curl($url);

	if($log->success) {
		logs(date('d.m.y H:i:s')." | ".$reaction." | ".$idFirstPost." | success\n");
		echo 'success';
	}
	else {
		logs(date('d.m.y H:i:s')." | ERROR | ".$idFirstPost." | ".$log->error-message."\n");
		echo 'error';
	}
} else {
	echo 'REACTIONED';
}

function curl($url) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36');

	$result = curl_exec($ch);
	curl_close($ch);

	return json_decode($result);
}

function checkReaction($idPost) {

	$file = file_get_contents('log.txt');

	if(strpos($file, $idPost)) {

		return true;

	} else {

		$getReactions = curl(ENDPOINT.$idPost.'/reactions?access_token='.ACCESS_TOKEN);

		foreach ($getReactions->data as $user) {

			if(YOUR_USER_ID == $user->id) {
				return true;
			}

		}

	}

	return false;
}

// Logs file
function logs($data) {
	$fp = fopen('log.txt', "a");

	if ($fp) {
	    fwrite($fp, $data);
	}

	fclose($fp);
}
