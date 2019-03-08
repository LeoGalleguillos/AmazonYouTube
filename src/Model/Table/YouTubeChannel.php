<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Table;

use DateTime;
use Generator;
use Zend\Db\Adapter\Adapter;

class YouTubeChannel
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

    public function insertOnDuplicateKeyUpdate(
        int $youTubeChannelId,
        int $browseNodeId,
        string $accessToken,
        DateTime $accessTokenExpiration,
        string $refreshToken
    ): int {
        $sql = '
            INSERT
              INTO `you_tube_channel` (
                       `you_tube_channel_id`
                     , `browse_node_id`
                     , `access_token`
                     , `access_token_expiration`
                     , `refresh_token`
                   )
            VALUES (?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                   `access_token` = ?
                 , `access_token_expiration` = ?
                 , `refresh_token` = ?
                 ;
        ';
        $parameters = [
            $youTubeChannelId,
            $browseNodeId,
            $accessToken,
            $accessTokenExpiration->format('Y-m-d h:i:s'),
            $refreshToken,
            $accessToken,
            $accessTokenExpiration->format('Y-m-d h:i:s'),
            $refreshToken,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getAffectedRows();
    }
}
