@extends('admin.layout.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
@endpush


@section('content')
    {{--    Form Starts--}}
    @if($modern)
        <form method="post" action="{{ route('admin.modern.update', $modern->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="post" action="{{ route('admin.modern.store') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">China in Modern Times and Western Civilisation</h4>
                                </div>

                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input class="form-control" type="text" name="title"
                                                           placeholder=""
                                                           id="site_name" value="{{ $modern->title ?? ''}}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image_1" class="form-label">Image 1</label>
                                                    <input class="form-control" type="file" name="image_1"
                                                           id="image_1">

                                                    @if(isset($modern->image_1))
                                                        <img src="{{ asset($modern->image_1) }}" alt="" class="img-fluid" width="100">
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image_2" class="form-label">Image 2</label>
                                                    <input class="form-control" type="file" name="image_2"
                                                           id="image_2">

                                                    @if(isset($modern->image_2))
                                                        <img src="{{ asset($modern->image_2) }}" alt="" class="img-fluid" width="100">
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image_3" class="form-label">Image 3</label>
                                                    <input class="form-control" type="file" name="image_3"
                                                           id="image_3">

                                                    @if(isset($modern->image_3))
                                                        <img src="{{ asset($modern->image_3) }}" alt="" class="img-fluid" width="100">
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="content_1" class="form-label">Content 1</label>
                                                    <textarea id="content_1" name="content_1"
                                                              class="form-control editor"> {{ $modern->content_1 ?? ''}}
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="content_2" class="form-label">Content 2</label>
                                                    <textarea id="content_2" name="content_2"
                                                              class="form-control editor">{{ $modern->content_2 ?? ''}}
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="content_3" class="form-label">Content 3</label>
                                                    <textarea id="content_3" name="content_3"
                                                              class="form-control editor">{{ $modern->content_3 ?? ''}}
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="long_desc" class="form-label">Long Description</label>
                                                    <textarea id="long_desc" name="long_desc"
                                                              class="form-control editor">{{ $modern->long_desc ?? ''}}
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
                        document.querySelectorAll('.editor').forEach((element) => {
                            ClassicEditor
                                .create(element, {
                                    ckfinder: {
                                        uploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token() ]) }}"
                                    }
                                })
                                .then(editor => {
                                    console.log('Editor initialized for', element);
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        });
                    </script>
        @endpush
