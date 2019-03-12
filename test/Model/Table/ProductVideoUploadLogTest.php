<?php
namespace LeoGalleguillos\AmazonYouTubeTest\Model\Table;

use DateTime;
use LeoGalleguillos\AmazonYouTube\Model\Table as AmazonYouTubeTable;
use LeoGalleguillos\Test\TableTestCase;
use Zend\Db\Adapter\Exception\InvalidQueryException;

class ProductVideoUploadLogTest extends TableTestCase
{
    protected function setUp()
    {
        $this->productVideoUploadTable = new AmazonYouTubeTable\ProductVideoUploadLog(
            $this->getAdapter()
        );

        $this->dropTable('product_video_upload_log');
        $this->createTable('product_video_upload_log');
    }

    public function testInsert()
    {
        $this->assertSame(
            $this->productVideoUploadTable->insert(12345, 'abcdefg'),
            1
        );

        $this->assertSame(
            $this->productVideoUploadTable->insert(56789, 'abcdefg'),
            2
        );

        try {
            $this->productVideoUploadTable->insert(12345, 'abcdefg');
            $this->fail();
        } catch (InvalidQueryException $invalidQueryException) {
            $this->assertSame(
                'Statement could not be executed',
                substr($invalidQueryException->getMessage(), 0, 31)
            );
        }
    }

    public function testSelectCountWhereCreatedGreaterThanOrEqualTo()
    {
        $this->assertSame(
            0,
            $this->productVideoUploadTable->selectCountWhereCreatedGreaterThanOrEqualTo(
                new DateTime()
            )
        );
    }
}
