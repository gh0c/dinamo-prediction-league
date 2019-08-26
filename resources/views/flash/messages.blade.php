<div class="toasts-container">
    <div class="col-12 col-sm-8 col-lg-6 col-xl-4">

        @foreach (session('flash_notification', collect())->toArray() as $message)

            <div class="toast bg-light ml-auto mt-3 mr-2" role="alert" aria-live="assertive" aria-atomic="true"
                 @if($message['important']) data-autohide="false" @else data-delay="5000" @endif>
                <div class="toast-header bg-{{ $message['level'] == 'error' ? 'danger' :  $message['level']}}">

{{--                    <strong class="mr-auto">{{ $message['level'] }}</strong>--}}
{{--                    <small class="text-muted">just now</small>--}}

                    <button type="button" class="ml-auto mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="toast-body">
                    {{ $message['message'] }}
                </div>

            </div>

        @endforeach

    </div>
</div>

<script>
    $(document).ready(() => $('.toast').toast('show'));
</script>