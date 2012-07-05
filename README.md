# Deezer ogg preview conversion

A small script to play audio preview from deezer with html5 audio tag.

Browser :
* Firefox 
* Chrome
* Safari (*)
* Internet Explorer (*)
* Opera

(*) Works without ogg format conversion

## Deezer API

[Read more about Deezer API](http://developers.deezer.com/api)

## Requirements

* ffmpeg
* php

### ffmpeg install (Debian)

    sudo apt-get update
    sudo apt-get install ffmpeg
    
### Conversion Test

Try to execute this command, if you found a file named test.ogg, then you're brainy ! it works :) 

     ffmpeg -i http://cdn-preview-a.deezer.com/stream/a4e149e52e2ffdc4f057661b40ba7ee3-1.mp3 -f ogg -strict experimental -acodec vorbis -ab 192k test.ogg

## How to use ?

* Get a deezer track id from [Deezer API](http://developers.deezer.com/api) - you can also use this wrapper for a quick start [Deezer-API-PHP-Wrapper](https://github.com/croustibat/Deezer-API-PHP-Wrapper)

* Call the function getSample($track_id) (The function calls Deezer API to get the audio preview url and directly convert it into ogg format. 
The ogg file will be stored in a stream folder)

* getSample return the path of the ogg file.