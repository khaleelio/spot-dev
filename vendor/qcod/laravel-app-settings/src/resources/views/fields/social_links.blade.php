<div class="form-group">
    <label>{{ translate('Social Links') }}</label>
    <div class="w3-links-target" id="content_rows">
        <input type="hidden" name="social_links_icon[]">
        <input type="hidden" name="social_links_name[]">
        @foreach (setting()->get('social_links_name') as $key => $social_link_name)
            @if($social_link_name || setting()->get('social_links_icon')[$key])
                <div class="row gutters-5">
                    <div class="col-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="https://" name="social_links_name[]" value="{{setting()->get('social_links_name')[$key]}}">
                        </div>
                    </div>
                    <div class="col-3 button-add-icon">
                        <button btn btn-success mr-2 type="button" id="GetIconPicker-{{$key}}" data-iconpicker-input="#MyIconInput-{{$key}}" data-iconpicker-preview="#MyIconPreview-{{$key}}" class="icon-picker">Select Icon</button>
                        <input type="hidden" name="social_links_icon[]" id="MyIconInput-{{$key}}" value="{{setting()->get('social_links_icon')[$key]}}">
                    </div>
                    <div class="col-2">
                        <i id="MyIconPreview-{{$key}}" class="{{setting()->get('social_links_icon')[$key]}}" style="font-size: 35px;color: black;"></i>
                    </div>
                    <div class="col-2">
                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-03-11-144509/theme/html/demo1/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </button>
                    </div>
                </div>
            @endif
        @endforeach
            
    </div>
    <button type="button" class="btn btn-soft-secondary btn-sm float-right mb-5" onclick="add_row()" >
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-03-11-144509/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="12"/>
                <rect fill="#000000" x="11" y="4" width="2" height="16" ry="1"/>
            </g>
        </svg><!--end::Svg Icon--></span>
    </button>
</div>