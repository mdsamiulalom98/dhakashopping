@extends('backEnd.layouts.master')
@section('title', 'Prescription Manage')
@section('css')
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Prescription Manage</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($show_data as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->customer->name }}</td>
                                        <td>
                                            <a data-bs-toggle="modal" class="prescription-modal"
                                                data-id="{{ $value->id }}" data-bs-target="#prescriptionView">
                                                <img src="{{ asset($value->image) }}" class="backend-image" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            @if ($value->status == 1)
                                                <span class="badge bg-soft-success text-success">Active</span>
                                            @else
                                                <span class="badge bg-soft-danger text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="button-list">
                                                @if ($value->status == 1)
                                                    <form method="post" action="{{ route('prescription.inactive') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="hidden_id">
                                                        <button type="button"
                                                            class="btn btn-xs  btn-secondary waves-effect waves-light change-confirm"><i
                                                                class="fe-thumbs-down"></i></button>
                                                    </form>
                                                @else
                                                    <form method="post" action="{{ route('prescription.active') }}"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" value="{{ $value->id }}" name="hidden_id">
                                                        <button type="button"
                                                            class="btn btn-xs  btn-success waves-effect waves-light change-confirm"><i
                                                                class="fe-thumbs-up"></i></button>
                                                    </form>
                                                @endif

                                                <form method="post" action="{{ route('prescription.destroy') }}"
                                                    class="d-inline">
                                                    @csrf
                                                    <input type="hidden" value="{{ $value->id }}" name="hidden_id">
                                                    <button type="submit"
                                                        class="btn btn-xs btn-danger waves-effect waves-light delete-confirm"><i
                                                            class="mdi mdi-close"></i></button>
                                                </form>
                                                <a href="{{ route('admin.order.create', ['prescription' => $value->id]) }}"
                                                    class="btn btn-xs btn-primary waves-effect waves-light">
                                                    <i class="fe-shopping-cart"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>

    <!-- Assign User End -->
    <div class="modal fade bd-example-modal-lg" id="prescriptionView" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="prescriptionContent">
            </div>
        </div>
    </div>
    <!-- Assign User End-->
@endsection


@section('script')
    <!-- third party js -->
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script
        src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js">
    </script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js">
    </script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('/public/backEnd/') }}/assets/js/pages/datatables.init.js"></script>
    <!-- third party js ends -->

    <script>
        $(document).on('click', '.prescription-modal', function(e) {
            var id = $(this).data("id");
            // $("#prescriptionView").addClass('show');
            if (id) {
                $.ajax({
                    type: "GET",
                    data: {
                        id: id
                    },
                    url: "{{ route('prescription.ajax.view') }}",
                    success: function(data) {
                        if (data) {
                            $("#prescriptionContent").html(data);
                        }
                    },
                });
            }
        });
        $(document).on('click', '[data-bs-dismiss="modal"]', function() {
            // $("#prescriptionView").removeClass('show');
            $("#prescriptionView").modal('hide');
        });
    </script>
@endsection
