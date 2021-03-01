
@if (\App\Addon::where('unique_identifier', 'mission_addon')->first()->activated)
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Missions Index') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1009" @php if(isset($permissions) && in_array(1009, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
@endif