<?php
namespace LeoGalleguillos\AmazonTest\Model\Service;

use LeoGalleguillos\Amazon\Model\Entity as AmazonEntity;
use LeoGalleguillos\AmazonYouTube\Model\Service as AmazonYouTubeService;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    protected function setUp(): void
    {
        $this->descriptionService = new AmazonYouTubeService\YouTube\Video\Description();
    }

    public function testGetDescription()
    {
        $productEntity = new AmazonEntity\Product();
        $productEntity->setAsin('ASIN12345')
            ->setFeatures([
            'This is the first feature. <',
            'This is the <b>second</b> feature.',
        ]);

        $productVideoEntity = new AmazonEntity\ProductVideo();

        $productVideoEntity->setProduct($productEntity);

        $this->assertSame(
            "Buy on Amazon: https://www.amazon.com/dp/ASIN12345?tag=videosofproducts-youtube-20\n"
            . "\n"
            . "This is the first feature. \n"
            . "This is the second feature.\n"
            . "\n"
            . "Buy on Amazon: https://www.amazon.com/dp/ASIN12345?tag=videosofproducts-youtube-20\n\n"
            ,
            $this->descriptionService->getDescription($productVideoEntity)
        );
    }
}
