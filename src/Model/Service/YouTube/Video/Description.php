<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Service\YouTube\Video;

use LeoGalleguillos\Amazon\Model\Entity as AmazonEntity;

class Description
{
    public function getDescription(
        AmazonEntity\ProductVideo $productVideoEntity
    ): string {
        $productEntity = $productVideoEntity->getProduct();
        $asin          = $productEntity->getAsin();

        $description = "Buy on Amazon: https://www.amazon.com/dp/$asin?tag=videosofproducts-youtube-20\n\n";
        $description .= implode("\n", array_map('strip_tags', $productEntity->getFeatures()));

        $description = preg_replace('/<|>/', '', $description);

        $description .= "\n\n";
        $description .= "Buy on Amazon: https://www.amazon.com/dp/$asin?tag=videosofproducts-youtube-20\n\n";

        return $description;
    }
}
