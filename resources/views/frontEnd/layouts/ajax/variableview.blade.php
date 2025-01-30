
<div class="modal-view">
    <div class="variable-content">
        <button class="close-variable-button">
            <span></span>
            <span></span>
        </button>
        <div class="row">
            <div class="col-sm-6">
                <div class="variable-image">
                    <img src="{{ asset($data->image->image ?? '') }}">
                </div>
            </div>
            <div class="col-sm-6">
                
                @if ($productsizes->count() > 0)
                    <div class="pro-size">
                        <p class="color-title">Select Size</p>
                        <div class="size_inner">

                            <div class="size-container">
                                <div class="selector">
                                    @foreach ($productsizes as $prosize)
                                        <div class="selector-item">
                                            <input type="radio" id="f-option{{ $prosize->size }}"
                                                value="{{ $prosize->size }}" name="product_size"
                                                class="selector-item_radio  variable_size"
                                                data-size="{{ $prosize->size }}" required />
                                            <label for="f-option{{ $prosize->size }}"
                                                class="selector-item_label">{{ $prosize->size }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <button type="button" id="variableSubmit" class="variable-submit" data-id="{{ $data->id }}">
                    Add To Cart
                </button>
            </div>
        </div>
    </div>
</div>
