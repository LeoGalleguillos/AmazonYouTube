<?php
namespace LeoGalleguillos\AmazonYouTube;

use LeoGalleguillos\AmazonYouTube\Model\Factory as AmazonYouTubeFactory;
use LeoGalleguillos\AmazonYouTube\Model\Service as AmazonYouTubeService;
use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;
use LeoGalleguillos\AmazonYouTube\View\Helper as AmazonYouTubeHelper;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                AmazonYouTubeService\BrowseNode\NumberOfVideosNotYetUploaded::class => function ($sm) {
                    return new AmazonYouTubeService\BrowseNode\NumberOfVideosNotYetUploaded(
                        $sm->get(AmazonYouTubeTable\ProductVideoUploadLog::class)
                    );
                },
                AmazonYouTubeService\YouTube\Video\Description::class => function ($sm) {
                    return new AmazonYouTubeService\YouTube\Video\Description(
                    );
                },
                AmazonYouTubeTable\ProductVideoUploadLog::class => function ($sm) {
                    return new AmazonYouTubeTable\ProductVideoUploadLog(
                        $sm->get('amazon-you-tube')
                    );
                },
            ],
        ];
    }
}
