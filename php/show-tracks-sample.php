<?php

require "deezer-ogg-preview/php/ogg-sample.php";

// You need to clone this project : https://github.com/croustibat/Deezer-API-PHP-Wrapper
require "Deezer-API-PHP-Wrapper/class.deezerapi.php";
      
$dz = new deezerapi();

$listTracks = $dz->search('radiohead');

$oggTracks = array();

for($i=0; $i<5; $i++){
        
	$track =& $listTracks->data[$i];
        
        $file_url = getSample($track->id); // here is the OGG part, make sure you chmod your dir before
        
        $oggTracks[] = array(
          "title"         => $track->title,
          "artiste_name"  => $track->artist->name,
          "album_name"    => $track->album->title,
          "cover"         => $track->album->cover,
          "duration"      => $track->duration,
          "oggurl"        => $file_url
        );
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OGG Deezer Preview</title>
  </head>

  <body>

    <?php foreach($oggTracks as $ogg) { ?>
      <div class="well">
        <strong><?php echo $ogg['artiste_name'];?> - <?php echo $ogg['title'];?></strong>
        <em><?php echo $ogg['album_name'];?></em>
        <br />
        <img src="<?php echo $ogg['cover'];?>" width="96" />
        <br />
        <audio controls="controls">
          <source src="<?php echo $ogg['oggurl']?>" type="audio/ogg" />
          Your browser does not support the audio tag.
        </audio>
      </div>
    <?php } ?>

  </body>
</html>