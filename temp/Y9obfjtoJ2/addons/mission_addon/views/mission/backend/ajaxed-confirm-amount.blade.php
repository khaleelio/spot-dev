<form action="{{route('admin.missions.action',['to'=>\App\Mission::RECIVED_STATUS])}}" method="POST">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title h6">{{translate('Confirm Mission Amount')}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{translate('Amount')}}:</label>
                    <input type="hidden" class="form-control" value="{{$mission->id}}" name="checked_ids[]"/>
                    <input type="number" class="form-control" value="{{$mission->amount}}" name="amount"/>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
        <button type="submit" class="btn btn-primary">{{translate('Confirm amount and Receive')}}</button>
    </div>
</form>