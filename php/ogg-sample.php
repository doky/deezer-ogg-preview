<?php

function getSample($track_id){

	/* Folder to store ogg file */
	$dir_cache = 'stream/';

	if(!file_exists($dir_cache)){
		mkdir($dir_cache);
	}

	if(isset($track_id)){

		$track_id = intval($track_id);
		$url      = "http://api.deezer.com/2.0/track/".$track_id;
		$data     = json_decode(file_get_contents($url));

		if($data != false && !isset($data->error)){

			if(isset($data->preview)){

				$file_info 	= parse_url($data->preview);
				$file 		= str_replace('.mp3', '.ogg', basename($file_info['path']));
				
				if(!file_exists($dir_cache.$file[0])){
					mkdir($dir_cache.$file[0]);
				}

				if(!file_exists($dir_cache.$file[0].'/'.$file[1])){
					mkdir($dir_cache.$file[0].'/'.$file[1]);
				}

				$file = $dir_cache.$file[0].'/'.$file[1].'/'.$file;

				if(!file_exists($file)){
					
					exec('ffmpeg -i '.$data->preview.' -f ogg -strict experimental -acodec vorbis -ab 192k '.$file.' > /dev/null 2>&1', $output, $return_var);
					
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


?>