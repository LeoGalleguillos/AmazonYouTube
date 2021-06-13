<?php
namespace LeoGalleguillos\AmazonTest\Model\Service;

use LeoGalleguillos\AmazonYouTube\Model\Service as AmazonYouTubeService;
use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;
use PHPUnit\Framework\TestCase;

class NumberOfVideosUploadedTodayTest extends TestCase
{
    protected function setUp(): void
    {
        $this->productVideoUploadLogTableMock = $this->createMock(
            AmazonYouTubeTable\ProductVideoUploadLog::class
        );

        $this->numberOfVideosUploadedTodayService = new AmazonYouTubeService\YouTube\Video\Videos\NumberOfVideosUploadedToday(
            $this->productVideoUploadLogTableMock
        );
    }

    public function testGetNumberOfVideosUploadedToday()
    {
        $this->assertSame(
            0,
            $this->numberOfVideosUploadedTodayService->getNumberOfVideosUploadedToday()
        );
    }
}
