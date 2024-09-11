@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('quiz.topics.topics') }}
                </h4>
                @can('create_topic')
                    <a href="{{ route("topics.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('quiz.questions.questions_count') }}</th>
                        @canany(['delete_topic','update_topic'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $topic)
                        <tr>
                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td><a href="{{ route('questions.index', [$topic->id]) }}">{{ $topic->hname }}</a></td>
                            <td>{{ $topic->questions_count}}</td>
                            <td>
                                @can('update_topic')
                                    <a href="{{ route("topics.edit", [$topic->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_topic')
                                    <a href="{{ route("topics.delete", [$topic->id]) }}" class=""
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('form.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
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
