<div class="modal fade" id="m_employeeProduct_{{ $employee_product->id }}" tabindex="-1" role="dialog"
     style="display: none; padding-right: 15px;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('employee_product.update',[$employee_product->id]) }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <input type="hidden" name="warehouse_id" value="{{ $item->id }}">
                        <input type="hidden" name="employee_id" value="{{ $employee_product->employee_id }}">
                        <input type="hidden" name="warehouse_category_id"
                               value="{{ $item->warehouse_category->id }}">
                        <div class="col-md-4 mb-3">
                            <label for="quantity"
                                   class="form-control-label">{{ __('validation.attributes.quantity') }}</label>
                            <input type="text" class="form-control"
                                   name="quantity" id="quantity"
                                   placeholder="{{'max: '. $item->remaining_quantity}}"
                                   value="{{ old('quantity',$employee_product->quantity)}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_given"
                                   class="form-control-label">{{ __('validation.attributes.date_given') }}</label>
                            <input type="date" value="{{ old('date_given',$employee_product->date_given) }}"
                                   class="form-control"
                                   name="date_given" id="date_given">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="entry_date"
                                   class="form-control-label">{{ __('validation.attributes.entry_date') }}</label>
                            <input type="date" value="{{ old('entry_date',$employee_product->entry_date)}}"
                                   class="form-control"
                                   name="entry_date" id="entry_date">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label"
                                   for="content">{{ __('validation.attributes.description') }}</label>
                            <textarea type="text" name="description" class="form-control"
                                      id="content"
                                      cols="30"
                                      rows="3"> {{ old('description',$employee_product->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.close') }}</button>
                    <button class="btn  btn-info ">{{ __('form.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
