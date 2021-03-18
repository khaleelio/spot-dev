@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('Shipments')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('admin.shipments.create') }}" class="btn btn-circle btn-info">
                <span>{{translate('Add New Shipment')}}</span>
            </a>
        </div>
    </div>
</div>

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">
                {{$page_name}}
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>{{translate('Actions')}}</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">{{translate('Choose an option:')}}</li>
                        <li class="navi-item">
                            @foreach($actions as $action)
                            @if(Auth::user()->user_type == 'admin' || in_array($item['permissions'], json_decode(Auth::user()->staff->role->permissions)))
                            @if($action['index'] == true)
                            <a href="#" class="navi-link @if(!isset($action['js_function_caller'])) action-caller @endif" @if(isset($action['js_function_caller'])) onclick="{{$action['js_function_caller']}}" @endif data-url="{{$action['url']}}" data-method="{{$action['method']}}">
                                <span class="navi-icon">
                                    <i class="{{$action['icon']}}"></i>
                                </span>
                                <span class="navi-text">{{$action['title']}}</span>
                            </a>
                            @endif
                            @endif
                            @endforeach
                        </li>

                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
        </div>
    </div>

    <div class="card-body">
        <!--begin::Search Form-->
        <form method="GET" action="{{url()->current()}}" >
        <div class="mb-7">
            <div class="row align-items-center">
                
                    <div class="col-lg-12 col-xl-12">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" name="code" value="<?php if(isset($_GET['code'])){echo $_GET['code'];}?>" class="form-control" placeholder="{{translate('Shipment Code')}}" id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">{{translate('Client')}}:</label>
                                    <select name="client_id" class="form-control" id="kt_datatable_search_status">
                                        <option value="">{{translate('All')}}</option>
                                        @foreach(\App\Client::all() as $client)
                                        <option @if(isset($_GET['client_id']) && $_GET['client_id'] == $client->id)  selected @endif value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">{{translate('Type')}}:</label>
                                    <select name="type" class="form-control" id="kt_datatable_search_type">
                                        <option value="">All</option>
                                        @if($type == null || $type == \App\Shipment::PICKUP)
                                        <option @if(isset($_GET['type']) && $_GET['type'] == \App\Shipment::PICKUP)  selected @endif value="{{\App\Shipment::PICKUP}}">{{translate('Pickup')}}</option>
                                        @endif
                                        @if($type == null || $type == \App\Shipment::DROPOFF)
                                        <option @if(isset($_GET['type']) && $_GET['type'] == \App\Shipment::DROPOFF)  selected @endif value="{{\App\Shipment::DROPOFF}}">{{translate('Dropoff')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row align-items-center">
                            
                            <div class="col-md-4 my-2 my-md-5">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">{{translate('Branch')}}:</label>
                                    <select name="branch_id" class="form-control" id="kt_datatable_search_type">
                                    <option value="">{{translate('All')}}</option>
                                        @foreach(\App\Branch::all() as $Branch)
                                        <option @if(isset($_GET['branch_id']) && $_GET['branch_id'] == $Branch->id)  selected @endif value="{{$Branch->id}}">{{$Branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">{{translate('Search')}}</button>
                    </div>
                
            </div>
            </form>
        </div>
        <!--end::Search Form-->
        <form id="tableForm">
            @csrf()
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th width="3%"></th>
                        <th width="3%">#</th>
                        <th>{{translate('Code')}}</th>
                        <th>{{translate('Status')}}</th>
                        <th>{{translate('Type')}}</th>
                        <th>{{translate('Client')}}</th>
                        <th>{{translate('Branch')}}</th>

                        <th>{{translate('Shipping Cost')}}</th>
                        <th>{{translate('Payment Method')}}</th>
                        <th>{{translate('Shipping Date')}}</th>
                        @if($status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS)
                        <th>{{translate('Captain')}}</th>
                        @endif
                        @if($status == \App\Shipment::APPROVED_STATUS || $status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS)
                        <th>{{translate('Manifest')}}</th>
                        @endif
                        <th class="text-center">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($shipments as $key=>$shipment)

                    <tr>
                        <td><label class="checkbox checkbox-success"><input data-clientid="{{$shipment->client->id}}" type="checkbox" class="sh-check" name="checked_ids[]" value="{{$shipment->id}}" /><span></span></label></td>
                        <td width="3%">{{ ($key+1) + ($shipments->currentPage() - 1)*$shipments->perPage() }}</td>
                        <td width="5%">D{{$shipment->code}}</td>
                        <td><a href="">{{$shipment->getStatus()}}</a></td>
                        <td>{{$shipment->type}}</td>
                        <td><a href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a></td>
                        <td><a href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>

                        <td>{{$shipment->shipping_cost}}</td>
                        <td>{{$shipment->payment_method}}</td>
                        <td>{{$shipment->shipping_date}}</td>
                        @if($status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS)


                        <td>@isset($shipment->captain_id) {{$shipment->captain->name}} @endisset</td>


                        @endif
                        @if($status == \App\Shipment::APPROVED_STATUS || $status == \App\Shipment::CAPTAIN_ASSIGNED_STATUS || $status == \App\Shipment::RECIVED_STATUS )

                        <td> @isset($shipment->current_mission->id) M {{$shipment->current_mission->code}} @endisset</td>

                        @endif
                        <td class="text-center">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.shipments.show', $shipment->id)}}" title="{{ translate('Show') }}">
                                <i class="las la-eye"></i>
                            </a>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.shipments.edit', $shipment->id)}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>

                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

            <!-- Assign-to-captain Modal -->
            <div id="assign-to-captain-modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        @if(isset($status))
                        @if($status == \App\Shipment::SAVED_STATUS || $status == \App\Shipment::REQUESTED_STATUS)
                        <div class="modal-header">
                            <h4 class="modal-title h6">{{translate('Create Pickup Manifest')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Client/Sender')}}:</label>

                                        <select name="Mission[client_id]" class="form-control">
                                            @foreach(\App\Client::all() as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Pickup Address')}}:</label>
                                        <input type="text" name="Mission[address]" class="form-control" />

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Type')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Pickup')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Status')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Requested')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                            </div>

                        </div>
                        @elseif($status == \App\Shipment::APPROVED_STATUS)
                        <div class="modal-header">
                            <h4 class="modal-title h6">{{translate('Create Delivery Manifest')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Client/Sender')}}:</label>

                                        <select name="Mission[client_id]" class="form-control">
                                            @foreach(\App\Client::all() as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Delivery Address')}}:</label>
                                        <input type="text" name="Mission[address]" class="form-control" />

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Type')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Delivery')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Status')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Requested')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                            </div>

                        </div>
                        @elseif($status == \App\Shipment::DELIVERED_STATUS)
                        <div class="modal-header">
                            <h4 class="modal-title h6">{{translate('Create Supply Manifest')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Client/Sender')}}:</label>

                                        <select name="Mission[client_id]" class="form-control">
                                            @foreach(\App\Client::all() as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Supply Address')}}:</label>
                                        <input type="text" name="Mission[address]" class="form-control" />

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Type')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Supply')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Status')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Requested')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                            </div>

                        </div>
                        @elseif($status == \App\Shipment::RETURNED_STOCK)
                        <div class="modal-header">
                            <h4 class="modal-title h6">{{translate('Create Return Manifest')}}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Client/Sender')}}:</label>

                                        <select name="Mission[client_id]" class="form-control">
                                            @foreach(\App\Client::all() as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Address')}}:</label>
                                        <input type="text" name="Mission[address]" class="form-control" />

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Amount')}}:</label>
                                        <input type="number" name="Mission[amount]" class="form-control" value="0" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Type')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Return')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Status')}}:</label>
                                        <input style="background:#f3f6f9;color:#3f4254;" type="text" class="form-control disabled" value="{{translate('Requested')}}" disabled="disabled" readonly />
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{translate('Create Manifest')}}</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->
            @endif


        </form>
        <div class="aiz-pagination">
            {{ $shipments->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('shipment_addon',$currentView) !!}

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function openCaptainModel(element, e) {
        var selected = [];
        $('.sh-check:checked').each(function() {
            selected.push($(this).data('clientid'));
        });
        if(selected.length == 1)
        {
            $('#tableForm').attr('action', $(element).data('url'));
            $('#tableForm').attr('method', $(element).data('method'));
            $('#assign-to-captain-modal').modal('toggle');
        }else if(selected.length == 0)
        {
            Swal.fire("{{translate('Please Select Shipments')}}", "", "error");
        }else if(selected.length > 1)
        {
            
            Swal.fire("{{translate('Select shipments of the same client to Assign')}}", "", "error");
        }
    }

    function openAssignShipmentCaptainModel(element, e) {
        var selected = [];
        $('.sh-check:checked').each(function() {
            selected.push($(this).data('clientid'));
        });
        if(selected.length == 1)
        {
            $('#tableForm').attr('action', $(element).data('url'));
            $('#tableForm').attr('method', $(element).data('method'));
            $('#assign-to-captain-modal').modal('toggle');
        }else if(selected.length == 0)
        {
            Swal.fire("{{translate('Please Select Shipments')}}", "", "error");
        }else if(selected.length > 1)
        {
            
            Swal.fire("{{translate('Select shipments of the same client to Assign')}}", "", "error");
        }
    }
    $(document).ready(function() {
        $('.action-caller').on('click', function(e) {
            e.preventDefault();
            $('#tableForm').attr('action', $(this).data('url'));
            $('#tableForm').attr('method', $(this).data('method'));
            $('#tableForm').submit();
        });

        FormValidation.formValidation(
            document.getElementById('tableForm'), {
                fields: {
                    "Mission[address]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Mission[client_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    }


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