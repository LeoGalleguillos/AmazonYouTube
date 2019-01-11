<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Service\BrowseNode;

use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;

class NumberOfVideosNotYetUploaded
{
    public function __construct(
        AmazonYouTubeTable\ProductVideoUploadLog $productVideoUploadLogTable
    ) {
        $this->productVideoUploadLogTable = $productVideoUploadLogTable;
    }

    public function getNumberOfVideosNotYetUploaded(
        string $browseNodeName
    ): int {
        return (int) $this
            ->productVideoUploadLogTable
            ->selectCountWhereBrowseNodeNameEqualsAndProductVideoUploadLogCreatedIsNull(
                $browseNodeName
            );
    }
}
