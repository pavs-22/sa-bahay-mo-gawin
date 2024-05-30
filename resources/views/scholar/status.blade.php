@include('includes/header')
<style>
body {
    background-color: #f4f4f9;
    font-family: Arial, sans-serif;
}

.container-fluid {
    display: block; /* Changed from flex to block */
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
    margin: 0 auto; /* Center the scholar-info-box horizontally */
}

.scholar-info h1 {
    margin-bottom: 20px;
    font-size: 28px;
    color: black;
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
    background-color: lightgray; /* Light gray background for odd rows */
}

tr.even {
    background-color: #ffffff; /* White background for even rows */
}


</style>
<script>
        function generateAndDownloadImage(scholarId) {
            fetch(`/scholar/image`)
                .then(response => response.json())
                .then(data => {
                    const link = document.createElement('a');
                    link.href = data.file;
                    link.download = 'scholar_table.png';
                    link.click();
                })
                .catch(error => console.error('Error:', error));
        }
    </script>


</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    @include('includes/navbar')
    @include('includes/menubar')
    <!-- Content Wrapper. Contains page content -->
                   <div class="content-wrapper">
                     <section class="content-header">
                            <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                                <li class="active">Status</li>
                            </ol>
                        </section>
                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Scholar Information Box -->
                                        <div class="scholar-info-box">
                                            <div class="scholar-info">
                                                <h1>CARD Scholarship Program</h1>
                                                
                                                    <div class="table-responsive">
                                                        <table id="report" class="table table-bordered">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Scholarship Type &nbsp&nbsp&nbsp</th>
                                                                    <th>Active</th>
                                                                    <th>Inactive/LOA</th>
                                                                    <th>Totally Cancelled</th>
                                                                    <th>Academic Graduate</th>
                                                                    <th>End of Contract</th>
                                                                    <th>Total Support</th>
                                                                </tr>
                                                            </thead>
                                                         <tbody>
                                                            <tr>
                        <td>COLLEGE</td>
                      
         
          @isset($college_active) <td>{{number_format( $college_active) }}</td>@endisset
          @isset($college_inactive) <td>{{number_format( $college_inactive) }}</td>@endisset
          @isset($college_tc) <td>{{number_format( $college_tc) }}</td>@endisset
          @isset($college_graduated) <td>{{number_format( $college_graduated) }}</td>@endisset
          @isset($college_eoc) <td>{{number_format( $college_eoc) }}</td>@endisset

          @php
    $total = 0;
    if(isset($college_active)) $total += $college_active;
    if(isset($college_inactive)) $total += $college_inactive;
    if(isset($college_tc)) $total += $college_tc;
    if(isset($college_graduated)) $total += $college_graduated;
    if(isset($college_eoc)) $total += $college_eoc;
@endphp

