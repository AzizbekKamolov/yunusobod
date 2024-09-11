<div class="modal fade" id="m_warehouse_export" tabindex="-1" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('warehouse.export') }}">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label"
                                   for="select"></label>
                            <select class="custom-select col-md-12" name="select" id="select">
                                <option value="" selected
                                        disabled> {{ __('form.choose') }} </option>
                                <option value="empty"
                                >{{ __('form.warehouse.empty') }}</option>
                                <option value="not_empty"
                                >{{ __('form.warehouse.not_empty') }}</option>
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
