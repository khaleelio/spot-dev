{{-- <div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <div class="checkbox">
        <label>
            <input name="{{ $field['name'] }}" value="{{ Arr::get($field, 'value', '1') }}" type="checkbox" @if(old($field['name'], \setting($field['name']))) checked="checked" @endif >
            {{ $field['label'] }}
        </label>

        @if ($errors->has($field['name'])) <small class="help-block">{{ $errors->first($field['name']) }}</small> @endif
    </div>
</div> --}}

<div class="form-group row {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label class="col-form-label col-3 text-lg-right text-left">{{ $field['label'] }}</label>
    <div class="col-3">
        <span class="switch">
            <label>
                <input type="checkbox" 
                        {{-- checked="checked"  --}}
                        name="{{ $field['name'] }}" 
                        id="{{ $field['name'] }}" 
                        @if(setting($field['name']) == Arr::get($field, 'true_value', 'on')) 
                            checked
                        @endif
                        {{-- value="{{ Arr::get($field, 'value', '1') }}" --}}
                        />
                <span></span>
            </label>
        </span>
    </div>
</div>
