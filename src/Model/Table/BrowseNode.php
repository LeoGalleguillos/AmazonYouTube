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

    public function select(): Generator
    {
        $sql = '
select amazon_you_tube.browse_node.browse_node_id
     , amazon_you_tube.browse_node.name as `browse_node_name`
     , max(you_tube.channel.channel_id) as `channel_id`
     , max(you_tube.app_channel.access_token) as `access_token`
     , max(you_tube.app_channel.access_token_expiration) as `access_token_expiration`
     , max(you_tube.app_channel.refresh_token) as `refresh_token`
     , count(*) as `count`
  from amazon_you_tube.browse_node

  join amazon_you_tube.browse_node_channel
    on amazon_you_tube.browse_node_channel.browse_node_id = amazon_you_tube.browse_node.browse_node_id

  join you_tube.channel
    on you_tube.channel.channel_id = amazon_you_tube.browse_node_channel.channel_id

left join you_tube.app_channel
    on you_tube.app_channel.channel_id = you_tube.channel.channel_id

  join amazon.browse_node
    on amazon.browse_node.name = amazon_you_tube.browse_node.name

  join amazon.browse_node_product
    on amazon.browse_node_product.browse_node_id = amazon.browse_node.browse_node_id

  join amazon.product_video
 using (product_id)

  left
  join amazon_you_tube.product_video_upload_log
 using (product_video_id)

 where amazon_you_tube.product_video_upload_log.created is null
   and amazon_you_tube.browse_node.active = 1

 group
    by amazon_you_tube.browse_node.browse_node_id

 order
    by `count` desc
     ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $array) {
            yield $array;
        }
    }

    public function selectWhereRefreshTokenIsNotNull(): Generator
    {
        $sql = '
select amazon_you_tube.browse_node.browse_node_id
     , amazon_you_tube.browse_node.name as `browse_node_name`
     , max(you_tube.channel.channel_id) as `channel_id`
     , max(you_tube.app_channel.access_token) as `access_token`
     , max(you_tube.app_channel.access_token_expiration) as `access_token_expiration`
     , max(you_tube.app_channel.refresh_token) as `refresh_token`
     , count(*) as `count`

  from amazon_you_tube.browse_node

  join amazon_you_tube.browse_node_channel
    on amazon_you_tube.browse_node_channel.browse_node_id = amazon_you_tube.browse_node.browse_node_id

  join you_tube.channel
    on you_tube.channel.channel_id = amazon_you_tube.browse_node_channel.channel_id

  join you_tube.app_channel
    on you_tube.app_channel.channel_id = you_tube.channel.channel_id

  join amazon.browse_node
    on amazon.browse_node.name = amazon_you_tube.browse_node.name

  join amazon.browse_node_product
    on amazon.browse_node_product.browse_node_id = amazon.browse_node.browse_node_id

  join amazon.product_video
 using (product_id)

  left
  join amazon_you_tube.product_video_upload_log
 using (product_video_id)

 where amazon_you_tube.product_video_upload_log.created is null
   and amazon_you_tube.browse_node.active = 1
   and you_tube.app_channel.refresh_token is not null

 group
    by amazon_you_tube.browse_node.browse_node_id

 order
    by `count` desc
     ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $array) {
            yield $array;
        }
    }
}
