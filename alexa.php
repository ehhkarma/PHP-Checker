<?php

if(!file_exists($argv[1])){
  echo "\n\t usage : php $argv[0] list.txt \n";
}

echo "[Mass Alexa Check]\n[Dang Boi c0ding]\n\n";
$url=file_get_contents($argv[1]);
$ex=explode("\r\n",$url);
foreach ($ex as $urls){

$alexa = file_get_contents("http://data.alexa.com/data?cli=10&dat=snbamz&url=".$urls);

$global = preg_match_all("/ TEXT=\"(.*?)\" SOURCE=\"panel\"/", $alexa, $gr);
$delta = preg_match_all("/<RANK DELTA=\"(.*?)\"\/>/", $alexa, $dr);
$country = preg_match_all("/\" NAME=\"(.*?)\"/", $alexa, $ca);
$countrya = preg_match_all("/\" RANK=\"(.*?)\"\/>/", $alexa, $countryra);

$gra=array_unique($gr[1]);
$dra=array_unique($dr[1]);
$cra=array_unique($ca[1]);
$crac=array_unique($countryra[1]);

foreach($gra as $globalrank){
foreach($dra as $deltarank){
foreach($cra as $countryname){
foreach($crac as $countryrank){

	$laporan = "Domain: $urls\n";
	$laporan .= "Global Rank: $globalrank\n";
	$laporan .= "Delta Rank: $deltarank\n";
	$laporan .= "Country: $countryname\n";
	$laporan .= "Country Rank: $countryrank\n\n";
	echo $laporan;

					$fp = fopen("alexa.txt", 'a+');
						fwrite($fp, $laporan);
						fclose($fp);
				}
			}
		}
	}
}
?>
