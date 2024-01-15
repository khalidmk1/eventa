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

    protected $videoData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($videoData)
    {
        $this->videoData = $videoData;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $video = $this->videoData;

        if ($video && $video->isValid()) {
            $originalName = time() . '_' . $video->getClientOriginalName();
            $storagePath = $video->storeAs('event/video', $originalName, 'public');
            $eventasset->video = $originalName;
        }

    }
}
