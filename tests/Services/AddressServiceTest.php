<?php

namespace Tests\Services;

use App\Services\AddressService;
use Tests\TestCase;

/**
 * Class AddressServiceTest
 *
 * Unit tests for Address service
 *
 * @package Tests\Services
 */
class AddressServiceTest extends TestCase
{
    const UUID_FIRST = '123-456-789';
    const UUID_SECOND = '987-654-321';

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $clientMock;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $addressMock;

    /** @var AddressService */
    protected $addressService;

    /**
     * Setup method
     */
    public function setUp()
    {
        parent::setUp();

        $this->clientMock = $this
            ->getMockBuilder('Elasticsearch\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressMock = $this
            ->getMockBuilder('App\Models\Address')
            ->getMock();
        $this->addressMock->id = 1;
        $this->addressMock->street = 'Street';
        $this->addressMock->zip = 'Zip';
        $this->addressMock->country = 'Country';
        $this->addressMock->city = 'City';
        $this->addressMock->created_at = '2016-07-29 12:34:56';
        $this->addressMock->updated_at = '2016-08-29 12:34:56';

        $this->addressService = new AddressService($this->clientMock);
    }

    /**
     * Unit test for getAddresses
     */
    public function testGetAddresses()
    {
        $this->clientMock->expects($this->once())
            ->method('search')
            ->with(
                [
                    'index' => 'addresses',
                    'type' => 'address',
                ]
            )
            ->willReturn(
                [
                    'hits' => [
                        'hits' => [
                            [
                                '_source' => [
                                    'id' => $this->addressMock->id,
                                    'street' => $this->addressMock->street,
                                    'zip' => $this->addressMock->zip,
                                    'city' => $this->addressMock->city,
                                    'country' => $this->addressMock->country,
                                    'created_at' => $this->addressMock->created_at,
                                    'updated_at' => $this->addressMock->updated_at,
                                ]
                            ]
                        ]
                    ]
                ]
            );

        $result = $this->addressService->getAddresses();
        $this->assertEquals($this->addressMock->id, $result[0]->id);
        $this->assertEquals($this->addressMock->street, $result[0]->street);
        $this->assertEquals($this->addressMock->zip, $result[0]->zip);
        $this->assertEquals($this->addressMock->city, $result[0]->city);
        $this->assertEquals($this->addressMock->country, $result[0]->country);
        $this->assertEquals($this->addressMock->created_at, $result[0]->created_at);
        $this->assertEquals($this->addressMock->updated_at, $result[0]->updated_at);
    }

    /**
     * Unit test for saveAddress
     */
    public function testSaveAddress()
    {
        $this->addressMock->expects($this->once())
            ->method('save');

        $this->clientMock->expects($this->once())
            ->method('index')
            ->with(
                [
                    'index' => 'addresses',
                    'type' => 'address',
                    'id' => $this->addressMock->id,
                    'body' => json_encode($this->addressMock)
                ]
            );

        $result = $this->addressService->saveAddress($this->addressMock);
        $this->assertEquals($this->addressMock, $result);
    }
}
