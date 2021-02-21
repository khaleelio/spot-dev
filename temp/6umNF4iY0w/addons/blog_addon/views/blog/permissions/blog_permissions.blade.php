
@if (\App\Addon::where('unique_identifier', 'blog_addon')->first()->activated)
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Blog Posts') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1001" @php if(isset($permissions) && in_array(1001, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Blog Categories') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1002" @php if(isset($permissions) && in_array(1002, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Blog Tags') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1003" @php if(isset($permissions) && in_array(1003, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Blog Comments') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1004" @php if(isset($permissions) && in_array(1004, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
@endif