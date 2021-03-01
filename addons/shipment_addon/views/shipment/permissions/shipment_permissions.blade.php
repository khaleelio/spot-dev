
@if (\App\Addon::where('unique_identifier', 'shipment_addon')->first()->activated)
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Shipment Index') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1008" @php if(isset($permissions) && in_array(1008, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
@endif