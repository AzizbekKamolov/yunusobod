<div class="modal fade" id="m_employee_export" tabindex="-1" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route("employees.export") }}">
                @csrf
                <div class="modal-body">
                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true" id="position_id" name="position_id">
                                <option value="" selected
                                        disabled>{{ __('form.positions.positions') }} {{ __('form.choose') }}</option>
                                @foreach($positions as $position)
                                    <option
                                        value="{{ $position->id }}"
                                        @selected(request('position_id') == $position->id)
                                    >{{ $position->hname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true" id="branch_id" name="branch_id">
                                <option value="" selected
                                        disabled>{{ __('form.branches.branches') }} {{ __('form.choose') }}</option>
                                @foreach($branches as $branch)
                                    <option
                                        value="{{ $branch->id }}"
                                        @selected(request('branch_id') == $branch->id)
                                    >{{ $branch->name }}</option>
                                @endforeach
                            </select>
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
