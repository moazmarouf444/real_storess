@if ($errors->has($input))
    <div class="help-block form-error">
        <ul role="alert">
            <li>{{ $errors->first($input) }}</li>
        </ul>
    </div>
@endif
