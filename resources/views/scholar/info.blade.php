@include('includes/header')

<style>
  body {
    background-color: #f4f4f9;
    font-family: Arial, sans-serif;
  }
  .container-fluid {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
    padding: 20px;
  }
  .scholar-info-box {
    padding: 30px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(46, 204, 113, 1);
    width: 100%;
    max-width: 1200px;
    border-left: 10px solid  rgba(46, 204, 113, 1);
  }
  .scholar-info h1 {
    margin-bottom: 20px;
    font-size: 28px;
    color:  black;
    border-bottom: 3px solid #eee;
    padding-bottom: 10px;
    text-align: center;
  }
  .scholar-info h4 {
    margin-bottom: 20px;
    font-size: 20px;
    color: #444;
  }
  .scholar-info p {
    margin-bottom: 12px;
    font-size: 16px;
    color: #555;
    line-height: 1.5;
  }
  .scholar-info p strong {
    color: black;
  }
  .form-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  tr.odd {
  background-color:lightgray; /* Light gray background for odd rows */
}

tr.even {
  background-color: #ffffff; /* White background for even rows */
}

</style>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  @include('includes/navbar')
  @include('includes/menubar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Scholar Information
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
    <div class="row justify-content-center">
        <div class="col-xs-6 col-sm-3 text-center mb-3">
            <a href="{{route('scholar.list')}}" class="btn btn-primary btn-block">
                <i class="fa fa-list mr-1"></i> View Scholar List
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 text-center mb-3">
            <a href="{{ route('scholar.edit', $scholar->id) }}" class="btn btn-success btn-block">
                <i class="fa fa-edit mr-1"></i> Edit Scholar
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 text-center mb-3">
            <a href="{{route('scholar.addDisbursement', $scholar->id)}}" class="btn btn-success btn-block">
                <i class="fa fa-money mr-1"></i> Add Disbursement
            </a>
        </div>
        <div class="col-xs-6 col-sm-3 text-center mb-3">
            <form method="POST" action="{{ route('scholar.Delete', ['id' => $scholar->id]) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this scholar?')">
                    <i class="fa fa-trash mr-1"></i> Delete Scholar
                </button>
            </form>
        </div>
    </div>
</div>



          <div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <!-- Scholar Information Box -->
      <div class="scholar-info-box">
        <div class="scholar-info">
          <h1>Scholar Information</h1>
          <div class="form-group">
            <h4><strong>Scholar Name:</strong> {{$scholar->fullname}}</h4>
            <p><strong>Scholar Code:</strong> {{$scholar->scholar_code}}</p>
            <p><strong>Institution:</strong> {{$scholar->institution}}</p>
            <p><strong>Unit:</strong> {{$scholar->unit}}</p>
            <p><strong>Area:</strong> {{$scholar->area}}</p>
            <p><strong>Name of Member:</strong> {{$scholar->name_of_member}}</p>
            <p><strong>Batch:</strong> {{$scholar->batch}}</p>
            <p><strong>Scholarship Type:</strong> {{$scholar->scholarship_type}}</p>
            <p><strong>Year Level:</strong> {{$scholar->year_level}}</p>
            <p><strong>Course:</strong> {{$scholar->course}}</p>
            <p><strong>Contact:</strong> {{$scholar->contact}}</p>
            <p><strong>Address:</strong> {{$scholar->address}}</p>
            <p><strong>Status:</strong> {{$scholar->status}}</p>
            <p><strong>Remarks:</strong> {{$scholar->remarks}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





                <section class="content">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header with-border">
                          <h1>Disbursement</h1>
                        </div>
                        <div class="box-body">
                          <!-- Wrapping div with overflow-x: auto for horizontal scrolling -->
                          <div style="overflow-x:auto;">
                            <table id="example1" class="table">
                              <thead style="background-color: #21ac21">
                                <th style="color: #ffffff">Scholar Name</th>
                                <th style="color: #ffffff">Institutions</th>
                                <th style="color: #ffffff">Area</th>
                                <th style="color: #ffffff">Unit</th>
                                <th style="color: #ffffff">Batch</th>
                                <th style="color: #ffffff">Scholarship Type</th>
                                <th style="color: #ffffff">Year level</th>
                                <th style="color: #ffffff">Date of Memo</th>
                                <th style="color: #ffffff">Memo Number</th>
                                <th style="color: #ffffff">Disbursement Date</th>
                                <th style="color: #ffffff">Actual Disbursement</th>
                                <th style="color: #ffffff">Return to CMDI</th>
                                <th style="color: #ffffff">Status</th>
                                <th style="color: #ffffff">Remarks</th>
                                <th style="color: #ffffff">Action</th>
                              </thead>
                              <tbody>
  @php $count = 0; @endphp
  @foreach($disbursements as $disbursement)
    @php $count++; @endphp
    <tr class="{{ $count % 2 == 0 ? 'even' : 'odd' }}">
      <td>{{$scholar->fullname}}</td>
      <td>{{$scholar->institution}}</td>
      <td>{{$scholar->area}}</td>
      <td>{{$scholar->unit}}</td>
      <td>{{$scholar->batch}}</td>
      <td>{{$scholar->scholarship_type}}</td>
      <td>{{$scholar->year_level}}</td>
      <td>{{$disbursement->Date_memo}}</td>
      <td>{{ $disbursement->MemoNumber }}</td>
      <td>{{$disbursement->Date}}</td>
      <td>₱ {{number_format($disbursement->amount)}}</td>
      <td>₱ {{number_format($disbursement->return_cmdi)}}</td>
      <td>{{$scholar->status}}</td>
      <td>{{$disbursement->disbursement_remarks}}</td>
      <td>
        <a href="{{ route('scholar.editDisbursement', $disbursement->id) }}" class="btn btn-primary btn-sm">
          <i class="fa fa-edit"></i>
        </a>
        <form action="" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this disbursement?')">
            <i class="fa fa-trash"></i>
          </button>
        </form>
      </td>
    </tr>
  @endforeach
</tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
            <form method="post" action="{{ route('scholar.save-disbursement') }}">
              @csrf
              <input type="hidden" id="id" name="Scholar_id">
              <div class="form-group">
                <label for="memoNumber">Memo Number:</label>
                <input type="text" class="form-control" id="memoNumber" name="MemoNumber" required>
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
                <input type="number" class="form-control" id="amount" name="return_cmdi" required>
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

  @include('includes/footer')

</div>
</body>
</html>
