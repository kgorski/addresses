@extends('layouts.app')

@section('title', 'Addresses list')

@section('content')
    <h1>Addresses list</h1>

    <a href="{{ route('address-form') }}">Add address</a>

    <table border="1px">
        <thead>
            <tr>
                <th>Street</th>
                <th>ZIP</th>
                <th>City</th>
                <th>Country</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
        @if (count($addresses) > 0)
            @foreach ($addresses as $address)
            <tr>
                <td>{{ $address->street }}</td>
                <td>{{ $address->zip }}</td>
                <td>{{ $address->city }}</td>
                <td>{{ $address->country }}</td>
                <td>{{ $address->created_at }}</td>
            </tr>
            @endforeach
        @else
            <tr><td colspan="5">No addresses yet, please <a href="{{ route('address-form') }}">add address</a> first</td></tr>
        @endif
        </tbody>
    </table>
@endsection
