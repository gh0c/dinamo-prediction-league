@extends('layouts.app')

@section('page_title', __('models.users.user.collection'))

@push('stylesheets')
    <style>
        .table > tbody > tr > * {
            padding: .1rem;
        }

        .table > tbody > tr > td .btn-sm {
            padding: .1rem .25rem;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-m-10 col-xl-8 offset-m-1 offset-xl-2">

                <table class="table table-sm table-hover table-middle-aligned-cells">

                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">{{ __('models.users.user._attributes.username') }}</th>
                        <th scope="col" class="d-none d-md-table-cell">{{ __('models.users.user._attributes.email') }}</th>
                        <th scope="col"
                            class="text-center">{{ __('models.users.user._attributes.settings._attributes.is_admin') }}</th>
                        <th scope="col"
                            class="text-center">{{ __('models.users.user._attributes.settings._attributes.is_mod') }}</th>
                        <th class="text-center">@</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>
                                {{ $user->username }}
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $user->email }}
                            </td>
                            <td class="text-center">
                                @if($user->userSetting)
                                    @if($user->userSetting->is_admin)
                                        <i class="fa fa-fw fa-check-circle"></i>
                                    @else
                                        <i class="fa fa-fw fa-circle-o"></i>
                                    @endif
                                @endif
                            </td>
                            <td class="text-center">
                                @if($user->userSetting)
                                    @if($user->userSetting->is_moderator)
                                        <i class="fa fa-fw fa-check-circle"></i>
                                    @else
                                        <i class="fa fa-fw fa-circle-o"></i>
                                    @endif
                                @endif
                            </td>

                            <td class="text-center">

                                <button class="btn btn-sm btn-outline-dark" data-toggle="modal"
                                        data-target="#password-change-modal" data-user_id="{{ $user->id }}">
                                    <i class="fa fa-key"></i>
                                </button>

                                <a href="{{ route('super-admin.users.edit', ['user' => $user->id]) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#delete-confirmation-modal" data-user_id="{{ $user->id }}">
                                    <i class="fa fa-times-circle"></i>
                                </button>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <div class="row">
            <div class="col text-center">
                <a href="{{ route('super-admin.users.create') }}" class="btn btn-success" tabindex="1">
                    {{ __('forms.super_admin.users._headings.create') }}
                </a>
            </div>
        </div>

    </div>

    <div class="modal fade" id="delete-confirmation-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">{{ __('forms.super_admin.users._headings.destroy') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'DELETE', 'route' => ['super-admin.users.destroy', 0] ]) }}
                <div class="modal-body">
                    {{ __('forms.super_admin.users._headings.delete_confirmation') }}
                    <input type="hidden" name="user_id" id="user_id" value="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('forms._modals.buttons.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('forms._modals.buttons.confirm') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>

    </div>

    <div class="modal fade" id="password-change-modal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">{{ __('forms.super_admin.users._headings.change_password') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['class' => 'change-password-form was-validated' ]) }}
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-10 col-xl-8 offset-1 offset-xl-2">
                            <label for="new_password">{{ __('forms.super_admin.users.new_password.label') }}</label>
                            {!! Form::password('new_password', ['class' => 'form-control','required' => true, 'minlength' => 6]) !!}
                        </div>
                        <div class="form-group col-10 col-xl-8 offset-1 offset-xl-2">
                            <label for="new_password_confirmation">{{ __('forms.super_admin.users.new_password_confirmation.label') }}</label>
                            {!! Form::password('new_password_confirmation', ['class' => 'form-control','required' => true, 'minlength' => 6]) !!}
                        </div>
                    </div>
                    <input type="hidden" name="user_for_password_change_id" id="user_for_password_change_id" value="0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('forms._modals.buttons.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('forms._modals.buttons.confirm') }}</button>
                </div>
                {{ Form::close() }}

            </div>
        </div>

    </div>

    <script>
        $('#delete-confirmation-modal').on('show.bs.modal', function (e) {
            let $modal = $(this);
            let $button = $(e.relatedTarget);
            let userId = $button.data('user_id');

            $modal.find('.modal-body #user_id').val(userId);
        });

        $('#password-change-modal').on('show.bs.modal', function (e) {
            let $modal = $(this);
            let $button = $(e.relatedTarget);
            let userId = $button.data('user_id');

            $modal.find('.modal-body #user_for_password_change_id').val(userId);
        });

        let changePasswordUrl = '{{ route('super-admin.users.change-password') }}';

        $(document).on('submit', '.change-password-form', function (e) {
            e.preventDefault();
            ajaxCall(changePasswordUrl, $(this).serialize()).then(() => {
                $(this).closest('.modal').modal('hide');
            });
        });

    </script>

@endsection

