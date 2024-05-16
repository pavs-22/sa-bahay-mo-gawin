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
              <div class="row">
                <div class="col-xs-3 text-center">
                  <a href="{{route('scholar.list')}}" data-toggle="modal" class="btn btn-primary btn-sm btn-flat" style="padding: 5px;">
                    <i class="fa fa-list"></i> List
                  </a>
                </div>
                <div class="col-xs-3 text-center">
                  <a href="{{ route('scholar.edit', $scholar->id) }}" class="btn btn-success btn-sm btn-flat" style="padding: 5px;">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                </div>
                <div class="col-xs-3 text-center">
                  <a href="#Disbursement" data-toggle="modal" class="btn btn-success btn-sm btn-flat" style="padding: 5px;">
                    <i class="fa fa-edit"></i> Disburse
                  </a> 
                </div>
                <div class="col-xs-3 text-center">
                  <form method="POST" action="{{ route('scholar.Delete', ['id' => $scholar->id]) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger btn-sm btn-flat" style="padding: 5px;" onclick="return confirm('Are you sure you want to delete this scholar?')">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </div>
              </div>
            </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <!-- Wrapping div with overflow-x: auto for horizontal scrolling -->
                  <div style="overflow-x:auto;">
                    <table id="example1" class="table table-bordered">
                      <div class="form-group" style="margin-bottom: 15px">
                        <h1>Scholar Information</h1><br><br>
                        <h4>Scholar Name&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->fullname}}</h4>
                        <p>Scholar Code&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->scholar_code}}</p>
                        <p>Institution&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->institution}}</p>
                        <p>Unit&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->unit}}</p>
                        <p>Area&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->area}}</p>
                        <p>Name of Member&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->name_of_member}}</p>
                        <p>Batch&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->batch}}</p>
                        <p>Scholarship Type&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->scholarship_type}}</p>
                        <p>Year_level&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->year_level}}</p>
                        <p>Course&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->course}}</p>
                        <p>Contact&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->contact}}</p>
                        <p>Address&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->address}}</p>
                        <p>Status&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->status}}</p>
                        <p>Remarks&nbsp;&nbsp;:&nbsp;&nbsp;{{$scholar->remarks}}</p>
                      </div>
                    </table>
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
             
                <table id="example1" class="table ">
                  <thead style="background-color: #21ac21">

<!--                  <th class="hidden"></th>-->

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
                  
                  
            
                  @foreach($disbursements as $disbursement)
                </thead>
                <tr>
                <td>{{$scholar->fullname}}</td>
                <td>{{$scholar->institution}} </td>
                <td>{{$scholar->area}} </td>
                <td>{{$scholar->unit}} </td>
                <td>{{$scholar->batch}} </td>
                <td>{{$scholar->scholarship_type}} </td>
                <td>{{$scholar->year_level}} </td>
                <td>{{$disbursement->Date_memo }} </td>
                <td>{{ $disbursement->MemoNumber }} </td>
                <td>{{$disbursement->Date }} </td>
                <td>₱ {{number_format($disbursement->amount)}} </td>
                <td>₱ {{number_format($disbursement->return_cmdi)}} </td>
                <td>{{$scholar->status}} </td>  
                <td>{{$disbursement->disbursement_remarks}} </td>
                </tr>
                @endforeach
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
  </div>

  @include('includes/footer') 

  
 
</div>
</body>
</html>
