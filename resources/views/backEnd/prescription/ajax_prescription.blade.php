<div class="modal-header">
    <h5 class="modal-title">Prescription</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-sm-7">
            <img src="{{ asset($data->image) }}" style="width: 100%;" />
        </div>
        <div class="col-sm-5 ">
            <p>{{ $data->note }}</p>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
