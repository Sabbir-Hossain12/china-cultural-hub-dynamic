@extends('admin.layout.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
@endpush


@section('content')


    {{--    Form Starts--}}

    @if($history)
        <form method="post" action="{{ route('admin.history.update',$history->id) }}" enctype="multipart/form-data">
            @method('PUT')

            @else
                <form method="post" action="{{ route('admin.history.store') }}" enctype="multipart/form-data">

                    @endif

                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">The History and Society of China</h4>

                                </div>
                                <div class="card-body p-4">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input class="form-control" type="text" name="title"
                                                           placeholder=""
                                                           id="site_name" value="{{ $history->title ?? ''}}">
                                                </div>


                                                <div class="mb-3">
                                                    <label for="video" class="form-label">Video URL</label>
                                                    <input class="form-control" type="text" name="video"
                                                           placeholder=""
                                                           id="video" value="{{ $history->video ?? ''}}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="short_desc" class="form-label">Short Description</label>
                                                    <textarea id="short_desc" name="short_desc"
                                                              class="form-control">{{ $history->short_desc ?? ''}}
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="long_desc" class="form-label">Long Description</label>
                                                    <textarea id="long_desc" name="long_desc"
                                                              class="form-control">{{ $history->long_desc ?? ''}}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    {{-- SKU--}}


                    <div class="text-center mt-2 mb-2 d-grid">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>

                @endsection



                @push('js')
                    <script src="{{asset('https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js')}}"></script>

                    <script>
                        //  CKEditor on Products Desctription
                        let jReq;
                        ClassicEditor
                            .create(document.querySelector('#long_desc'),{

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
