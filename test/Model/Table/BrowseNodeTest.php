<?php
namespace LeoGalleguillos\AmazonYouTubeTest\Model\Table;

use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;
use LeoGalleguillos\Test\TableTestCase;

class BrowseNodeTest extends TableTestCase
{
    protected function setUp()
    {
        $this->browseNodeTable = new AmazonYouTubeTable\BrowseNode(
            $this->getAdapter()
        );

        $this->setForeignKeyChecks0();
        $this->dropTable('browse_node');
        $this->createTable('browse_node');
        $this->setForeignKeyChecks1();
    }

    public function testInsert()
    {
        $this->assertSame(
            $this->browseNodeTable->insert('Shoes', 1),
            1
        );
    }
}
