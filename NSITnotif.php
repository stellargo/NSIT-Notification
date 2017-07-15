<?php

//EXTRACT CURRENT LATEST NOTIFICATION
include 'simple_html_dom.php';
$html = file_get_html('https://imsnsit.org/imsnsit/notifications.php');
$htmlstring = (string)($html);
$i = 0;
$currdate='';
while ($i<=9){
$currdate = $currdate.$htmlstring[1547+$i];
$i = $i + 1;
}
$currdate_day = (int)($currdate[0].$currdate[1]);
$currdate_month = (int)($currdate[3].$currdate[4]);
$currdate_year = (int)($currdate[6].$currdate[7].$currdate[8].$currdate[9]);

//READ THE FILE THAT CONTAINS LAST DATE
$myfile = fopen("notifsave.txt", "r") or die("Unable to open file!");
$edate = fgets($myfile);
$edate_day = (int)($edate[0].$edate[1]);
$edate_month = (int)($edate[3].$edate[4]);
$edate_year = (int)($edate[6].$edate[7].$edate[8].$edate[9]);
fclose($myfile);

//SEND ME A MAIL IF NEW NOTIFICATION HAS ARRIVED
if (($edate_year<$currdate_year) || ($edate_year===$currdate_year && $edate_month<$currdate_month) || ($edate_year===$currdate_year && $edate_month===$currdate_month && $edate_day<$currdate_day)){

			//SEND ME A MAIL
			$to      = 'sumitsarinofficial@gmail.com';
			$subject = 'New NSIT notification';
			$message = 'https://imsnsit.org/imsnsit/notifications.php';
			$headers = 'From: sumit@nsit.com' . "\r\n" .'Reply-To: sumit@nsit.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);

			//WRITE TO FILE
			$myfile_ = fopen("notifsave.txt", "w") or die("Unable to open file!");
			fwrite($myfile_, $currdate);
			fclose($myfile_);
}

?>