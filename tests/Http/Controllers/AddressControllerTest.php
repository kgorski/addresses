<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    /**
     * Test for addressesList
     *
     * @return void
     */
    public function testAddressesList()
    {
        $this->visit('/')->see('Addresses list');
    }

    /**
     * Test for addressesList
     *
     * @return void
     */
    public function testAddressForm()
    {
        $this->visit('/address-form')->see('Add address form');
    }
}
