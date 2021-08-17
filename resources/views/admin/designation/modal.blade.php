<div class="modal fade border-top-primary" id="designationModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">नयाँ बनाउने</h4>
            </div>

            <form action="{{route('designation.store')}}" autocomplete="off" class="form-horizontal" method="post" id="designationCreateForm">
            @csrf
            <input type="hidden" id="post_type" name="post_type" value="post"/>
            <input type="hidden" id="post_url" name="post_url" value="{{route('designation.store')}}"/>
            <div class="modal-body">
        <div class="form-group">
            <label class="col-sm-3 control-label" for="name">नाम *</label>
            <div class="col-md-9">
                <input class="form-control" id="name" name="name" placeholder="कर्मचारी पद" type="text" value="" required="true">
            </div>
        </div>
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">सुरक्षित गर्नुहोस्</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">बन्द गर्ने</button>
        </div>
</form>

        </div>
    </div>
</div>

