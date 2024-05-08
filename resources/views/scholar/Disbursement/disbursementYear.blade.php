

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
        List of All Students
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
           
            
      
            <div class="box-body">
              <!-- Wrapping div with overflow-x: auto for horizontal scrolling -->
              <div style="overflow-x:auto;">
                <table id="tableDisbursementYear" class="table table-bordered">
                  <thead style="background-color: #21ac21">

<!--                  <th class="hidden"></th>-->
                    <th style="color: #ffffff">Scholar Name</th>
                    <th style="color: #ffffff">Institutions</th>
                    <th style="color: #ffffff">Area</th>
                    <th style="color: #ffffff">Unit</th>
                    <th style="color: #ffffff">Batch</th>
                    <th style="color: #ffffff">Scholarship Type</th>
		                <th style="color: #ffffff">Year level</th>
                    <th style="color: #ffffff">Memo Number</th>
                    <th style="color: #ffffff">Disbursement Date</th>
                    <th style="color: #ffffff">Actual Disbursement</th>
                    <th style="color: #ffffff">Return to CMDI</th>
                    <th style="color: #ffffff">Status</th>
                    <th style="color: #ffffff">Remarks</th>
                    
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


  
 
</div>
@include('includes/scripts')

 </body>
</html>
