<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;


class CompressVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $originalPath;
    protected $videoName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($originalPath, $videoName )
    {
        $this->originalPath = $originalPath;
        $this->videoName = $videoName;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $savePath = 'compressed/';
         // Compress the video
         FFMpeg::fromDisk('public')
         ->open($this->originalPath)
         ->export()
         ->toDisk('public')
         ->inFormat(new X264('aac'))
         ->save($savePath .$this->videoName);

     Storage::disk('public')->delete($this->originalPath);

    }
}
