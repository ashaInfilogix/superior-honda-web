@extends('layouts.my-account')

@section('my-account')
    <h2 class="account__content--title h3 mb-20">Orders History</h2>
    <div class="account__table--area">
        <table class="account__table">
            <thead class="account__table--header">
                <tr class="account__table--header__child">
                    <th class="account__table--header__child--items">Order</th>
                    <th class="account__table--header__child--items">Date</th>
                    <th class="account__table--header__child--items">Payment Status</th>
                    <th class="account__table--header__child--items">Order Status</th>
                    <th class="account__table--header__child--items">Total</th>
                    <th class="account__table--header__child--items">Action</th>	 	 	 	
                </tr>
            </thead>
            <tbody class="account__table--body mobile__none">
                @foreach($orders as $key => $order)
                @php
                    $cart = json_decode($order->cart_items);
                    $grandTotal = $cart->formatted_grand_total;
                @endphp
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">{{ $order->order_id }}</td>
                    <td class="account__table--body__child--items">{{ $order->created_at }}</td>
                    <td class="account__table--body__child--items">N/A</td>
                    <td class="account__table--body__child--items">{{ $order->status }}</td>
                    <td class="account__table--body__child--items">{{ $grandTotal }}</td>
                    <td class="account__table--body__child--items"><a href="{{ route('dashboard.show', $order->id) }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-eye">
                        <path d="M12 2a10 10 0 0 0-7 16c1.18-2.32 3.45-4 6-4s4.82 1.68 6 4a10 10 0 0 0-7-16zm0 4a2 2 0 1 1-2 2 2 2 0 0 1 2-2zm0 2c-2.67 0-5 2.33-5 5 0 1.1.45 2.1 1.17 2.83A5.992 5.992 0 0 0 12 17a5.992 5.992 0 0 0 3.83-1.17C17.55 15.1 18 14.1 18 13c0-2.67-2.33-5-5-5z"/>
                      </svg>
                      </a></td>
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
                @foreach($orders as $key => $order)
                @php
                    $cart = json_decode($order->cart_items);
                    $grandTotal = $cart->formatted_grand_total;
                @endphp
                <tr class="account__table--body__child">
                    <td class="account__table--body__child--items">
                        <strong>Order</strong>
                        <span>{{ $order->order_id }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Date</strong>
                        <span>{{ $order->created_at }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Payment Status</strong>
                        <span>Paid</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Order Status</strong>
                        <span>{{ $order->status }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Total</strong>
                        <span>{{ $grandTotal }}</span>
                    </td>
                    <td class="account__table--body__child--items">
                        <strong>Action</strong>
                        <span><a href="{{ route('dashboard.show', $order->id) }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-eye">
                                <path d="M12 2a10 10 0 0 0-7 16c1.18-2.32 3.45-4 6-4s4.82 1.68 6 4a10 10 0 0 0-7-16zm0 4a2 2 0 1 1-2 2 2 2 0 0 1 2-2zm0 2c-2.67 0-5 2.33-5 5 0 1.1.45 2.1 1.17 2.83A5.992 5.992 0 0 0 12 17a5.992 5.992 0 0 0 3.83-1.17C17.55 15.1 18 14.1 18 13c0-2.67-2.33-5-5-5z"/></svg>
                            </a>
                        </span>
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