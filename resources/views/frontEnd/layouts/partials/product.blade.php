<div class="product_item_inner">
    @if ($value->old_price)
        @php
            $discount = (($value->old_price - $value->new_price) * 100) / $value->old_price;
        @endphp
        @if ($value->flash_deal)
            <div class="flash-discount">
                @include('frontEnd.layouts.svg.flashsale')
                <span>{{ number_format($discount, 0) }}% OFF</span>
            </div>
        @else
            <div class="discount">
                @include('frontEnd.layouts.svg.discount')
                <p> {{ number_format($discount, 0) }}% <br> OFF</p>
            </div>
        @endif
    @endif
    <div class="pro_img">
        <a href="{{ route('product', $value->slug) }}">
            <img src="{{ asset($value->image ? $value->image->image : '') }}" alt="{{ $value->name }}" />
        </a>
    </div>
    <div class="pro_des">
        <div class="pro_name">
            <a href="{{ route('product', $value->slug) }}">{{ Str::limit($value->name, 80) }}</a>
        </div>
        <div class="product-bottom-item">
            <div class="product-price-wrapper">
                @if ($value->variable_count > 0 && $value->type == 0)
                    <p>
                        ৳ {{ $value->variable->new_price }}
                        @if ($value->variable->old_price)
                            <del>৳ {{ $value->variable->old_price }}</del>
                        @endif
                    </p>
                @else
                    <p>
                        ৳ {{ $value->new_price }}
                        @if ($value->old_price)
                            <del>৳ {{ $value->old_price }}</del>
                        @endif
                    </p>
                @endif
            </div>
            <div class="product-button-wrapper product-item-{{ $value->id }}">
                @if ($value->variable_count > 0 && $value->type == 0)
                    <div class="cart_btn">
                        <button  data-id="{{ $value->id }}"
                            class="variable-modal"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                    </div>
                @else
                    <div class="cart_btn">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $value->id }}" />
                            <button type="submit"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
