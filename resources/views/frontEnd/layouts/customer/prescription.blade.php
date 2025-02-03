@extends('frontEnd.layouts.master')
@section('title', 'Customer Prescription')
@section('content')
    <section class="customer-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="customer-sidebar">
                        @include('frontEnd.layouts.customer.sidebar')
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="customer-content checkout-shipping">
                        <h5 class="account-title">Prescription Upload</h5>
                        <form action="{{ route('customer.prescription_upload') }}" method="POST" class="row"
                            enctype="multipart/form-data" data-parsley-validate="">
                            @csrf

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="image">Image *</label>
                                    <input type="file" id="image"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        value="{{ old('image') }}" required>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="note">Note *</label>
                                    <textarea id="note" rows="5" class="form-control @error('note') is-invalid @enderror" name="note"
                                        value="{{ old('note') }}" required></textarea>
                                    @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <button type="submit" class="submit-btn">Update</button>
                                </div>
                            </div>
                            <!-- col-end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    
@endpush
