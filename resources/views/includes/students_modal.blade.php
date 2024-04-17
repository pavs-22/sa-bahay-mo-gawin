<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Scholar</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="post" action="{{route('scholar.store')}}">
                @csrf
				@method('post')
                <div class="form-group">
    <label for="time_out" class="col-sm-3 control-label">Institution</label>
    <div class="col-sm-9">
    <select class="form-control" name="institution" id="institution" required>
    <option selected disabled>--Make a Selection--</option>
    @foreach($institutions as $institution)
        <option value="{{ $institution->institute }}">{{ $institution->institute }}</option>
    @endforeach
</select>


    </div>
</div>

                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Unit</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="Unit" name="unit" oninput="this.value = this.value.toUpperCase()" required>
                  	</div>
                </div>

              <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Area</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="Area" name="area" oninput="this.value = this.value.toUpperCase()" required>
                  	</div>
                </div>

                

                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Full Name</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="fullname" name="fullname" oninput="this.value = this.value.toUpperCase()" required>
                  	</div>
                </div>
                
               
                
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Family member CARD Member</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="name_of_member" name="name_of_member" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Batch</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="batch" name="batch" oninput="this.value = this.value.toUpperCase()" required>
                  	</div>
                </div>
                <div class="form-group">
              	<label for="time_out" class="col-sm-3 control-label">Scholar Type</label>
                  	<div class="col-sm-9">                  		
							            <select class="form-control" name="scholarship_type" required>
    							         <option value="None" class="form-control" disabled selected>--Make a Selection--</option>
                                         @foreach($ScholarType as $scholartype)
        <option value="{{ $scholartype->type }}">{{ $scholartype->type }}</option>
    @endforeach
                       </select>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="time_out" class="col-sm-3 control-label">Year Level</label>
                  	<div class="col-sm-9">
          							<select class="form-control" name="year_level" required>
        						       <option value="None" class="form-control" disabled selected>--Make a Selection--</option>
                    		   <option class="form-control" value="GRADE 7">Grade 7</option>
							<option class="form-control" value="GRADE 8">Grade 8</option>
                           <option class="form-control" value="GRADE 9">Grade 9</option>
                           <option class="form-control" value="GRADE 10">Grade 10</option>
                           <option class="form-control" value="GRADE 11">Grade 11</option>
                           <option class="form-control" value="GRADE 12">Grade 12</option>
                           <option class="form-control" value="FIRST YEAR">First Year</option>
                           <option class="form-control" value="SECOND YEAR">Second Year</option>
                           <option class="form-control" value="THIRD YEAR">Third Year</option>
                           <option class="form-control" value="FOURTH YEAR">Fourth Year</option>
                           <option class="form-control" value="FIFTH YEAR">Fifth Year</option>
                      </select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Course</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="course" name="course" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                </div>
                <div class="form-group">
    <label for="contact" class="col-sm-3 control-label">Contact Number</label>
    <div class="col-sm-9"> 
        <input type="text" class="form-control" id="contact" name="contact" pattern="\d{11}" maxlength="11" title="Please enter exactly 11 digits." required>
        <small class="form-text text-muted">Please enter exactly 11 digits.</small>
    </div>
</div>


                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="address" name="address" oninput="this.value = this.value.toUpperCase()" required>
                    </div>
                </div>
                <div class="form-group">
                <label for="time_out" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">                      
                          <select class="form-control" name="status" oninput="this.value = this.value.toUpperCase()">
                            <option selected disabled>--Make a Selection--</option>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                            <option value="TOTALLY CANCELLED">TOTALLY CANCELLED</option>
                            <option value="GRADUATED">GRADUATED</option>
                            <option value="END CONTRACT">END OF CONTRACT</option>
                           
                       </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="Remarks" name="remarks"  required>
                    </div>
                </div>
                
             

               
               

    				


           


         
           
           


                         
				
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


<!-- Add -->
<div class="modal fade" id="addlist">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add List of Scholars</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="students_add_list.php">
               
               
              
               
                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Upload File</label>
                  	<div class="col-sm-9">
                    	<input type="file" class="form-control" id="scholar_list" name="scholar_list" accept=".xls, .xlsx, .csv" required>
                  	</div>
                </div>
  	
				
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="save_excel_data"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
     