@extends('admin.layout.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="mb-2 row">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="p-2 form-group col-md-2">
                                    <label for="inputCity" class="col-form-label">Start Date</label>
                                    <input type="text" class="form-control datepicker flatpickr-input active"
                                           id="start_date" value="{{ today() }}" placeholder="Select Date"
                                           readonly="readonly">
                                </div>

                                <div class="p-2 form-group col-md-2">
                                    <label for="inputCity" class="col-form-label">End Date</label>
                                    <input type="text" class="form-control datepicker flatpickr-input" id="end_date"
                                           value="{{ today() }}" placeholder="Select Date" readonly="readonly">
                                </div>

                                <div class="p-2 form-group col-md-3">
                                    <label for="inputState" class="col-form-label">Select Courier</label>
                                    <select id="courier_id" class="form-control">
                                        @forelse($couriers as $courier)
                                            <option value="{{ $courier->id }}">{{ strtoupper($courier->type)    ?? '' }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="p-2 form-group col-md-2">
                                    <label for="inputState" class="col-form-label">Select User</label>
                                    <select id="user_id" class="form-control">
                                        @forelse($admins as $admin)
                                            <option value="{{ $admin->id }}">{{ $admin->name ?? '' }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="p-2 form-group col-md-2">
                                    <label for="inputState" class="col-form-label">Select Status</label>
                                    <select id="status_id" class="form-control">
                                        @forelse($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->status_name ?? '' }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0 nowrap w-100 dataTable no-footer dtr-inline table-striped"
                               id="adminTable">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice ID</th>
                                <th>Customer info</th>
                                <th>Products</th>
                                <th>Total</th>
                                <th>Delivery Charge</th>
                                <th>Discount</th>
                                <th>Courier</th>
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{--    Table Ends--}}

@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
    {{--    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>--}}

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    <!-- Buttons Export (PDF/Print) -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <!-- PDFMake (required for PDF export) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>

        $(document).ready(function () {

            //Flatpickr
            $(".datepicker").flatpickr();

            let token = $("input[name='_token']").val();

            let baseAssetUrl = "{{ asset('') }}";

            //Show Data through Datatable
            let adminTable = $('#adminTable').DataTable({

                dom: '<"row mb-3"' +
                    '<"col-md-6 d-flex align-items-center mb-2 mb-md-0"l>' +
                    '<"col-md-6 d-flex flex-wrap justify-content-md-end gap-2"Bf>' +
                    '>' +
                    '<"row"<"col-12"tr>>' +
                    '<"row mt-3"' +
                    '<"col-md-5"i>' +
                    '<"col-md-7"p>' +
                    '>',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Print Table',
                        className: 'btn btn-success btn-sm'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Download PDF',
                        className: 'btn btn-danger btn-sm'
                    },
                    {extend: 'csv', className: 'btn btn-info btn-sm', text: 'CSV Export'},
                    {extend: 'excel', className: 'btn btn-success btn-sm', text: 'Excel Export'},

                ],

                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                {{--ajax: "{{url('/admin/data')}}",--}}
                {{--ajax: "{{route('admin.sales-report.index')}}",--}}

                ajax: {
                    url: "{{ route('admin.sales-report.index') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date   = $('#end_date').val();
                        d.courier_id    = $('#courier_id').val();
                        d.admn_id     = $('#user_id').val();
                        d.status_id     = $('#status_id').val();
                    }
                },
                // pageLength: 30,

                columns: [

                    {
                        data: 'order_date',


                    },

                    {
                        data: 'invoiceID',
                        name: 'invoiceID',

                    },

                    {
                        data: 'customer',
                        render: function (data, type, row) {
                            return `${data.name}<br>${data.email}<br>${data.phone}`;
                        }
                    },

                    {
                        data: 'product',
                    },

                    {
                        data: 'total',

                    },

                    {
                        data: 'delivery_charge',
                    },

                    {
                        data: 'discount_charge',
                    },

                    {
                        data: 'courier.type',
                    },

                    {
                        data: 'admin.name'
                    },

                    {
                        data: 'status',


                    },
                ]
            });


            // reload when filters change
            $('#start_date, #end_date, #courier_id, #user_id, #status_id').on('change', function() {
                adminTable.ajax.reload();
            });
        });
    </script>
@endpush
