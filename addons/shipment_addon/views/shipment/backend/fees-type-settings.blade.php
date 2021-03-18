@extends('backend.layouts.app')

@section('content')
<style>
    label {
        font-weight: bold !important;
    }
</style>
<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Fees Info')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.shipments.settings.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group row">
                            <label class="col-2 col-form-label">{{translate('Fees Type')}}</label>
                            <div class="col-9 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success  btn btn-default">
                                        <input type="radio" @if( \App\ShipmentSetting::getVal('fees_type')  == 1) checked  @endif name="Setting[fees_type]" checked="checked" value="1" />
                                        <span></span>
                                        {{translate("Fixed Cost")}}
                                    </label>
                                    <label class="radio radio-success btn btn-default">
                                        <input type="radio" @if( \App\ShipmentSetting::getVal('fees_type')  == 2)  checked @endif name="Setting[fees_type]" value="2" />
                                        <span></span>
                                        {{translate("From State To State")}}
                                    </label>
                                    <label class="radio radio-success btn btn-default">
                                        <input type="radio" @if( \App\ShipmentSetting::getVal('fees_type')  == 4) checked  @endif name="Setting[fees_type]" value="4" />
                                        <span></span>
                                        {{translate("From Country to Country")}}
                                    </label>
                                    <label class="radio radio-success btn btn-default">
                                        <input type="radio" @if( \App\ShipmentSetting::getVal('fees_type')  == 5) checked  @endif name="Setting[fees_type]" value="5" />
                                        <span></span>
                                        {{translate("By Gram Price")}}
                                    </label>
                                    
                                    
                                </div>
                                

                            </div>
                            
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-lg btn-success">{{translate('Continue')}}</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection