@extends('backend.layouts.app')

@section('content')
<style>
    label
    {
        font-weight: bold!important;
    }
</style>
<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Shipping General Settings')}}</h5>
        </div>
       
        <form class="form-horizontal" action="{{ route('admin.shipments.settings.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>{{translate('Default Shipping Cost')}}:</label>
                        <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_shipping_cost')}}" name="Setting[def_shipping_cost]">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Default Tax')}}:</label>
                        <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_tax')}}" name="Setting[def_tax]">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Default Insurance')}}:</label>
                        <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_insurance')}}" name="Setting[def_insurance]">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Default Returned Shipment Cost')}}:</label>
                        <input type="number" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_return_cost')}}" name="Setting[def_return_cost]">
                    </div>
                    <div class="col-md-4">
                    <label class=" col-form-label">{{translate('Is Shipping date is required in shipment creation?')}}</label>
                        <div class="form-group row">
                            
                            <div class="col-12 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success">

                                        <input name="Setting[is_date_required]" @if(\App\ShipmentSetting::getVal('is_date_required') == '1' || \App\ShipmentSetting::getVal('is_date_required') == null) checked  @endif value="1" type="radio"  class="form-control"/>
                                        <span></span>
                                        {{translate('Yes')}}
                                    </label>
                                    <label class="radio radio-danger">
                                        <input name="Setting[is_date_required]" @if(\App\ShipmentSetting::getVal('is_date_required') == '0' ) checked  @endif value="0" type="radio"  class="form-control"/>
                                        <span></span>
                                        {{translate('No')}}
                                    </label>
                                   
                                </div>
                                
                            </div>
                        </div>
                        
                
                        
                    </div>
                </div>
                
               
                
                {!! hookView('shipment_addon',$currentView) !!}               

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    

                },
                

                plugins: {
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
    });
</script>
@endsection