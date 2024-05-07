<!-- jQuery 3 -->
<script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('/bower_components/morris.js/morris.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('/bower_components/chart.js/Chart.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/dist/js/pages/dashboard.js')}}"></script>
<script>
$(function () {
    // Function to initialize DataTable with filtering
    function initializeDataTable(tableId, routeName) {
        $('#' + tableId).DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": routeName, // Use the provided route name directly
            "columns": [
                {
                    "data": "fullname",
                    "render": function (data, type, row) {
                        // This creates a hyperlink and uses the viewRecord function on click
                        return `<a href="javascript:void(0);" onclick="viewRecord(${row.id})">${data}</a>`;
                    }
                },
                { "data": "institution" },
                { "data": "area" },
                { "data": "unit" },
                { "data": "name_of_member" },
                { "data": "batch" },
                { "data": "scholarship_type" },
                { "data": "year_level" },
                { "data": "status" },
                {
                    "data": null,
                    "defaultContent": "",
                    "sortable": false,
                    "render": function (data, type, row) {
                        return `
                        <i class="fa fa-pencil text-primary" onclick="editRecord(${row.id})" style="cursor: pointer;"></i>
                        <i class="fa fa-trash text-danger" onclick="deleteRecord(${row.id})" style="cursor: pointer; margin-left: 10px;"></i>
                        <i class="fa fa-plus-circle text-success" onclick="Disbursement(${row.id})" style="cursor: pointer; margin-left: 10px;"></i>
                        `;
                    }
                }
            ]
        });
    }

    // Initialize DataTable for each table with corresponding route names
    initializeDataTable('example1', "{{ route('scholar.fetch-paginate') }}");
    initializeDataTable('highschool', "{{ route('scholar.fetch-high-school') }}");
    initializeDataTable('seniorhigh', "{{ route('scholar.fetch-senior-high') }}");
    initializeDataTable('college', "{{ route('scholar.fetch-college') }}");
 // Show the modal form when the icon button is clicked
 $('#addMonthYearButton').click(function () {
        $('#addMonthYearForm').modal('show');
    });
});

function Disbursement(id) {
    // Set the ID in the hidden input field of the modal
    document.getElementById('id').value = id;
    // Show the modal
    $('#Disbursement').modal('show');
}
function viewRecord(id) {
    // Redirect to the details page for the specific record
    window.location.href = "{{ route('scholar.info', ['id' => ':id']) }}".replace(':id', id);
}

function editRecord(id) {
    // Redirect to the edit page for the specific record
    window.location.href = "{{ route('scholar.edit', ['id' => ':id']) }}".replace(':id', id);
}

function deleteRecord(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            type: "PUT",
            url: "{{ route('scholar.softdelete', ['id' => ':id']) }}".replace(':id', id),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                // Handle success, e.g., show a success message
                console.log("Record soft deleted successfully");

                // Refresh DataTable
                ['example1', 'highschool', 'seniorhigh', 'college'].forEach(function (tableId) {
                    $('#' + tableId).DataTable().ajax.reload();
                });
            },
            error: function (xhr, status, error) {
                // Handle error, e.g., show an error message
                console.error("Error deleting record:", error);
            }
        });
    }
}



</script>



<script>


$(function(){
  /** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.sidebar-menu a').filter(function() {
     return this.href == url;
  }).parent().addClass('active');

  // for treeview
  $('ul.treeview-menu a').filter(function() {
     return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
  
});
</script>
<script>
$(function(){
	//Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
});
</script>
