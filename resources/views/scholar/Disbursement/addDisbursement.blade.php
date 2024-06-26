@include('includes/header')
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  @include('includes/navbar')
  @include('includes/menubar')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Disbursement</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Students</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Disbursement Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('scholar.DisbursementAdd') }}">
              @csrf
             <input type="hidden" name="Scholar_id" value="{{$id}}">
              <div class="box-body">
                <div class="form-group">
                  <label for="memoNumber">Memo Number:</label>
                  <input type="text" class="form-control" id="memoNumber" name="MemoNumber" required>
                </div>

                <div class="form-group">
                  <label for="Date_memo">Date of Memo:</label>
                  <input type="date" class="form-control" id="Date_memo" name="Date_memo" required>
                </div>

                <div class="form-group">
                  <label for="Date_disbursement">Date of Disbursement:</label>
                  <input type="date" class="form-control" id="Date_disbursement" name="Date" required>
                </div>

                <div class="form-group">
                  <label for="amount">Actual Disbursement:</label>
                  <input type="number" class="form-control" id="amount_disbursement" name="amount" required>
                </div>

                <div class="form-group">
                  <label for="return_cmdi">Return to CMDI:</label>
                  <input type="number" class="form-control" id="return_cmdi" name="return_cmdi" required>
                </div>

                <div class="form-group">
                  <label for="remarks">Remarks:</label>
                  <input type="text" class="form-control" id="remarks" name="disbursement_remarks">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('includes/footer')
</div>
<!-- ./wrapper -->

@include('includes/scripts')

</body>
</html>
