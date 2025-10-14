@extends('admin.layout.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
@endpush


@section('content')


    {{--    Form Starts--}}

    @if($tradition)
        <form method="post" action="{{ route('admin.tradition.update', $tradition->id) }}" enctype="multipart/form-data">
            @method('PUT')

            @else
                <form method="post" action="{{ route('admin.tradition.store') }}" enctype="multipart/form-data">

                    @endif

                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Chinese Traditional Thoughts</h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input class="form-control" type="text" name="title"
                                                           placeholder=""
                                                           id="site_name" value="{{ $tradition->title ?? ''}}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="images" class="form-label">Images</label>
                                                    <input class="form-control" type="file" name="images[]"
                                                           id="images" multiple>

                                                    @if(isset($tradition->images))
                                                        @forelse(json_decode($tradition->images) as $image)
                                                            <img src="{{ asset($image) }}" alt="" class="img-fluid" width="100">
                                                        @empty
                                                            <p>No images found</p>
                                                        @endforelse
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="video" class="form-label">Video URL</label>
                                                    <input class="form-control" type="text" name="video"
                                                           placeholder=""
                                                           id="video" value="{{ $tradition->video ?? ''}}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="short_desc" class="form-label">Short Description</label>
                                                    <textarea id="short_desc" name="short_desc"
                                                              class="form-control">{{ $tradition->short_desc ?? ''}}
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="long_desc" class="form-label">Long Description</label>
                                                    <textarea id="long_desc" name="long_desc"
                                                              class="form-control">{{ $tradition->long_desc ?? ''}}
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
