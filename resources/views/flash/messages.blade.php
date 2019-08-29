<div class="toasts-container">

    @foreach (session('flash_notification', collect())->toArray() as $message)

        <div class="toast bg-light ml-auto mt-3 mr-2" role="alert" aria-live="assertive" aria-atomic="true"
             @if($message['important']) data-autohide="false" @else data-delay="5000" @endif>

            <div class="toast-header bg-{{ $message['level'] }}">

                <span class="mr-auto {{ in_array($message['level'], ['danger', 'info', 'success', ]) ? ' text-white' : '' }}">
                    {{ __('forms._toasts.' . $message['level']) }}
                </span>
                {{--                    <small class="text-muted">just now</small>--}}

                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="toast-body">
                {!! $message['message'] !!}

                @if($message['level'] === 'danger' && count($errors) > 0)

                    @foreach ($errors->all() as $error)
                        <div><strong class="mr-auto">{{ $error }}</strong></div>
                    @endforeach

                @endif
            </div>

        </div>

    @endforeach

</div>

<script>
    $(document).ready(() => $('.toast').toast('show'));
</script>