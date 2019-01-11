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
        AmazonEntity\BrowseNode $browseNodeEntity
    ): int {
        return (int) $this
            ->productVideoUploadLogTable
            ->selectCountWhereBrowseNodeIdEqualsAndProductVideoUploadLogCreatedIsNull(
                $browseNodeEntity->getBrowseNodeId()
            );
    }
}
