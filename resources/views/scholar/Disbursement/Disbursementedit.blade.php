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
      <!-- ADD Disbursement Form -->
      <form method="post" action="{{ route('scholar.Updatedisbursement', ['id' => $disbursement->id]) }}">
        @csrf
        @method('put')
        <input type="hidden" id="id" name="Scholar_id">

        <div class="form-group">
          <label for="memoNumber">Memo Number:</label>
          <input type="text" class="form-control" id="memoNumber" name="MemoNumber" value = "{{$disbursement->MemoNumber}}" >
        </div>

        <div class="form-group">
          <label for="Date_memo">Date of Memo:</label>
          <input type="date" class="form-control" id="Date_memo" name="Date_memo" value = "{{$disbursement->Date_memo}}">
        </div>

        <div class="form-group">
          <label for="Date_disbursement">Date of Disbursement:</label>
          <input type="date" class="form-control" id="Date_disbursement" name="Date" value = "{{$disbursement->Date}}">
        </div>

        <div class="form-group">
          <label for="amount">Actual Disbursement:</label>
          <input type="number" class="form-control" id="amount_disbursement" name="amount" value = "{{$disbursement->amount}}">
        </div>

        <div class="form-group">
          <label for="return_cmdi">Return to CMDI:</label>
          <input type="number" class="form-control" id="return_cmdi" name="return_cmdi" value = "{{$disbursement->return_cmdi}}">
        </div>

        <div class="form-group">
          <label for="remarks">Remarks:</label>
          <input type="text" class="form-control" id="remarks" name="disbursement_remarks" value = "{{$disbursement->disbursement_remarks}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
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
