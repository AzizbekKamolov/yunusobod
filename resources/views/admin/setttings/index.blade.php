@extends('dashboard.home')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-5 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.settings.settings') }}
                    </h4>
                    {{--                    <div class="">--}}
                    @can('settings.store')
                        <a href="{{ route("settings.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                        {{--                    </div>--}}
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive-lg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('form.settings.action') }}</th>
                            <th>{{ __('form.settings.photo') }}</th>
{{--                            <th>{{ __('form.settings.description') }}</th>--}}
                            @canany(['settings.update', 'settings.delete'])
                                <th>{{ __('form.actions') }}</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ __("web.menus.$item->action") }}</td>
{{--                                <td>{!! $item->description !!}</td>--}}
                                <td>
                                    <img src="{{ asset("/sliders/$item->photo") }}" width="100" alt="photo">
                                </td>
                                <td>
                                    @can('settings.update')
                                        <a href="{{ route("settings.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    @can('settings.delete')
                                        <a href="{{ route("settings.delete", [$item->id]) }}" class=""
                                           onclick="return confirm(this.getAttribute('data-message'));"
                                           data-message="{{ __('form.confirm_delete') }}">
                                            <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-between">
                        <span>{{ __('form.showed') }}: <b>{{ $pagination->count() }}</b></span>
                        {{ $pagination->links('pagination::bootstrap-4') }}
                        <span>{{ __('form.total') }}: <b>{{ $pagination->total() }}</b></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
