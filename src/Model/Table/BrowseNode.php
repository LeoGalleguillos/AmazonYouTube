<?php
namespace LeoGalleguillos\AmazonYouTube\Model\Table;

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
}
