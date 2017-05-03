<?php
use PHPUnit\Framework\TestCase;
use Microsoft\Graph\Test\GraphTestBase;
use Microsoft\Graph\Model;

class SharepointTest extends TestCase
{
    private $_client;

    protected function setUp()
    {
        $graphTestBase = new GraphTestBase();
        $this->_client = $graphTestBase->graphClient;
        $this->_client->setApiVersion("stagingv1.0");
    }

	public function testAccessRootSite()
    {
        $files = $this->_client->createRequest("GET", "/sites/root/drive/root/children")
            ->setReturnType(Model\DriveItem::class)
            ->execute();

        $this->assertNotNull($files);
    }

    public function testSearch()
    {
        $results = $this->_client->createRequest("GET", "/sites/root?search='a'")
            ->setReturnType(Model\Site::class)
            ->execute();

        $this->assertNotNull($results);
    }
}