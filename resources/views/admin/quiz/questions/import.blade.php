<div class="modal fade" id="m_question_import" tabindex="-1" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('questions.import', [$topic]) }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="form-control-label"
                                   for="type">{{ __('quiz.questions.types.types') }}</label>
                            <select class="custom-select col-md-12" name="type" id="type">
                                @foreach($types as $type => $typeName)
                                    <option value="{{ $type }}"> {{ $typeName }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="text-danger">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-control-label"
                                   for="lang">{{ __('form.lang') }}</label>
                            <select class="custom-select col-md-12" name="lang" id="lang">
                                @foreach(config('app.languages') as $lang)
                                    <option value="{{ $lang }}"> {{ $lang }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('lang'))
                                <div class="text-danger">{{ $errors->first('lang') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-control-label"
                                   for="type">{{ __('form.files.file') }}</label>
                            <input name="file" type="file">
                            @if($errors->has('file'))
                                <div class="text-danger">{{ $errors->first('file') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.close') }}</button>
                    <button class="btn  btn-info ">{{ __('form.upload') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
