{{-- Add New Item --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('website.widget.item.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Item') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{{ translate('Title') }}*:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{ translate('Body') }}*:</label>
                            <textarea class="form-control" id="message-text" name="body" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{ translate('Link') }}:</label>
                            <input type="text" class="form-control" id="recipient-name" name="link">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{ translate('Widget') }}:</label>
                            <select class="form-control form-control-sm" aria-label="Default select example"
                                name="widget_id">
                                @foreach ($widgets as $widget)
                                    <option value="{{ $widget->id }}">{{ $widget->title }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>