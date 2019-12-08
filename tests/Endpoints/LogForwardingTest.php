<?php

namespace AcquiaCloudApi\Tests\Endpoints;

use AcquiaCloudApi\Tests\CloudApiTestCase;
use AcquiaCloudApi\Endpoints\LogForwardingDestinations;

class LogForwardingTest extends CloudApiTestCase
{

    public $properties = [
    'uuid',
    'label',
    'address',
    'consumer',
    'credentials',
    'sources',
    'status',
    'flags',
    'health',
    'environment'
    ];

    public function testGetLogForwardingDestinations()
    {

        $response = $this->getPsr7JsonResponseForFixture('Endpoints/getLogForwardingDestinations.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);
        $result = $environment->getAll('14-0c7e79ab-1c4a-424e-8446-76ae8be7e851');

        $this->assertInstanceOf('\ArrayObject', $result);
        $this->assertInstanceOf('\AcquiaCloudApi\Response\LogForwardingDestinationsResponse', $result);

        foreach ($result as $record) {
            $this->assertInstanceOf('\AcquiaCloudApi\Response\LogForwardingDestinationResponse', $record);

            foreach ($this->properties as $property) {
                $this->assertObjectHasAttribute($property, $record);
            }
        }
    }

    public function testGetLogForwardingDestination()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/getLogForwardingDestination.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);
        $result = $environment->get('8ff6c046-ec64-4ce4-bea6-27845ec18600', 3);

        $this->assertNotInstanceOf('\AcquiaCloudApi\Response\LogForwardingDestinationsResponse', $result);
        $this->assertInstanceOf('\AcquiaCloudApi\Response\LogForwardingDestinationResponse', $result);

        foreach ($this->properties as $property) {
              $this->assertObjectHasAttribute($property, $result);
        }
    }

    public function testCreateLogForwardingDestination()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/createLogForwardingDestination.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);

        $result = $environment->create(
            '14-0c7e79ab-1c4a-424e-8446-76ae8be7e851',
            'Test destination',
            ["apache-access", "apache-error"],
            'syslog',
            ["certificate" => "-----BEGIN CERTIFICATE-----...-----END CERTIFICATE-----"],
            'example.com:1234'
        );

        $this->assertInstanceOf('\AcquiaCloudApi\Response\OperationResponse', $result);

        $this->assertEquals('Log forwarding destination for the environment has been created.', $result->message);
    }

    public function testDeleteLogForwardingDestination()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/deleteLogForwardingDestination.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);
        $result = $environment->delete('14-0c7e79ab-1c4a-424e-8446-76ae8be7e851', 14);

        $this->assertInstanceOf('\AcquiaCloudApi\Response\OperationResponse', $result);

        $this->assertEquals('Log forwarding destination has been deleted.', $result->message);
    }

    public function testEnableLogForwardingDestination()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/enableLogForwardingDestination.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);
        $result = $environment->enable('14-0c7e79ab-1c4a-424e-8446-76ae8be7e851', 2);

        $this->assertInstanceOf('\AcquiaCloudApi\Response\OperationResponse', $result);

        $this->assertEquals('Log forwarding destination has been enabled.', $result->message);
    }

    public function testDisableLogForwardingDestination()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/disableLogForwardingDestination.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);
        $result = $environment->disable('14-0c7e79ab-1c4a-424e-8446-76ae8be7e851', 2);

        $this->assertInstanceOf('\AcquiaCloudApi\Response\OperationResponse', $result);

        $this->assertEquals('Log forwarding destination has been disabled.', $result->message);
    }

    public function testUpdateLogForwardingDestination()
    {
        $response = $this->getPsr7JsonResponseForFixture('Endpoints/updateLogForwardingDestination.json');
        $client = $this->getMockClient($response);

        /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $environment = new LogForwardingDestinations($client);
        $result = $environment->update(
            '14-0c7e79ab-1c4a-424e-8446-76ae8be7e851',
            12,
            'Test destination',
            ["apache-access", "apache-error"],
            'syslog',
            ["certificate" => "-----BEGIN CERTIFICATE-----...-----END CERTIFICATE-----"],
            'example.com:1234'
        );

        $this->assertInstanceOf('\AcquiaCloudApi\Response\OperationResponse', $result);

        $this->assertEquals('Log forwarding destination has been updated.', $result->message);
    }
}