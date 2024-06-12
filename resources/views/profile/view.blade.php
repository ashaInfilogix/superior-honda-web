@extends('layouts.my-account')

@section('my-account')
    <h2 class="account__content--title h3 mb-20">Order Detail</h2>
    <div class="account__table--area">
        <?php
            $cartProducts = json_decode($order->cart_items);
        ?>
        <table class="account__table">
            <thead class="account__table--header">
                <tr class="account__table--header__child">
                    <th class="account__table--header__child--items">#</th>
                    <th class="account__table--header__child--items">Product Name</th>
                    <th class="account__table--header__child--items">Product Code</th>
                    <th class="account__table--header__child--items">Quantity</th>
                    <th class="account__table--header__child--items">Price</th>	 	 	 	
                </tr>
            </thead>
            <tbody class="account__table--body mobile__none">
                @foreach ($cartProducts->products as $key => $cart)
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">{{ $key + 1 }}</td>
                    <td class="account__table--body__child--items">{{ $cart->name }}</td>
                    <td class="account__table--body__child--items">{{ $cart->product_code }}</td>
                    <td class="account__table--body__child--items">{{ $cart->quantity }}</td>
                    <td class="account__table--body__child--items">{{ '$'.number_format($cart->price, 2) }}</td>
                </tr>
                @endforeach
                {{-- <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">#2164</td>
                    <td class="account__table--body__child--items">November 24, 2022</td>
                    <td class="account__table--body__child--items">Paid</td>
                    <td class="account__table--body__child--items">Unfulfilled</td>
                    <td class="account__table--body__child--items">$36.00 USD</td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">#2345</td>
                    <td class="account__table--body__child--items">November 24, 2022</td>
                    <td class="account__table--body__child--items">Paid</td>
                    <td class="account__table--body__child--items">Unfulfilled</td>
                    <td class="account__table--body__child--items">$87.00 USD</td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">#1244</td>
                    <td class="account__table--body__child--items">November 24, 2022</td>
                    <td class="account__table--body__child--items">Paid</td>
                    <td class="account__table--body__child--items">Fulfilled</td>
                    <td class="account__table--body__child--items">$66.00 USD</td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">#3455</td>
                    <td class="account__table--body__child--items">November 24, 2022</td>
                    <td class="account__table--body__child--items">Paid</td>
                    <td class="account__table--body__child--items">Fulfilled</td>
                    <td class="account__table--body__child--items">$55.00 USD</td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">#4566</td>
                    <td class="account__table--body__child--items">November 24, 2022</td>
                    <td class="account__table--body__child--items">Paid</td>
                    <td class="account__table--body__child--items">Unfulfilled</td>
                    <td class="account__table--body__child--items">$87.00 USD</td>
                </tr> --}}
            </tbody>
            <tbody class="account__table--body mobile__block">
                @foreach ($cartProducts->products as $key => $cart)
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>#</strong>
                        <span>{{ $key + 1 }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Product Name</strong>
                        <span>{{ $cart->name }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Product Code</strong>
                        <span>{{ $cart->product_code }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Quantity</strong>
                        <span>{{ $cart->quantity }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Price</strong>
                        <span>{{ '$'.number_format($cart->price, 2) }}</span>
                    </td>
                </tr>
                @endforeach
                {{-- <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr>
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>#2014</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>November 24, 2022</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Fulfillment Status</strong>
                        <span>Unfulfilled</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>$40.00 USD</span>
                    </td>
                </tr> --}}
            </tbody>
        </table>
    </div>
@endsection