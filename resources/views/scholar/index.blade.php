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
        Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div  class="small-box bg-green">
            <div class="inner">

            @isset($totalScholars)
          <h3>{{number_format($totalScholars) }}</h3>
            @else
           <h3>0</h3>
            @endisset



              <p data-toggle="tooltip" data-placement="top" title="Tooltip on top">Total Scholars</p>
       
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

            @isset($highSchool)
          <h3>{{ number_format($highSchool) }}</h3>
            @else
           <h3>0</h3>
            @endisset
             
              <p data-toggle="tooltip" data-placement="bottom" title="total">Total High School</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.highschool') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            @isset($college)
          <h3>{{ number_format($college) }}</h3>
            @else
           <h3>0</h3>
            @endisset
             
              <p>Total College</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.college') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             
            @isset($seniorHigh)
          <h3>{{number_format( $seniorHigh) }}</h3>
            @else
           <h3>0</h3>
            @endisset

              <p>Total Senior High School</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.seniorhigh') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
           </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div  class="small-box bg-green">
            <div class="inner">

                  
            @isset($special)
          <h3>{{number_format( $special) }}</h3>
            @else
           <h3>0</h3>
            @endisset

              <p>Total Special Scholarship</p>
       
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

            @isset($BEHighschool)
          <h3>{{ number_format($BEHighschool) }}</h3>
            @else
           <h3>0</h3>
            @endisset
             
              <p data-toggle="tooltip" data-placement="bottom" title="total">Total Balik Eskwela High School</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.highschool') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            @isset($BECollege)
          <h3>{{ number_format($BECollege) }}</h3>
            @else
           <h3>0</h3>
            @endisset
             
              <p>Total Balik Eskwela College</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.college') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             
            @isset($DSHP)
          <h3>{{number_format( $DSHP) }}</h3>
            @else
           <h3>0</h3>
            @endisset

              <p>Total DSHP College</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.seniorhigh') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
           </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div  class="small-box bg-green">
            <div class="inner">

                  
            @isset($CSP2)
          <h3>{{number_format( $CSP2) }}</h3>
            @else
           <h3>0</h3>
            @endisset

              <p>Total CSP 2</p>
       
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{ route('scholar.list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        
      </div>
    



  

            <div class="box-body">
              <div class="chart">
                <br>
                <div id="legend" class="text-center"></div>
                <canvas id="barChart" style="height:350px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </!--div>

      </section>
      
      <!-- right col -->
    </div>

    
    @include('includes/footer') 

</div>
<!-- ./wrapper -->

<!-- Chart Data -->
<!-- End Chart Data -->
@include('includes/scripts')
<script>
$(function(){
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : months,
    datasets: [
      {
        label               : 'Late',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : 'late'
      },
      {
        label               : 'Ontime',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : 'ontime'
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>

</body>
</html>
