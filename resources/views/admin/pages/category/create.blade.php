@extends('admin.layout.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

    <form name="form" id="createAdmin" method="post" action="{{ route('admin.category.store') }}">
        @csrf

        <div class="mb-3">
            <label class="col-form-label">Category Name *</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label class="col-form-label">Video *</label>
            <input type="text" class="form-control" name="video">
        </div>

        <div class="mb-3">
            <label class="col-form-label">Long Description</label>
            <textarea name="long_desc" class="form-control" id="long_desc"></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

@endsection

@push('js')
    <script src="{{asset('https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js')}}"></script>

    <script>
        //  CKEditor on Products Desctription
        let jReq;
        ClassicEditor
            .create(document.querySelector('#long_desc'), {

                ckfinder:
                    {
                        uploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
                    }


            })
            .then(newEditor => {
                jReq = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
