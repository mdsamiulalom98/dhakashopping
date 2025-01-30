@php
    $cartdata = Gloudemans\Shoppingcart\Facades\Cart::instance('shopping');
@endphp
<a class="cart-toggle">
    @include('frontEnd.layouts.svg.carticon')
    <span>{{ $cartdata->count() }}</span>
</a>
