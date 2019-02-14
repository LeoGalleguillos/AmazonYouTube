<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

class BrowseNode
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
        string $name,
        int $active
    ): int {
        $sql = '
            INSERT
              INTO `browse_node` (
                       `name`
                     , `active`
                   )
            VALUES (?, ?)
                 ;
        ';
        $parameters = [
            $name,
            $active,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function selectBrowseNodeNameCount(): Generator
    {
        $sql = '
            select amazon_you_tube.browse_node.name
                 , count(*) as `count`
              from amazon_you_tube.browse_node

              join amazon.browse_node
             using (name)

              join amazon.browse_node_product
                on amazon.browse_node_product.browse_node_id = amazon.browse_node.browse_node_id

              join amazon.product_video
             using (product_id)

              left
              join amazon_you_tube.product_video_upload_log
             using (product_video_id)

             where amazon_you_tube.product_video_upload_log.created is null

             group
                by amazon_you_tube.browse_node.name

             order
                by `count` desc
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $array) {
            yield $array;
        }
    }
}
