<?php

/* get Sample from deezer and convert in ogg format */
function getSample($track_id){

	/* Folder to store ogg file */
	$dir_cache = 'stream/';

	if(!file_exists($dir_cache)){
		mkdir($dir_cache);
	}

	if(isset($track_id)){

		$track_id = (int) $track_id;
		$data = getTrackData($track_id);
		$data = json_decode($data);
		
		if($data != false && !isset($data->error)){

			if(isset($data->preview)){

				$file_info 	= parse_url($data->preview);
				$file 		= str_replace('.mp3', '.ogg', basename($file_info['path']));
				
				if(!file_exists($dir_cache.$file[0])){
					mkdir($dir_cache.$file[0], 0777);
				}

				if(!file_exists($dir_cache.$file[0].'/'.$file[1])){
					mkdir($dir_cache.$file[0].'/'.$file[1]);
				}

				$file = $dir_cache.$file[0].'/'.$file[1].'/'.$file;

				$dir = dirname($file);

				clean_cache($dir);

				if(!file_exists($file)){
					
					exec('ffmpeg -i '.$data->preview.' -f ogg -strict experimental -acodec vorbis -ab 192k '.$file.' &> /dev/null', $output, $return_var);

					return $file;

				}else{

					return $file;
				}
			}

		}else{
			throw new Exception("No data", 1);
		}

	}

}

/* clean cache */
function clean_cache($dir){

	if ($handle = opendir($dir)) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {

				$timefile = filemtime($dir.'/'.$entry); 
				$time = time()-86400;
			
				if($timefile < $time){
					unlink($dir.'/'.$entry);
				}
			}
		}
	}
}	

function getTrackData($track_id){

	if(isset($track_id)){

		$url  = "http://api.deezer.com/2.0/track/".$track_id;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);

		$data = curl_exec($ch);
		curl_close($ch);

		if($data === false){
			return false;
		}else{
			return $data;
		}

	}else{
		return false;
	}
}


?>