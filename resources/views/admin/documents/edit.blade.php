@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-10 col-xlg-9 col-md-7 ">
            <div class="card mb-4 shadow-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link  col-6" id="nav-profile-tab" data-toggle="tab" href="#my-profile"
                           role="tab" aria-controls="my-profile" aria-selected="false">{{ __('form.uz') }}</a>
                        <a class="nav-item nav-link col-6 active show" id="nav-contact-tab" data-toggle="tab"
                           href="#my-contact"
                           role="tab"
                           aria-controls="my-contact" aria-selected="true">{{ __('form.ru') }}</a>
                    </div>
                </nav>
                <div>
                    <form action="{{ route('documents.update',[$item->id])}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="my-profile" role="tabpanel"
                                 aria-labelledby="nav-profile-tab">
                                <div class="form-group justify-content-lg-start">
                                    <label class="col-md-12 mt-3"
                                           for="title[uz]">{{ __('validation.attributes.title') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="title[uz]" class="form-control"
                                               id="title[uz]"
                                               placeholder="{{ __('form.name_uz') }}"
                                               value="{{ $item->title_uz }}">
                                        @if($errors->has('title.uz'))
                                            <div class="text-danger">{{ $errors->first('title.uz') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="my-contact" role="tabpanel"
                                 aria-labelledby="nav-contact-tab">

                                <div class="form-group justify-content-end">
                                    <label class="col-md-12 mt-3"
                                           for="title[ru]">{{ __('validation.attributes.title') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="title[ru]" class="form-control" id="title[ru]"
                                               placeholder="{{ __('form.name_ru') }}" required
                                               value="{{ $item->title_ru }}">
                                        @if($errors->has('title.ru'))
                                            <div class="text-danger">{{ $errors->first('title.ru') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label"
                                   for="inputGroupSelect01">{{ __('form.categories.categories') }}</label>
                            <select class="custom-select col-md-12" name="file_category_id" id="inputGroupSelect01">
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" @selected($category->id == $item->file_category_id)> {{$category->hname}} </option>
                                @endforeach
                            </select>
                            @if($errors->has('file_category_id'))
                                <div class="text-danger">{{ $errors->first('file_category_id') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-5 mt-5">
                            @foreach($item->files as $file)
                                @include('admin.documents.file')
                                {{--                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#m_modal_4">Launch Modal</button>--}}
                                {{--                                <img src="{{ $file->path }}" alt="">--}}
                                <span data-toggle="modal" data-target="#m_modal_{{ $file->id }}"> <i
                                        class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                            @endforeach
                        </div>
                        <div class="col-md-12" id="special_titles">
                            <label for="validationTooltip03">{{ __('validation.attributes.file') }}</label><span
                                class="btn btn-outline-success ml-3 mb-2"
                                id="special_titles_button"><i
                                    class="fa fa-plus-circle"></i></span>
                            <div class="form-row ">
                                <div class="col-md-6 mb-3 ">
                                    <input type="file" class="form-control" id="validationTooltip03"
                                           name="files[0][file]">
                                    @if($errors->has('files.*'))
                                        <ul>
                                            @foreach($errors->get('files.*') as $errors)
                                                @foreach($errors as $error)
                                                    <div class="text-danger">
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="col-md-2 mb-3">
                                    <select name="files[0][lang]" class="form-control">
                                        <option value="ru">ru</option>
                                        <option value="uz">uz</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input name="files[0][uploaded_at]" type="date" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('documents.index') }}"
                               class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-info">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script>
                let counter
                $('#special_titles_button').on('click', function (e) {
                    e.preventDefault()
                    counter++
                    console.log(1)
                    $('#special_titles').append(`<div class="form-row ">
                                    <div class="col-md-6 mb-3 ">
                                        <input type="file" class="form-control" id="validationTooltip03" name="files[${counter}][file]">

                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <select name="files[${counter}][lang]" class="form-control">

                                        <option value="ru">ru</option>
                                        <option value="uz">uz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <input name="files[${counter}][uploaded_at]" type="date" class="form-control">
                                     </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                                    </div>
                                </div>
    `)
                })
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('special_titles_button_remove')) {
                        e.target.parentElement.parentElement.remove();
                    }
                })
            </script>
@endsection
