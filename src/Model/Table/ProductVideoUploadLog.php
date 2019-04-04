<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Table;

use DateTime;
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
        int $youTubeChannelId,
        string $youTubeVideoId
    ): int {
        $sql = '
            INSERT
              INTO `product_video_upload_log` (
                       `product_video_id`
                     , `you_tube_channel_id`
                     , `you_tube_video_id`
                     , `created`
                   )
            VALUES (?, ?, ?, UTC_TIMESTAMP())
                 ;
        ';
        $parameters = [
            $productVideoId,
            $youTubeChannelId,
            $youTubeVideoId,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function selectCountWhereBrowseNodeNameEqualsAndProductVideoUploadLogCreatedIsNull(
        string $browseNodeName
    ): int {
        $sql = '
            SELECT COUNT(*) AS `count`

              from amazon.product

              join amazon.product_video
             using (product_id)

              join amazon.browse_node_product
             using (product_id)

              join amazon.browse_node using (browse_node_id)

              left
              join amazon_you_tube.product_video_upload_log using (product_video_id)

             where amazon.browse_node.name = ?
               and amazon_you_tube.product_video_upload_log.created is null
                ;
        ';
        $parameters = [
            $browseNodeName,
        ];
        $array = $this->adapter->query($sql)->execute($parameters)->current();
        return (int) $array['count'];
    }

    public function selectCountWhereCreatedGreaterThanOrEqualTo(
        DateTime $created
    ): int {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `product_video_upload_log`
             WHERE `created` >= ?
                 ;
        ';
        $parameters = [
            $created->format('Y-m-d h:i:s'),
        ];
        $array = $this->adapter->query($sql)->execute($parameters)->current();
        return (int) $array['count'];
    }
}
