<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class AddressController
 *
 * Address controller
 *
 * @package App\Http\Controllers
 */
class AddressController extends BaseController
{
    use ValidatesRequests;

    /** @var AddressService $address */
    protected $addressService;

    /**
     * AddressController constructor.
     * @param AddressService $addressService
     */
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Addresses list
     *
     * @return Factory
     */
    public function addressesList()
    {
        return view('addressesList', ['addresses' => $this->addressService->getAddresses()]);
    }

    /**
     * Address form
     *
     * @return Factory
     */
    public function addressForm()
    {
        return view('addressForm');
    }

    /**
     * Store address
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addressCreate(Request $request)
    {
        $this->validate(
            $request,
            [
                'street' => 'required',
                'zip' => 'required',
                'city' => 'required',
                'country' => 'required',
            ]
        );

        $address = new Address();
        $address->street = $request->get('street');
        $address->zip = $request->get('zip');
        $address->city = $request->get('city');
        $address->country = $request->get('country');

        $this->addressService->saveAddress($address);

        return redirect()->route('addresses-list');
    }
}
