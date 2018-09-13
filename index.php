<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

define('ENDPOINT', 'https://graph.fb.me/');
define('ACCESS_TOKEN', 'EAAAAAYsX7TsBAPkdNcCFC1SPxTjHq5XpEKwmMjgVioxcZAZBxePxqzkwJ0pP1vr3sDN2M1HoAmH5FFImKZCB4wCkglks3HABA1THj6PjbmduWFIQMbfSZClNWKvmNZAuWcNCBcKafuqfFX88JAbxHpIXjOqmgZCyCLghOubAXmbq8b86GfkrieWEpR2ZB9IggLflcLY5xmp7AcfadgoAZAYY'); // Thay YOUR_ACCESS_TOKEN thành Token của bạn
define('YOUR_USER_ID', '100012707970558'); // Thay USER_ID thành ID của bạn

$list_reaction = ['LIKE']; // List Reactions
$list_user = ['100027399409598']; // List User ID 

foreach ($list_user as $userID) {
	$posts = curl(ENDPOINT.$userID.'/posts?fields=id&limit=1&access_token='.ACCESS_TOKEN);

	$idFirstPost = $posts->data[0]->id;
	if(checkReaction($idFirstPost)) {
		continue;
	}

	$reaction = $list_reaction[array_rand($list_reaction)];

	$log = curl(ENDPOINT.$idFirstPost.'/reactions?type='.$reaction.'&method=POST&access_token='.ACCESS_TOKEN);

	if($log->success) {
		logs(date('d.m.y H:i:s')." | ".$reaction." | ".$idFirstPost." | success\n");
		echo 'success';
	}
	else {
		logs(date('d.m.y H:i:s')." | ERROR | ".$idFirstPost." | ".$log->error->message."\n");
		echo 'error';
	}
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
				break;
			}
		}
	}
	return false;
}

function logs($data) {
	$fileContent = file_get_contents ('log.txt');
	file_put_contents('log.txt', $data . "\n" . $fileContent);
}
