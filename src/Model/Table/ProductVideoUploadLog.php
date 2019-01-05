<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Table;

use Zend\Db\Adapter\Adapter;

class ProductVideoUploadLog
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(
        Adapter $adapter
    ) {
        $this->adapter   = $adapter;
    }

    public function insert(
        int $productVideoId,
        string $youTubeVideoId
    ): int {
        $sql = '
            INSERT
              INTO `product_video_upload_log` (
                       `product_video_id`
                     , `youtube_video_id`
                     , `created`
                   )
            VALUES (?, ?, UTC_TIMESTAMP())
                 ;
        ';
        $parameters = [
            $productVideoId,
            $youTubeVideoId,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }
}
