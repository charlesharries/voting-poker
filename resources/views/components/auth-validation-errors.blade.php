@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="text-red">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="text-red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
