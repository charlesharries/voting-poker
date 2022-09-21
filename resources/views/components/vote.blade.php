<button type="submit" name="value" value="{{ $value }}">
    {{ $value }}

    @if ($voted == $value)
        &check;
    @endif
</button>
