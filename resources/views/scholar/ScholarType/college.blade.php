

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
        College
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     
       
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            
      
            <div class="box-body">
              <!-- Wrapping div with overflow-x: auto for horizontal scrolling -->
              <div style="overflow-x:auto;">
                <table id="college" class="table table-bordered">
                  <thead style="background-color: #21ac21">

<!--                  <th class="hidden"></th>-->
                  <th style="color: #ffffff">Scholar Name</th>
                  <th style="color: #ffffff">Institutions</th>
                  <th style="color: #ffffff">Area</th>
                  <th style="color: #ffffff">Unit</th>
                  <th style="color: #ffffff">Member Name</th>
                  <th style="color: #ffffff">Batch</th>
                  <th style="color: #ffffff">Scholarship Type</th>
		              <th style="color: #ffffff">Year level</th>
                  <th style="color: #ffffff">Status</th>
                  <th style="color: #ffffff">Action</th>
                </thead>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>

  @include('includes/footer') 
  @include('includes/students_modal')  

  
  <!-- Add Month and Year Modal -->
  <div class="modal fade" id="Disbursement" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Disbursement</h4>
            </div>
            <div class="modal-body">
            @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
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
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Return to CMDI:</label>
                        <input type="text" class="form-control" id="amount" name="return_cmdi" required>
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
 
</div>
@include('includes/scripts')

 </body>
</html>
