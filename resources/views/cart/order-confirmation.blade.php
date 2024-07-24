@extends('layouts.app')

@section('content')
<div class="container" style="padding: 87px;">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <p>
                        "Your order has been successfully placed! Your order ID is <span class="order-id">{{ request()->input('order') }}</span>. Thank you for choosing us!"
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
