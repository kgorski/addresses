<?php

namespace App\Services;

use App\Models\Address;
use Elasticsearch\Client;

/**
 * Class AddressService
 *
 * Service to handle addresses
 *
 * @package App\Services
 */
class AddressService
{
    /** @var Client $elasticsearch */
    protected $elasticsearch;

    /**
     * AddressService constructor
     *
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Get addresses from Elasticsearch
     *
     * @return array<Address>
     */
    public function getAddresses()
    {
        $result = $this->elasticsearch->search(
            [
                'index' => 'addresses',
                'type' => 'address',
            ]
        );

        $addresses = [];
        if (!empty($result['hits']['hits'])) {
            foreach ($result['hits']['hits'] as $item) {
                $address = new Address();
                $address->id = $item['_source']['id'];
                $address->street = $item['_source']['street'];
                $address->zip = $item['_source']['zip'];
                $address->city = $item['_source']['city'];
                $address->country = $item['_source']['country'];
                $address->created_at = $item['_source']['created_at'];
                $address->updated_at = $item['_source']['updated_at'];
                $addresses[] = $address;
            }
        }

        return $addresses;
    }

    /**
     * Stores address in database and Elasticsearch
     *
     * @param Address $address
     * @return Address
     */
    public function saveAddress(Address $address)
    {
        // Store address in database
        $address->save();

        // Store address in Elasticsearch
        $this->elasticsearch->index(
            [
                'index' => 'addresses',
                'type' => 'address',
                'id' => $address->id,
                'body' => json_encode($address)
            ]
        );

        return $address;
    }
}
