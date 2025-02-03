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
                        {{-- data-bs-toggle="modal" data-bs-target="#withdraw" --}}
                        <h5 class="account-title position-relative py-3">Monthly Reminder <button
                                class="btn btn-success position-absolute reminder-button" data-bs-toggle="modal"
                                data-bs-target="#withdraw"><i class="fa fa-plus"></i> Add </button></h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Medicine</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reminders as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><span class="line-clamp line-clamp-1 w-200">{{ $value->product ? $value->product->name : '' }}</span></td>
                                            <td>{{ $value->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="withdraw" aria-hidden="true">
        <div class="modal-dialog custom_modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawLabel">New Reminder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.reminder_save') }}" method="POST" class="withdraw_form">
                        @csrf

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="date" class="form-label d-block">Date *</label>
                                <input type="text" id="date" class="form-control flatdate @error('date') is-invalid @enderror" name="date" value="{{ old('product_id') }}"  required>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col-end -->
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="product_id" class="form-label d-block">Medicine *</label>
                                <select id="product_id"
                                    class="form-control form-select product_id @error('product_id') is-invalid @enderror"
                                    name="product_id" value="{{ old('product_id') }}" required>
                                    <option value="">Select...</option>
                                    @foreach ($products as $key => $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col-end -->
                        <div class="form-group my-2">
                            <button type="submit" class="btn btn-success"> Submit Reminder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            flatpickr(".flatdate", {});
        });
    </script>
@endpush
