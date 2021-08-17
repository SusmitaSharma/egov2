<div class="modal fade border-top-primary" id="solutionModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Feedback</h4>
            </div>

          
            <div class="modal-body">
                
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label" for="name">व्यक्तिको नाम</label>
                    <div class="col-md-9">
                        <input class="form-control" id="name"  placeholder="नाम" type="text" value="" readonly="true">
                    </div>
                </div>
                </div>



                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label" for="name">सम्पर्क नम्बर </label>
                    <div class="col-md-9">
                        <input class="form-control" id="number" name="number" placeholder="सम्पर्क नम्बर" type="text" value="" readonly="true">
                    </div>
                </div>
             </div>

             <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label" for="name">सुझाव </label>
                    <div class="col-md-9">
                        <textarea id="solution" class="form-control" readonly="true" cols="30"></textarea>
                       
                    </div>
                </div>
             </div>
       
        
            </div>
        <div class="modal-footer">
           
            <button type="button" class="btn btn-danger" data-dismiss="modal">बन्द गर्ने</button>
        </div>


        </div>
    </div>
</div>

@push('scripts')
<script>
$(function(){
    

});
</script>

@endpush
