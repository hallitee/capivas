<?php

return [
    'ffmpeg' => [
        //'binaries' => env('FFMPEG_BINARIES', 'ffmpeg'),
        'binaries'  => 'C:/FFmpeg/bin/ffmpeg.exe',
        'threads'  => 12,
    ],

    'ffprobe' => [
        //'binaries' => env('FFPROBE_BINARIES', 'ffprobe'),
        'binaries' => 'C:/FFmpeg/bin/ffprobe.exe',
    ],

    'timeout' => 3600,

    'enable_logging' => true,
];
