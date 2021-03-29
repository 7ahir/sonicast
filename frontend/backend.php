<?php

if($_GET['action'] =='getCityList'){
	$URLCity = "http://back/weatherforecast/cities";

	$chCity = curl_init();
	curl_setopt($chCity, CURLOPT_URL,$URLCity);
	curl_setopt($chCity, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($chCity, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($chCity, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	// curl_setopt($chCity, CURLOPT_USERPWD, "$username:$password");
	$resultCity=curl_exec ($chCity);
	$status_codeCity = curl_getinfo($chCity, CURLINFO_HTTP_CODE); //get status code
	curl_close ($chCity);

	$resultCity = json_decode($resultCity);
	echo json_encode($resultCity);

}
if($_GET['action'] =='getWeather'){

	$username='imtatlantique_hammoud';
	$password='f0Unez9AISKo4';

	$city =$_GET['city'];

	$getDateTime = $_GET['date'];
	
	$date1 = strtotime(date(date_format (new DateTime ($getDateTime),'Y-m-d')));
	$now = strtotime(date(date_format (new DateTime ('now'),'Y-m-d')));

	if($date1 == $now){
		$getDateTimeExport = $getDateTime;	
	}elseif ($date1 > $now){// Future
		$getDateTimeExport = date_format (new DateTime ($getDateTime),'Y-m-d')."T00:00:00Z";
	}else if ($date1 < $now){ // Past
		echo "error";
		return;
	}

	$date2 = new DateTime ($getDateTime);
	$date2->modify('+1 day');

	$date2value = date_format ($date2,'Y-m-d')."T00:00:00Z";

	// $URLCity = "http://ip172-18-0-47-c04o3qb6hnp000bgojl0-80.direct.labs.play-with-docker.com/weatherforecast/".$city;
	$URLCity = "http://back/weatherforecast/".$city;

	$chCity = curl_init();
	curl_setopt($chCity, CURLOPT_URL,$URLCity);
	curl_setopt($chCity, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($chCity, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($chCity, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($chCity, CURLOPT_USERPWD, "$username:$password");
	$resultCity=curl_exec ($chCity);
	$status_codeCity = curl_getinfo($chCity, CURLINFO_HTTP_CODE); //get status code
	curl_close ($chCity);

	$resultCity = json_decode($resultCity);

	if($status_codeCity !=200){
		return "error city not found";
	}




	$weatherURL = 'https://api.meteomatics.com/'.$getDateTimeExport.'--'.$date2value.':PT1H/t_2m:C,precip_1h:mm,wind_speed_10m:ms/'.$resultCity->latitude.','.$resultCity->longitude.'/json';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$weatherURL);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	$result=curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //get status code
	curl_close ($ch);

	if($status_codeCity !=200){
		return "error weather not found";
	}

	$weatherAPI = json_decode($result);
	$weatherAPIData = $weatherAPI->data;

	$temperatureArray = $weatherAPI->data[0];
	$precipitationArray = $weatherAPI->data[1];
	$windSpeedArray = $weatherAPI->data[2];


	$restHour = 24 - intval(date_format (new DateTime ($getDateTimeExport),'H'));

	$output = [];

	for ($i=0; $i < $restHour; $i++) { 

		$output[$i]['hour'] = date_format (new DateTime ($temperatureArray->coordinates[0]->dates[$i]->date),'H');
		$output[$i]['temp'] = $temperatureArray->coordinates[0]->dates[$i]->value;
		$output[$i]['precip'] = $precipitationArray->coordinates[0]->dates[$i]->value;
		$convertoNoeux = $windSpeedArray->coordinates[0]->dates[$i]->value * 1.9438444924574;
		$output[$i]['windSpeed'] = round($convertoNoeux, 2);

		
		$roundPrecip = ceil($output[$i]['precip']);
		if($roundPrecip >= 4)
			$roundPrecip = 4;


		$output[$i]['precipSound'] = $roundPrecip;

	}

	echo json_encode($output);

}




?>