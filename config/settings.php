<?php

return [
    // HandBrake location for video encoding
    // windows : d:\bin\HandBrakeCLI.exe
    // linux : /usr/local/bin/HandBrakeCLI
    'HandBrakeCLI' => '/usr/bin/HandBrakeCLI',

    // HLS Streaming server
    // "http://localhost:8081/vod/26/videos/smil:stream.smil/playlist.m3u8
    'streaming_server' => 'http://stream.nurflixtv.com/vod/',
    //'streaming_server' => 'https://nurflixtv.com/vod/',
];
