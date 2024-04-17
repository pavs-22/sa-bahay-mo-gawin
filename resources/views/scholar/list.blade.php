
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
        List of Scholars
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('scholar.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Scholars</li>
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
                <table id="example1" class="table ">
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
                  <th style="color: #ffffff">Action &nbsp</th>
                  
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
  <div id="monthYearModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Select Disbursement Month and Year</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="monthYearForm">
                    <div class="form-group">
                        <label for="month">Month:</label>
                        <select class="form-control" id="month" name="month">
                        <option value="None" class="form-control" disabled selected>--Make a Selection--</option>
                            <option value="1  ">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <input type="number" class="form-control" id="year" name="year" min="1900" max="2100" value="2024">
                    </div>
                    <input type="hidden" id="scholarId" name="scholarId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="$('#monthYearForm').submit()">Add to Calendar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('includes/scripts')
</div>


 </body>
</html>
