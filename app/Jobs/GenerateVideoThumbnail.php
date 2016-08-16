<?php

namespace App\Jobs;

use App\Jobs\Job;
use FFMpeg\FFMpeg;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Video\Video;

class GenerateVideoThumbnail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $video;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $destinationPath = public_path().'/video/thumbs/'. $this->video. ".jpg";

        $ffmpeg =  FFMpeg::create();
        $videoFile = $ffmpeg->open( public_path()."/video/". $this->video);
        $videoFile->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10))->save( $destinationPath );

        Video::where('filename', $this->video)->first()->update(['thumbnail' => $this->video.".jpg"]);

        $this->release(60);

    }
}
