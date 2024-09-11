<div class="modal fade" id="m_accidentrecord_export" tabindex="-1" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('accident.accidentrecord.export') }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label"
                                   for="select"></label>
                            <select class="form-control select select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true" id="accident_type_id" name="accident_type_id">
                                <option value="" selected
                                        disabled>{{ __('form.accident.accidenttype') }} {{ __('form.choose') }}</option>
                                @foreach($accidentTypes as $accident_type)
                                    <option
                                        value="{{ $accident_type->id }}"
                                        @selected(request('accident_type_id') == $accident_type->id)
                                    >{{ $accident_type->hname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="from"
                                   class="form-control-label">{{ __('validation.attributes.from') }}</label>
                            <input type="date" class="form-control"
                                   name="from" id="from"
                                   value="{{ old('from')}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="to"
                                   class="form-control-label">{{ __('validation.attributes.to') }}</label>
                            <input type="date" value="{{ old('to') }}"
                                   class="form-control"
                                   name="to" id="to">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.close') }}</button>
                    <button class="btn  btn-info ">{{ __('form.download') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
