@extends('dashboard.home')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-5 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.social_networks.social_networks') }}
                    </h4>
                    {{--                    <div class="">--}}
                    @can('social_networks.store')
                        <a href="{{ route("social_networks.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                        {{--                    </div>--}}
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive-lg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('form.social_networks.icon') }}</th>
                            <th>{{ __('form.social_networks.name') }}</th>
                            <th>{{ __('form.social_networks.url') }}</th>
                            <th>Order</th>
                            <th>{{ __('form.status') }}</th>
                            @canany(['social_networks.update', 'social_networks.delete'])
                                <th>{{ __('form.actions') }}</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td bgcolor="#dee2e6">
                                    {!! $item->icon !!}
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->url }}</td>
                                <td>
                                    @if(!$loop->first)
                                        <a href="{{ route('social_networks.setOrder', [-$item->id]) }}"><i
                                                class="fa fa-arrow-up"></i></a>
                                    @endif
                                    @if(!$loop->last)
                                        <a href="{{ route('social_networks.setOrder', [$item->id]) }}"><i
                                                class="fa fa-arrow-down"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge @if($item->status) badge-success @else badge-danger @endif">{{ $item->statusName }}</span>
                                </td>
                                <td>
                                    @can('social_networks.update')
                                        <a href="{{ route("social_networks.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    @can('social_networks.delete')
                                        <a href="{{ route("social_networks.delete", [$item->id]) }}" class=""
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
