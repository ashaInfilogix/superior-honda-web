@extends('layouts.my-account')

@section('my-account')
    <div class="account__content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="account__content--title h3 mb-20">Addresses</h2>
        <a href="{{ route('addresses.create') }}" class="new__address--btn primary__btn mb-25">Add a new address</a>
        @isset($addresses)
            <div class="row">
                @foreach ($addresses as $address)
                @if ($address->is_default == 1)
                <h3 class="account__details--title h4">Default</h3>
            @endif
                    <div class="col-md-4">

                        <p class="account__details--desc">
                            {{ $address->full_name }} <br>
                            {{ $address->address }} <br>
                            {{ $address->city }} {{ $address->postal_code }} <br>
                            {{ $address->state->name }}, {{ $address->country->name }}
                        </p>

                        <div class="account__details--footer d-flex">
                            <a class="account__details--footer__btn"
                                href="{{ route('addresses.edit', ['address' => $address->id]) }}">Edit</a>
                            <button class="account__details--footer__btn delete-btn" data-source="address"
                                data-endpoint="{{ route('addresses.destroy', $address->id) }}">Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h4>No address available</h4>
        @endisset
    </div>
@endsection
