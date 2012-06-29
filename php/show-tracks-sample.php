<?php

require "deezer-ogg-preview/php/ogg-sample.php";

// You need to clone this project : https://github.com/croustibat/Deezer-API-PHP-Wrapper
require "Deezer-API-PHP-Wrapper/class.deezerapi.php";
      
$dz = new deezerapi();

$listTracks = $dz->search('radiohead');

$oggTracks = array();

for($i=0; $i<5; $i++){
        
	$track =& $listTracks->data[$i];
        
        $file = getSample($track->id); // here is the OGG part, make sure you chmod your dir before
        $file_url = "/dzogg/".$file;    
        
        $oggTracks[] = array(
          "title"         => $track->title,
          "artiste_name"  => $track->artist->name,
          "album_name"    => $track->album->title,
          "cover"         => $track->album->cover,
          "duration"      => $track->duration,
          "oggurl"        => $file_url
        );
}
