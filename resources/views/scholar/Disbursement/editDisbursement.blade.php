
@include('includes/header')
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  
  @include('includes/navbar')
  @include('includes/menubar')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Disbursement Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>
    <!-- Main content -->
    <!-- Edit -->


            	<form class="form-horizontal" method="POST" action="{{ route('scholar.update', ['id' => $scholar->id]) }}">
                @csrf
				@method('put')
                <div class="form-group">
                <label for="time_out" class="col-sm-3 control-label">Institution</label>
                    <div class="col-sm-9">                      
                          <select class="form-control" name="institution"  >
                            <option value = "{{$scholar->institution}}">{{$scholar->institution}}</option>
                            @foreach($institutions as $institution)
        <option value="{{ $institution->institute }}">{{ $institution->institute }}</option>
    @endforeach
                       </select>
                    </div>
                </div>
                

                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Unit</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="Unit" name="unit" value="{{$scholar->unit}}" oninput="this.value = this.value.toUpperCase()" >
                  	</div>
                </div>

              <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Area</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="Area" name="area" value="{{$scholar->area}}" oninput="this.value = this.value.toUpperCase()" >
                  	</div>
                </div>


                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Full Name</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="fullname" name="fullname" value = "{{$scholar->fullname}}" oninput="this.value = this.value.toUpperCase()" >
                  	</div>
                </div>
               
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Family member CARD Member</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="name_of_member" name="name_of_member" value="{{$scholar->name_of_member}}" oninput="this.value = this.value.toUpperCase()" >
                    </div>
                </div>
                <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Batch</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="batch" name="batch" value="{{$scholar->batch}}" oninput="this.value = this.value.toUpperCase()"disabled>
                  	</div>
                </div>
                <div class="form-group">
              	<label for="time_out" class="col-sm-3 control-label">Scholar Type</label>
                  	<div class="col-sm-9">                  		
							            <select class="form-control" name="scholarship_type" disabled>
    							         <option class="form-control" value = "{{$scholar->scholarship_type}}">{{$scholar->scholarship_type}}</option>
                           @foreach($ScholarType as $scholartype)
    <option value="{{ $scholartype->type }}">{{ $scholartype->type }}</option>
@endforeach

                       </select>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="time_out" class="col-sm-3 control-label">Year Level</label>
                  	<div class="col-sm-9">
          							<select class="form-control" name="year_level">
        						       <option class="form-control" value = "{{$scholar->year_level}}" >{{$scholar->year_level}}</option>
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
                       <input type="text" class="form-control" id="course" name="course" value = "{{$scholar->course}}" oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>
                <div class="form-group">
    <label for="contact" class="col-sm-3 control-label">Contact Number</label>
    <div class="col-sm-9"> 
        <input type="text" class="form-control" id="contact" name="contact" value = "{{$scholar->contact}}" pattern="\d{11}" maxlength="11" title="Please enter exactly 11 digits." >
        <small class="form-text text-muted">Please enter exactly 11 digits.</small>
    </div>
</div>

                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="address" name="address" value = "{{$scholar->address}}" oninput="this.value = this.value.toUpperCase()">
                    </div>
                </div>
                <div class="form-group">
                <label for="time_out" class="col-sm-3 control-label">Status</label>
                    <div class="col-sm-9">                      
                          <select class="form-control" name="status" >
                            <option value = "{{$scholar->status}}">{{$scholar->status}}</option>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                            <option value="TOTALLY CANCELLED">TOTALLY CANCELLED</option>
                            <option value="GRADUATED">GRADUATED</option>
                            <option value="END OF CONTRACT">END OF CONTRACT</option>
                           
                       </select>
                    </div>
                    </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Remarks</label>
                    <div class="col-sm-9"> 
                       <input type="text" class="form-control" id="Remarks" name="remarks" value = "{{$scholar->remarks}}" >
                    </div>
                </div>
                <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">

            <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            <a href="{{ route('scholar.list') }}" class="btn btn-default">Cancel</a> <!-- Default color -->
          </div>
    </div></form>
          	
        </div>
    </div>

</div>

  @include('includes/footer') 
  @include('includes/students_modal')  

  
 
</div>
@include('includes/scripts')

 </body>
</html>
