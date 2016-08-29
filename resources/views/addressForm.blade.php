@extends('layouts.app')

@section('title', 'Add address form')

@section('content')
    <h1>Add address form</h1>

    @if (isset($errors) && count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route' => 'address-create', 'class' => 'form']) !!}
    <div>
        {!! Form::label('Street') !!}
        {!! Form::text('street', null, ['required']) !!}
    </div>
    <div>
        {!! Form::label('ZIP') !!}
        {!! Form::text('zip', null, ['required']) !!}
    </div>
    <div>
        {!! Form::label('City') !!}
        {!! Form::text('city', null, ['required']) !!}
    </div>
    <div>
        {!! Form::label('Country') !!}
        {!! Form::text('country', null, ['required']) !!}
    </div>
    <div>
        {!! Form::submit('Add address') !!}
    </div>
    {!! Form::close() !!}
@endsection
