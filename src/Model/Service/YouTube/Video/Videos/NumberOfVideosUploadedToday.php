<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Service\YouTube\Video\Videos;

use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;

class NumberOfVideosUploadedToday
{
    public function __construct(
        AmazonYouTubeTable\ProductVideoUploadLog $productVideoUploadLogTable
    ) {
        $this->productVideoUploadLogTable = $productVideoUploadLogTable;
    }

    /**
     * Today is in PST. YouTube allows about 600 uploads per day.
     */
    public function getNumberOfVideosUploadedToday(): int
    {
        return 0;
    }
}
