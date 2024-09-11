@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.organizations.organization') }}
                </h4>
                @if(count($pagination->items()) < 1)
                    @can('create_organization')
                        <a href="{{ route('organizations.create') }}" class="btn btn-primary">{{ __('form.add') }}</a>
                    @endcan
                @endif
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('validation.attributes.address') }}</th>
                        <th>{{ __('validation.attributes.phone') }}</th>
                        <th>{{ __('validation.attributes.description') }}</th>
                        @canany(['update_organization'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $organization)
                        <tr>
                            {{--                            @dd($organization)--}}
                            <td>{{ $organization->name }}</td>
                            <td>{{ $organization->address }}</td>
                            <td>{{ $organization->hphone }}</td>
                            <td>{{ $organization->description }}</td>
                            <td>
                                @can('update_organiztion')
                                    <a href="{{ route("organizations.edit", [$organization->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_organization')
                                    @if(count($pagination->items()) < 1)
                                        <a href="{{ route("organizations.delete", [$organization->id]) }}" class=""
                                           onclick="return confirm(this.getAttribute('data-message'));"
                                           data-message="{{ __('form.confirm_delete') }}">
                                            <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
