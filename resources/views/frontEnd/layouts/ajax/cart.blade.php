@php
    $subtotal = \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotal();
    $subtotal = str_replace(',', '', $subtotal);
    $subtotal = str_replace('.00', '', $subtotal);
    $shipping = Session::get('shipping') ?? 0;
    $coupon = Session::get('coupon_amount') ?? 0;
    $discount = Session::get('discount') ?? 0;
    $cartcontent = \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content();
@endphp
@foreach ($cartcontent as $value)
    <div class="checkout-cart-item">
        <div class="checkout-cart-image">
            <img src="{{ asset($value->options->image) }}" />
            <div class="checkout-cart-quantity">
                {{ $value->qty }}
            </div>
        </div>
        <div class="checkout-cart-info">
            <a href="{{ route('product', $value->options->slug) }}">
                {{ Str::limit($value->name, 50) }}</a>
            @if ($value->options->product_size)
                <p>Size: {{ $value->options->product_size }}</p>
            @endif
            @if ($value->options->product_color)
                <p>Color: {{ $value->options->product_color }}</p>
            @endif
        </div>
        <div class="checkout-cart-prices"><span class="">৳ </span><strong>{{ $value->price }}</strong>
        </div>
        <div class="checkout-cart-remove">
            <a class="cart_remove" data-id="{{ $value->rowId }}"><i class="fas fa-times "></i></a>
        </div>
    </div>
@endforeach
<div class="checkout-cart-summary">
    <div class="checkout-summary-item">
        <div class="text-end px-4 left">Sub Total</div>
        <div class="px-4 right">
            <span id="net_total"><span class="">৳
                </span><strong>{{ $subtotal }}</strong></span>
        </div>
    </div>
    <div class="checkout-summary-item">
        <div class="text-end px-4 left">Delivery Charge</div>
        <div class="px-4 right">
            <span id="cart_shipping_cost"><span class="">৳
                </span><strong>{{ $shipping }}</strong></span>
        </div>
    </div>

    <div class="checkout-summary-item">
        <div class="text-end px-4 left">Total</div>
        <div class="px-4 right">
            <span id="grand_total"><span class="">৳
                </span><strong>{{ $subtotal + $shipping - ($discount + $coupon) }}</strong></span>
        </div>
    </div>
