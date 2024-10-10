@extends('dashboard.home')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-5 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.requests.requests') }}
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-lg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('form.requests.fio') }}</th>
                            <th>{{ __('form.requests.email') }}</th>
                            <th>{{ __('form.requests.phone') }}</th>
                            <th>{{ __('form.requests.title') }}</th>
                            <th>{{ __('form.requests.content') }}</th>
                            <th>{{ __('form.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr @if($item->status == 1)class="bg-gray-200" @endif>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->fio }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
{{--                                <td><span--}}
{{--                                        class="badge @if($item->status) badge-success @else badge-danger @endif">{{ $item->statusName }}</span>--}}
{{--                                </td>--}}
                                <td>
                                    @can('requests.update')
                                        @if($item->status == 1)
                                    {{ __('form.checked') }}
                                        @else
                                            <a href="{{ route("requests.check", [$item->id]) }}" class=""
                                               onclick="return confirm(this.getAttribute('data-message'));"
                                               data-message="{{ __('form.confirm_check') }}">
                                                <i class="fa fa-check-square-o button-2x"></i></a>
                                        @endif

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
