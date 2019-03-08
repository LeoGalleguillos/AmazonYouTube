<?php
namespace LeoGalleguillos\AmazonYouTubeTest\Model\Table;

use DateTime;
use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;
use LeoGalleguillos\Test\TableTestCase;

class YouTubeChannelTest extends TableTestCase
{
    protected function setUp()
    {
        $this->youTubeChannelTable = new AmazonYouTubeTable\YouTubeChannel(
            $this->getAdapter()
        );

        $this->dropTable('you_tube_channel');
        $this->createTable('you_tube_channel');
    }

    public function testInsertOnDuplicateKeyUpdate()
    {
        $affectedRows = $this->youTubeChannelTable->insertOnDuplicateKeyUpdate(
            1,
            1,
            'access_token',
            new DateTime(),
            'refresh_token'
        );
        $this->assertSame(
            1,
            $affectedRows
        );
    }
}
