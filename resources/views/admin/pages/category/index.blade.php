@extends('admin.layout.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">

@endpush


@section('content')

    {{--    <div class="row">--}}
    {{--        <div class="col-12">--}}
    {{--            <div class="page-title-box d-sm-flex align-items-center justify-content-end">--}}
    {{--                <h4 class="mb-sm-0 font-size-18">Admins</h4>--}}

    {{--                <div class="page-title-right">--}}
    {{--                    <ol class="m-0 breadcrumb">--}}
    {{--                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>--}}
    {{--                        <li class="breadcrumb-item active">Admins</li>--}}
    {{--                    </ol>--}}
    {{--                </div>--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{-- Table Starts--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 card-title">Category List</h4>
                        @can('Create Category')
                            <a class="btn btn-md btn-secondary" href="{{ route('admin.category.create') }}">
                                Create Category
                            </a>
                        @endcan
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 nowrap w-100 dataTable no-footer dtr-inline table-striped"
                               id="adminTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Title</th>
                                <th>Actions</th>
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

    {{--    Create Admin Modal--}}
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="createAdmin">
                        @csrf

                        <div class="mb-3">
                            <label class="col-form-label">Category Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="col-form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="col-form-label">Front Status</label>
                            <select name="front_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description"
                                      class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <textarea class="form-control"
                                      name="meta_keywords"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="meta_image" class="form-label">Meta Image</label>
                            <input type="file" class="form-control" name="meta_image">

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Google Schema</label>
                            <textarea class="form-control"
                                      name="google_schema"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    Edit Categories Modal--}}
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form2" id="editAdmin" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="col-form-label">Category Name *</label>
                            <input type="text" id="name" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="text" class="col-form-label">Description</label>
                            <textarea id="description" name="description" cols="30" rows="10"
                                      class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                            <div id="imgPrev">

                            </div>

                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Front Status</label>
                                <select id="front_status" name="front_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title">
                            </div>

                            <div class="mb-3">
                                <label for="meta_desc" class="form-label">Meta Description</label>
                                <textarea id="meta_description" name="meta_description"
                                          class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="meta_keyword" class="form-label">Meta Keywords</label>
                                <textarea id="meta_keywords" class="form-control"
                                          name="meta_keywords"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="meta_image" class="form-label">Meta Image</label>
                                <input type="file" class="form-control" name="meta_image">
                                <div id="metaImgPrev">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="google_schema" class="form-label">Google Schema</label>
                                <textarea id="google_schema" class="form-control"
                                          name="google_schema"></textarea>
                            </div>

                            <input id="id" type="number" hidden>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <script>

        $(document).ready(function () {

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
                ajax: "{{route('admin.category.index')}}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false


                    },


                    {
                        data: 'name',
                        name: 'name'

                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            // Delete Admin
            $(document).on('click', '#deleteAdminBtn', function () {
                let id = $(this).data('id');

                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                })
                    .then((result) => {
                        if (result.isConfirmed) {


                            $.ajax({
                                type: 'DELETE',

                                url: "{{ url('admin/categories') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Category has been deleted.",
                                        icon: "success"
                                    });

                                    adminTable.ajax.reload();
                                },
                                error: function (err) {
                                    console.log('error')
                                }
                            })


                        } else {
                            swal.fire('Your Data is Safe');
                        }

                    })


            })

            // Change Admin Status
            $(document).on('click', '#adminFrontStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id + status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.front-category.status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status

                        },
                        success: function (res) {
                            adminTable.ajax.reload();

                            if (res.status == 1) {

                                swal.fire(
                                    {
                                        title: 'Status Changed to Active',
                                        icon: 'success'
                                    })
                            } else {
                                swal.fire(
                                    {
                                        title: 'Status Changed to Inactive',
                                        icon: 'success'
                                    })

                            }
                        },
                        error: function (err) {
                            console.log(err)
                        }
                    }
                )
            })

            // Change Admin Status
            $(document).on('click', '#adminStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id + status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.category.status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status

                        },
                        success: function (res) {
                            adminTable.ajax.reload();

                            if (res.status == 1) {

                                swal.fire(
                                    {
                                        title: 'Status Changed to Active',
                                        icon: 'success'
                                    })
                            } else {
                                swal.fire(
                                    {
                                        title: 'Status Changed to Inactive',
                                        icon: 'success'
                                    })

                            }
                        },
                        error: function (err) {
                            console.log(err)
                        }
                    }
                )
            })
        });
    </script>
@endpush