<td>{{ number_format($total) }}</td>
          
                    </tr>
                    <tr>
                        <td>HIGH SCHOOL</td>
                        @isset($highSchool_active) <td>{{number_format( $highSchool_active) }}</td>@endisset
          @isset($highSchool_inactive) <td>{{number_format( $highSchool_inactive) }}</td>@endisset
          @isset($highSchool_tc) <td>{{number_format( $highSchool_tc) }}</td>@endisset
          @isset($highSchool_graduated) <td>{{number_format( $highSchool_graduated) }}</td>@endisset
          @isset($highSchool_eoc) <td>{{number_format( $highSchool_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($highSchool_active)) $total += $highSchool_active;
                  if(isset($highSchool_inactive)) $total += $highSchool_inactive;
                  if(isset($highSchool_tc)) $total += $highSchool_tc;
                  if(isset($highSchool_graduated)) $total += $highSchool_graduated;
                  if(isset($highSchool_eoc)) $total += $highSchool_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr class="section-header">
                      <td colspan="7"><center><strong>SENIOR HIGH SCHOOL</strong></center></td>
                    </tr>
                    <tr>
                        <td>CMDI Bay</td>
                        
          @isset($seniorHigh_cmdibay_active) <td>{{number_format( $seniorHigh_cmdibay_active) }}</td>@endisset
          @isset($seniorHigh_cmdibay_inactive) <td>{{number_format( $seniorHigh_cmdibay_inactive) }}</td>@endisset
          @isset($seniorHigh_cmdibay_tc) <td>{{number_format( $seniorHigh_cmdibay_tc) }}</td>@endisset
          @isset($seniorHigh_cmdibay_graduated) <td>{{number_format( $seniorHigh_cmdibay_graduated) }}</td>@endisset
          @isset($seniorHigh_cmdibay_eoc) <td>{{number_format( $seniorHigh_cmdibay_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($seniorHigh_cmdibay_active)) $total += $seniorHigh_cmdibay_active;
                  if(isset($seniorHigh_cmdibay_inactive)) $total += $seniorHigh_cmdibay_inactive;
                  if(isset($seniorHigh_cmdibay_tc)) $total += $seniorHigh_cmdibay_tc;
                  if(isset($seniorHigh_cmdibay_graduated)) $total += $seniorHigh_cmdibay_graduated;
                  if(isset($seniorHigh_cmdibay_eoc)) $total += $seniorHigh_cmdibay_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>CMDI Tagum</td>
                        @isset($seniorHigh_cmditagum_active) <td>{{number_format( $seniorHigh_cmditagum_active) }}</td>@endisset
          @isset($seniorHigh_cmditagum_inactive) <td>{{number_format( $seniorHigh_cmditagum_inactive) }}</td>@endisset
          @isset($seniorHigh_cmditagum_tc) <td>{{number_format( $seniorHigh_cmditagum_tc) }}</td>@endisset
          @isset($seniorHigh_cmditagum_graduated) <td>{{number_format( $seniorHigh_cmditagum_graduated) }}</td>@endisset
          @isset($seniorHigh_cmditagum_eoc) <td>{{number_format( $seniorHigh_cmditagum_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($seniorHigh_cmditagum_active)) $total += $seniorHigh_cmditagum_active;
                  if(isset($seniorHigh_cmditagum_inactive)) $total += $seniorHigh_cmditagum_inactive;
                  if(isset($seniorHigh_cmditagum_tc)) $total += $seniorHigh_cmditagum_tc;
                  if(isset($seniorHigh_cmditagum_graduated)) $total += $seniorHigh_cmditagum_graduated;
                  if(isset($seniorHigh_cmditagum_eoc)) $total += $seniorHigh_cmditagum_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>Regular</td>
                        @isset($seniorHigh_regular_active) <td>{{number_format( $seniorHigh_regular_active) }}</td>@endisset
          @isset($seniorHigh_regular_inactive) <td>{{number_format( $seniorHigh_regular_inactive) }}</td>@endisset
          @isset($seniorHigh_regular_tc) <td>{{number_format( $seniorHigh_regular_tc) }}</td>@endisset
          @isset($seniorHigh_regular_graduated) <td>{{number_format( $seniorHigh_regular_graduated) }}</td>@endisset
          @isset($seniorHigh_regular_eoc) <td>{{number_format( $seniorHigh_regular_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($seniorHigh_regular_active)) $total += $seniorHigh_regular_active;
                  if(isset($seniorHigh_regular_inactive)) $total += $seniorHigh_regular_inactive;
                  if(isset($seniorHigh_regular_tc)) $total += $seniorHigh_regular_tc;
                  if(isset($seniorHigh_regular_graduated)) $total += $seniorHigh_regular_graduated;
                  if(isset($seniorHigh_regular_eoc)) $total += $seniorHigh_regular_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>DSHP</td>
                        
          @isset($seniorHigh_dshp_active) <td>{{number_format( $seniorHigh_dshp_active) }}</td>@endisset
          @isset($seniorHigh_dshp_inactive) <td>{{number_format( $seniorHigh_dshp_inactive) }}</td>@endisset
          @isset($seniorHigh_dshp_tc) <td>{{number_format( $seniorHigh_dshp_tc) }}</td>@endisset
          @isset($seniorHigh_dshp_graduated) <td>{{number_format( $seniorHigh_dshp_graduated) }}</td>@endisset
          @isset($seniorHigh_dshp_eoc) <td>{{number_format( $seniorHigh_dshp_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($seniorHigh_dshp_active)) $total += $seniorHigh_dshp_active;
                  if(isset($seniorHigh_dshp_inactive)) $total += $seniorHigh_dshp_inactive;
                  if(isset($seniorHigh_dshp_tc)) $total += $seniorHigh_dshp_tc;
                  if(isset($seniorHigh_dshp_graduated)) $total += $seniorHigh_dshp_graduated;
                  if(isset($seniorHigh_dshp_eoc)) $total += $seniorHigh_dshp_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr class="section-header">
                        
                        <td colspan="7"><center><strong>BALIK ESKWELA SI NANAY (MEMBER)</strong></center></td>
                    </tr>
                    <tr>
                        <td>College</td>
                         @isset($BECollege_becollege_active) <td>{{number_format( $BECollege_becollege_active) }}</td>@endisset
          @isset($BECollege_becollege_inactive) <td>{{number_format( $BECollege_becollege_inactive) }}</td>@endisset
          @isset($BECollege_becollege_tc) <td>{{number_format( $BECollege_becollege_tc) }}</td>@endisset
          @isset($BECollege_becollege_graduated) <td>{{number_format( $BECollege_becollege_graduated) }}</td>@endisset
          @isset($BECollege_becollege_eoc) <td>{{number_format( $BECollege_becollege_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($BECollege_becollege_active)) $total += $BECollege_becollege_active;
                  if(isset($BECollege_becollege_inactive)) $total += $BECollege_becollege_inactive;
                  if(isset($BECollege_becollege_tc)) $total += $BECollege_becollege_tc;
                  if(isset($BECollege_becollege_graduated)) $total += $BECollege_becollege_graduated;
                  if(isset($BECollege_becollege_eoc)) $total += $BECollege_becollege_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>High School</td>
          @isset($BEHighschool_hs_active) <td>{{number_format( $BEHighschool_hs_active) }}</td>@endisset
          @isset($BEHighschool_hs_inactive) <td>{{number_format( $BEHighschool_hs_inactive) }}</td>@endisset
          @isset($BEHighschool_hs_tc) <td>{{number_format( $BEHighschool_hs_tc) }}</td>@endisset
          @isset($BEHighschool_hs_graduated) <td>{{number_format( $BEHighschool_hs_graduated) }}</td>@endisset
          @isset($BEHighschool_hs_eoc) <td>{{number_format( $BEHighschool_hs_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($BEHighschool_hs_active)) $total += $BEHighschool_hs_active;
                  if(isset($BEHighschool_hs_inactive)) $total += $BEHighschool_hs_inactive;
                  if(isset($BEHighschool_hs_tc)) $total += $BEHighschool_hs_tc;
                  if(isset($BEHighschool_hs_graduated)) $total += $BEHighschool_hs_graduated;
                  if(isset($BEHighschool_hs_eoc)) $total += $BEHighschool_hs_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr class="section-header">
                        <td colspan="7"><center><strong>DSHP- COLLEGE</strong></center></td>
                    </tr>
                    <tr>
                        <td>CMDI Bay</td>
                        @isset($DSHP_dshpclcmdibay_active) <td>{{number_format( $DSHP_dshpclcmdibay_active) }}</td>@endisset
          @isset($DSHP_dshpclcmdibay_inactive) <td>{{number_format( $DSHP_dshpclcmdibay_inactive) }}</td>@endisset
          @isset($DSHP_dshpclcmdibay_tc) <td>{{number_format( $DSHP_dshpclcmdibay_tc) }}</td>@endisset
          @isset($DSHP_dshpclcmdibay_graduated) <td>{{number_format( $DSHP_dshpclcmdibay_graduated) }}</td>@endisset
          @isset($DSHP_dshpclcmdibay_eoc) <td>{{number_format( $DSHP_dshpclcmdibay_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($DSHP_dshpclcmdibay_active)) $total += $DSHP_dshpclcmdibay_active;
                  if(isset($DSHP_dshpclcmdibay_inactive)) $total += $DSHP_dshpclcmdibay_inactive;
                  if(isset($DSHP_dshpclcmdibay_tc)) $total += $DSHP_dshpclcmdibay_tc;
                  if(isset($DSHP_dshpclcmdibay_graduated)) $total += $DSHP_dshpclcmdibay_graduated;
                  if(isset($DSHP_dshpclcmdibay_eoc)) $total += $DSHP_dshpclcmdibay_eoc;
                @endphp

<td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                    <td>LuzViMin</td>
          @isset($DSHP_dshpclluzvin_active) <td>{{number_format( $DSHP_dshpclluzvin_active) }}</td>@endisset
          @isset($DSHP_dshpclluzvin_inactive) <td>{{number_format( $DSHP_dshpclluzvin_inactive) }}</td>@endisset
          @isset($DSHP_dshpclluzvin_tc) <td>{{number_format( $DSHP_dshpclluzvin_tc) }}</td>@endisset
          @isset($DSHP_dshpclluzvin_graduated) <td>{{number_format( $DSHP_dshpclluzvin_graduated) }}</td>@endisset
          @isset($DSHP_dshpclluzvin_eoc) <td>{{number_format( $DSHP_dshpclluzvin_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($DSHP_dshpclluzvin_active)) $total += $DSHP_dshpclluzvin_active;
                  if(isset($DSHP_dshpclluzvin_inactive)) $total += $DSHP_dshpclluzvin_inactive;
                  if(isset($DSHP_dshpclluzvin_tc)) $total += $DSHP_dshpclluzvin_tc;
                  if(isset($DSHP_dshpclluzvin_graduated)) $total += $DSHP_dshpclluzvin_graduated;
                  if(isset($DSHP_dshpclluzvin_eoc)) $total += $DSHP_dshpclluzvin_eoc;
                @endphp

                <td>{{ number_format($total) }}</td>
                    </tr>
                    <tr>
                        <td>Anihan</td>
          @isset($DSHP_dshpclani_active) <td>{{number_format( $DSHP_dshpclani_active) }}</td>@endisset
          @isset($DSHP_dshpclani_inactive) <td>{{number_format( $DSHP_dshpclani_inactive) }}</td>@endisset
          @isset($DSHP_dshpclani_tc) <td>{{number_format( $DSHP_dshpclani_tc) }}</td>@endisset
          @isset($DSHP_dshpclani_graduated) <td>{{number_format( $DSHP_dshpclani_graduated) }}</td>@endisset
          @isset($DSHP_dshpclani_eoc) <td>{{number_format( $DSHP_dshpclani_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($DSHP_dshpclani_active)) $total += $DSHP_dshpclani_active;
                  if(isset($DSHP_dshpclani_inactive)) $total += $DSHP_dshpclani_inactive;
                  if(isset($DSHP_dshpclani_tc)) $total += $DSHP_dshpclani_tc;
                  if(isset($DSHP_dshpclani_graduated)) $total += $DSHP_dshpclani_graduated;
                  if(isset($DSHP_dshpclani_eoc)) $total += $DSHP_dshpclani_eoc;
                @endphp

                <td>{{ number_format($total) }}</td>                        
                        
                    </tr>
                    <tr>
                        <td>Dual Tech</td>
          @isset($DSHP_dshpcldt_active) <td>{{number_format( $DSHP_dshpcldt_active) }}</td>@endisset
          @isset($DSHP_dshpcldt_inactive) <td>{{number_format( $DSHP_dshpcldt_inactive) }}</td>@endisset
          @isset($DSHP_dshpcldt_tc) <td>{{number_format( $DSHP_dshpcldt_tc) }}</td>@endisset
          @isset($DSHP_dshpcldt_graduated) <td>{{number_format( $DSHP_dshpcldt_graduated) }}</td>@endisset
          @isset($DSHP_dshpcldt_eoc) <td>{{number_format( $DSHP_dshpcldt_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($DSHP_dshpcldt_active)) $total += $DSHP_dshpcldt_active;
                  if(isset($DSHP_dshpcldt_inactive)) $total += $DSHP_dshpcldt_inactive;
                  if(isset($DSHP_dshpcldt_tc)) $total += $DSHP_dshpcldt_tc;
                  if(isset($DSHP_dshpcldt_graduated)) $total += $DSHP_dshpcldt_graduated;
                  if(isset($DSHP_dshpcldt_eoc)) $total += $DSHP_dshpcldt_eoc;
                @endphp

                <td>{{ number_format($total) }}</td> 
                    </tr>
                    <tr class="section-header">
                        <td colspan="7"><center><strong>CSP 2 (Vocational Course)</strong></center></td>
                    </tr>
                    <tr>
                        <td>Vocational- 2 year course</td>
          @isset($CSP2_active) <td>{{number_format( $CSP2_active) }}</td>@endisset
          @isset($CSP2_inactive) <td>{{number_format( $CSP2_inactive) }}</td>@endisset
          @isset($CSP2_tc) <td>{{number_format( $CSP2_tc) }}</td>@endisset
          @isset($CSP2_graduated) <td>{{number_format( $CSP2_graduated) }}</td>@endisset
          @isset($CSP2_eoc) <td>{{number_format( $CSP2_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($CSP2_active)) $total += $CSP2_active;
                  if(isset($CSP2_inactive)) $total += $CSP2_inactive;
                  if(isset($CSP2_tc)) $total += $CSP2_tc;
                  if(isset($CSP2_graduated)) $total += $CSP2_graduated;
                  if(isset($CSP2_eoc)) $total += $CSP2_eoc;
                @endphp

                <td>{{ number_format($total) }}</td> 
                    </tr>
                    <tr class="section-header">
                        <td colspan="7"><center><strong>SPECIAL SCHOLARSHIP</strong></center></td>
                    </tr>
                    <tr>
                        <td>Forbes</td>
          @isset($special_forbes_active) <td>{{number_format( $special_forbes_active) }}</td>@endisset
          @isset($special_forbes_inactive) <td>{{number_format( $special_forbes_inactive) }}</td>@endisset
          @isset($special_forbes_tc) <td>{{number_format( $special_forbes_tc) }}</td>@endisset
          @isset($special_forbes_graduated) <td>{{number_format( $special_forbes_graduated) }}</td>@endisset
          @isset($special_forbes_eoc) <td>{{number_format( $special_forbes_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_forbes_active)) $total += $special_forbes_active;
                  if(isset($special_forbes_inactive)) $total += $special_forbes_inactive;
                  if(isset($special_forbes_tc)) $total += $special_forbes_tc;
                  if(isset($special_forbes_graduated)) $total += $special_forbes_graduated;
                  if(isset($special_forbes_eoc)) $total += $special_forbes_eoc;
                @endphp

                <td>{{ number_format($total) }}</td> 
                    </tr>
                    <tr>
                        <td>Brokenshire</td>
          @isset($special_brokenshire_active) <td>{{number_format( $special_brokenshire_active) }}</td>@endisset
          @isset($special_brokenshire_inactive) <td>{{number_format( $special_brokenshire_inactive) }}</td>@endisset
          @isset($special_brokenshire_tc) <td>{{number_format( $special_brokenshire_tc) }}</td>@endisset
          @isset($special_brokenshire_graduated) <td>{{number_format( $special_brokenshire_graduated) }}</td>@endisset
          @isset($special_brokenshire_eoc) <td>{{number_format( $special_brokenshire_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_brokenshire_active)) $total += $special_brokenshire_active;
                  if(isset($special_brokenshire_inactive)) $total += $special_brokenshire_inactive;
                  if(isset($special_brokenshire_tc)) $total += $special_brokenshire_tc;
                  if(isset($special_brokenshire_graduated)) $total += $special_brokenshire_graduated;
                  if(isset($special_brokenshire_eoc)) $total += $special_brokenshire_eoc;
                @endphp

                <td>{{ number_format($total) }}</td> 
                    </tr>
                    <tr>
                        <td>CAMIA</td>
          @isset($special_camia_active) <td>{{number_format( $special_camia_active) }}</td>@endisset
          @isset($special_camia_inactive) <td>{{number_format( $special_camia_inactive) }}</td>@endisset
          @isset($special_camia_tc) <td>{{number_format( $special_camia_tc) }}</td>@endisset
          @isset($special_camia_graduated) <td>{{number_format( $special_camia_graduated) }}</td>@endisset
          @isset($special_camia_eoc) <td>{{number_format( $special_camia_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_camia_active)) $total += $special_camia_active;
                  if(isset($special_camia_inactive)) $total += $special_camia_inactive;
                  if(isset($special_camia_tc)) $total += $special_camia_tc;
                  if(isset($special_camia_graduated)) $total += $special_camia_graduated;
                  if(isset($special_camia_eoc)) $total += $special_camia_eoc;
                @endphp

                <td>{{ number_format($total) }}</td> 
                    </tr>
                    <tr>
                        <td>Special Scholar</td>
          @isset($special_specialscholarcollege_active) <td>{{number_format( $special_specialscholarcollege_active) }}</td>@endisset
          @isset($special_specialscholarcollege_inactive) <td>{{number_format( $special_specialscholarcollege_inactive) }}</td>@endisset
          @isset($special_specialscholarcollege_tc) <td>{{number_format( $special_specialscholarcollege_tc) }}</td>@endisset
          @isset($special_specialscholarcollege_graduated) <td>{{number_format( $special_specialscholarcollege_graduated) }}</td>@endisset
          @isset($special_specialscholarcollege_eoc) <td>{{number_format( $special_specialscholarcollege_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_specialscholarcollege_active)) $total += $special_specialscholarcollege_active;
                  if(isset($special_specialscholarcollege_inactive)) $total += $special_specialscholarcollege_inactive;
                  if(isset($special_specialscholarcollege_tc)) $total += $special_specialscholarcollege_tc;
                  if(isset($special_specialscholarcollege_graduated)) $total += $special_specialscholarcollege_graduated;
                  if(isset($special_specialscholarcollege_eoc)) $total += $special_specialscholarcollege_eoc;
                @endphp

                <td>{{ number_format($total) }}</td> 
                    </tr>
                    <tr>
                        <td>CMDI Bay/ Tagum</td>
          @isset($special_specialscholarbaytagum_active) <td>{{number_format( $special_specialscholarbaytagum_active) }}</td>@endisset
          @isset($special_specialscholarbaytagum_inactive) <td>{{number_format( $special_specialscholarbaytagum_inactive) }}</td>@endisset
          @isset($special_specialscholarbaytagum_tc) <td>{{number_format( $special_specialscholarbaytagum_tc) }}</td>@endisset
          @isset($special_specialscholarbaytagum_graduated) <td>{{number_format( $special_specialscholarbaytagum_graduated) }}</td>@endisset
          @isset($special_specialscholarbaytagum_eoc) <td>{{number_format( $special_specialscholarbaytagum_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_specialscholarbaytagum_active)) $total += $special_specialscholarbaytagum_active;
                  if(isset($special_specialscholarbaytagum_inactive)) $total += $special_specialscholarbaytagum_inactive;
                  if(isset($special_specialscholarbaytagum_tc)) $total += $special_specialscholarbaytagum_tc;
                  if(isset($special_specialscholarbaytagum_graduated)) $total += $special_specialscholarbaytagum_graduated;
                  if(isset($special_specialscholarbaytagum_eoc)) $total += $special_specialscholarbaytagum_eoc;
                @endphp

                <td>{{ number_format($total) }}</td>                      
                    </tr>
                    <tr>
                        <td>MBA- Boat Partner / MBA Coor.</td>
          @isset($special_mba_active) <td>{{number_format( $special_mba_active) }}</td>@endisset
          @isset($special_mba_inactive) <td>{{number_format( $special_mba_inactive) }}</td>@endisset
          @isset($special_mba_tc) <td>{{number_format( $special_mba_tc) }}</td>@endisset
          @isset($special_mba_graduated) <td>{{number_format( $special_mba_graduated) }}</td>@endisset
          @isset($special_mba_eoc) <td>{{number_format( $special_mba_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_mba_active)) $total += $special_mba_active;
                  if(isset($special_mba_inactive)) $total += $special_mba_inactive;
                  if(isset($special_mba_tc)) $total += $special_mba_tc;
                  if(isset($special_mba_graduated)) $total += $special_mba_graduated;
                  if(isset($special_mba_eoc)) $total += $special_mba_eoc;
                @endphp

                <td>{{ number_format($total) }}</td>      
                    </tr>
                    <tr>
                        <td>CARD MRI Scholastic Excellence</td>
          @isset($special_specialscholarschola_active) <td>{{number_format( $special_specialscholarschola_active) }}</td>@endisset
          @isset($special_specialscholarschola_inactive) <td>{{number_format( $special_specialscholarschola_inactive) }}</td>@endisset
          @isset($special_specialscholarschola_tc) <td>{{number_format( $special_specialscholarschola_tc) }}</td>@endisset
          @isset($special_specialscholarschola_graduated) <td>{{number_format( $special_specialscholarschola_graduated) }}</td>@endisset
          @isset($special_specialscholarschola_eoc) <td>{{number_format( $special_specialscholarschola_eoc) }}</td>@endisset

                @php
                  $total = 0;
                  if(isset($special_specialscholarschola_active)) $total += $special_specialscholarschola_active;
                  if(isset($special_specialscholarschola_inactive)) $total += $special_specialscholarschola_inactive;
                  if(isset($special_specialscholarschola_tc)) $total += $special_specialscholarschola_tc;
                  if(isset($special_specialscholarschola_graduated)) $total += $special_specialscholarschola_graduated;
                  if(isset($special_specialscholarschola_eoc)) $total += $special_specialscholarschola_eoc;
                @endphp

                <td>{{ number_format($total) }}</td>      
                    </tr>
                    <tr>
    <td><strong>TOTAL</strong></td>
    <!-- ACTIVE -->
    @php
        $activetotal = 0;
        $activeVars = [
            'seniorHigh_cmdibay_active', 'seniorHigh_cmditagum_active', 'seniorHigh_regular_active', 
            'highSchool_active', 'college_active', 'special_forbes_active', 'special_brokenshire_active', 
            'special_camia_active', 'special_specialscholarcollege_active', 'special_mba_active', 
            'special_specialscholarschola_active', 'special_specialscholarbaytagum_active', 'BECollege_becollege_active', 
            'BEHighschool_hs_active', 'DSHP_dshpclcmdibay_active', 'DSHP_dshpclluzvin_active', 
            'DSHP_dshpclani_active', 'DSHP_dshpcldt_active', 'seniorHigh_dshp_active', 'CSP2_active'
        ];

        foreach ($activeVars as $var) {
            if (isset($$var)) $activetotal += $$var;
        }
    @endphp
    <td>{{ number_format($activetotal) }}</td>

    <!-- INACTIVE -->
    @php
        $inactivetotal = 0;
        $inactiveVars = [
            'seniorHigh_cmdibay_inactive', 'seniorHigh_cmditagum_inactive', 'seniorHigh_regular_inactive', 
            'highSchool_inactive', 'college_inactive', 'special_forbes_inactive', 'special_brokenshire_inactive', 
            'special_camia_inactive', 'special_specialscholarcollege_inactive', 'special_mba_inactive', 
            'special_specialscholarschola_inactive', 'special_specialscholarbaytagum_inactive', 'BECollege_becollege_inactive', 
            'BEHighschool_hs_inactive', 'DSHP_dshpclcmdibay_inactive', 'DSHP_dshpclluzvin_inactive', 
            'DSHP_dshpclani_inactive', 'DSHP_dshpcldt_inactive', 'seniorHigh_dshp_inactive', 'CSP2_inactive'
        ];

        foreach ($inactiveVars as $var) {
            if (isset($$var)) $inactivetotal += $$var;
        }
    @endphp
    <td>{{ number_format($inactivetotal) }}</td>

    <!-- TOTALLY CANCELLED -->
    @php
        $TCtotal = 0;
        $tcVars = [
            'seniorHigh_cmdibay_tc', 'seniorHigh_cmditagum_tc', 'seniorHigh_regular_tc', 'highSchool_tc', 
            'college_tc', 'special_forbes_tc', 'special_brokenshire_tc', 'special_camia_tc', 
            'special_specialscholarcollege_tc', 'special_mba_tc', 'special_specialscholarschola_tc', 
            'special_specialscholarbaytagum_tc', 'BECollege_becollege_tc', 'BEHighschool_hs_tc', 
            'DSHP_dshpclcmdibay_tc', 'DSHP_dshpclluzvin_tc', 'DSHP_dshpclani_tc', 'DSHP_dshpcldt_tc', 
            'seniorHigh_dshp_tc', 'CSP2_tc'
        ];

        foreach ($tcVars as $var) {
            if (isset($$var)) $TCtotal += $$var;
        }
    @endphp
    <td>{{ number_format($TCtotal) }}</td>

    <!-- GRADUATED -->
    @php
        $graduatedtotal = 0;
        $graduatedVars = [
            'seniorHigh_cmdibay_graduated', 'seniorHigh_cmditagum_graduated', 'seniorHigh_regular_graduated', 
            'highSchool_graduated', 'college_graduated', 'special_forbes_graduated', 'special_brokenshire_graduated', 
            'special_camia_graduated', 'special_specialscholarcollege_graduated', 'special_mba_graduated', 
            'special_specialscholarschola_graduated', 'special_specialscholarbaytagum_graduated', 'BECollege_becollege_graduated', 
            'BEHighschool_hs_graduated', 'DSHP_dshpclcmdibay_graduated', 'DSHP_dshpclluzvin_graduated', 
            'DSHP_dshpclani_graduated', 'DSHP_dshpcldt_graduated', 'seniorHigh_dshp_graduated', 'CSP2_graduated'
        ];

        foreach ($graduatedVars as $var) {
            if (isset($$var)) $graduatedtotal += $$var;
        }
    @endphp
    <td>{{ number_format($graduatedtotal) }}</td>

    <!-- END OF CONTRACT -->
    @php
        $EOCtotal = 0;
        $eocVars = [
            'seniorHigh_cmdibay_eoc', 'seniorHigh_cmditagum_eoc', 'seniorHigh_regular_eoc', 'highSchool_eoc', 
            'college_eoc', 'special_forbes_eoc', 'special_brokenshire_eoc', 'special_camia_eoc', 
            'special_specialscholarcollege_eoc', 'special_mba_eoc', 'special_specialscholarschola_eoc', 
            'special_specialscholarbaytagum_eoc', 'BECollege_becollege_eoc', 'BEHighschool_hs_eoc', 
            'DSHP_dshpclcmdibay_eoc', 'DSHP_dshpclluzvin_eoc', 'DSHP_dshpclani_eoc', 'DSHP_dshpcldt_eoc', 
            'seniorHigh_dshp_eoc', 'CSP2_eoc'
        ];

        foreach ($eocVars as $var) {
            if (isset($$var)) $EOCtotal += $$var;
        }
    @endphp
    <td>{{ number_format($EOCtotal) }}</td>

    <!-- TOTAL SUPPORT -->
    @php
        $totalsupport = $activetotal + $inactivetotal + $TCtotal + $graduatedtotal + $EOCtotal;
    @endphp
    <td>{{ number_format($totalsupport) }}</td>
</tr>

                    </tbody>
                                                            
                                                        </table>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
          


@include('includes/footer')
</div>
</div>
</body>
</html>


