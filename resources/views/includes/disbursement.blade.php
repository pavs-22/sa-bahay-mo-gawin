
<!-- Add -->
<div class="modal fade" id="disbursement">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Scholar</b></h4>
          	</div>
          	<div class="modal-body">
            <form method="post"  action="{{ route('scholar.save-disbursement') }}" >
                    @csrf
                    <input type="hidden" id="id" name="Scholar_id">
                    <div class="form-group">
                        <label for="memoNumber">Memo Number:</label>
                        <input type="text" class="form-control" id="memoNumber" name="MemoNumber"required>
                    </div>
                    <div class="form-group">
                       <label for="Date">Date of Memo:</label>
                       <input type="date" class="form-control" id="Date" name="Date_memo" required>
                    </div>
                    <div class="form-group">
                       <label for="Date">Date of Disbursement:</label>
                       <input type="date" class="form-control" id="Date" name="Date" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Actual Disbursement:</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Return to CMDI:</label>
                        <input type="number" class="form-control" id="amount" name="return_cmdi"  required>
                    </div>

                    <div class="form-group">
                        <label for="remarks">Remarks:</label>
                        <input type="text" class="form-control" id="remarks" name="disbursement_remarks">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            	
          	</div>
        </div>
    </div>
</div>