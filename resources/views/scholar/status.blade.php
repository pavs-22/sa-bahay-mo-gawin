@include('includes/header')
<style>
  body {
    background-color: #f4f4f9;
    font-family: Arial, sans-serif;
  }
  .container-fluid {
    padding: 20px;
  }
  .scholar-info-box {
    padding: 30px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(46, 204, 113, 1);
    width: 100%; /* Adjusted width for responsiveness */
    max-width: 100%; /* Adjusted max-width for responsiveness */
    border-left: 10px solid rgba(46, 204, 113, 1);
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

  /* Adjustments for smaller screens */
  @media only screen and (max-width: 768px) {
    .scholar-info-box {
      padding: 20px;
    }
    .scholar-info h1 {
      font-size: 24px;
    }
    .scholar-info h4 {
      font-size: 18px;
    }
    .scholar-info p {
      font-size: 14px;
    }
    /* Responsive table */
    .table-responsive {
      display: block;
      width: 100%;
      overflow-x: hidden; /* Hide overflow on smaller screens */
    }
    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 1rem;
      background-color: transparent;
    }
  }
</style>

</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    @include('includes/navbar')
    @include('includes/menubar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container">
            <div class="card">
                
                <div class="card-body">
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
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <!-- Scholar Information Box -->
                                        <div class="scholar-info-box">
                                            <div class="scholar-info">
                                                <h1>Scholar Information</h1>
                                                
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Scholarship Type</th>
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
                        <td>7,320</td>
                        <td>253</td>
                        <td>875</td>
                        <td>5,637</td>
                        <td>787</td>
                        <td>14,872</td>
                    </tr>
                    <tr>
                        <td>HIGH SCHOOL</td>
                        <td>2,025</td>
                        <td>25</td>
                        <td>228</td>
                        <td>1,999</td>
                        <td>758</td>
                        <td>5,035</td>
                    </tr>
                    <tr class="section-header">
                        <td colspan="7">SENIOR HIGH SCHOOL</td>
                    </tr>
                    <tr>
                        <td>CMDI Bay</td>
                        <td>7</td>
                        <td></td>
                        <td>6</td>
                        <td></td>
                        <td></td>
                        <td>13</td>
                    </tr>
                    <tr>
                        <td>CMDI Tagum</td>
                        <td>6</td>
                        <td></td>
                        <td>4</td>
                        <td></td>
                        <td>1</td>
                        <td>11</td>
                    </tr>
                    <tr>
                        <td>Regular</td>
                        <td>4</td>
                        <td>8</td>
                        <td>8</td>
                        <td>148</td>
                        <td></td>
                        <td>160</td>
                    </tr>
                    <tr class="section-header">
                        <td colspan="7">BALIK ESKWELA SI NANAY (MEMBER)</td>
                    </tr>
                    <tr>
                        <td>College</td>
                        <td>8</td>
                        <td>12</td>
                        <td>51</td>
                        <td>127</td>
                        <td>1</td>
                        <td>199</td>
                    </tr>
                    <tr>
                        <td>High School</td>
                        <td>1</td>
                        <td>4</td>
                        <td>18</td>
                        <td>12</td>
                        <td>2</td>
                        <td>37</td>
                    </tr>
                    <tr class="section-header">
                        <td colspan="7">DSHP- COLLEGE</td>
                    </tr>
                    <tr>
                        <td>CMDI Bay</td>
                        <td></td>
                        <td>9</td>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Viz Min</td>
                        <td>9</td>
                        <td>3</td>
                        <td>2</td>
                        <td>19</td>
                        <td></td>
                        <td>33</td>
                    </tr>
                    <tr>
                        <td>Anihan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>4</td>
                        <td></td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>Dual Tech</td>
                        <td></td>
                        <td></td>
                        <td>1</td>
                        <td></td>
                        <td>3</td>
                        <td>4</td>
                    </tr>
                    <tr class="section-header">
                        <td colspan="7">CSP 2 (Vocational Course)</td>
                    </tr>
                    <tr>
                        <td>Vocational- 2 year course</td>
                        <td>1</td>
                        <td>87</td>
                        <td>87</td>
                        <td>59</td>
                        <td>142</td>
                        <td>289</td>
                    </tr>
                    <tr class="section-header">
                        <td colspan="7">SPECIAL SCHOLARSHIP</td>
                    </tr>
                    <tr>
                        <td>Forbes</td>
                        <td></td>
                        <td></td>
                        <td>6</td>
                        <td>31</td>
                        <td></td>
                        <td>37</td>
                    </tr>
                    <tr>
                        <td>Brokenshire</td>
                        <td></td>
                        <td>4</td>
                        <td>4</td>
                        <td>13</td>
                        <td>2</td>
                        <td>19</td>
                    </tr>
                    <tr>
                        <td>CAMIA</td>
                        <td></td>
                        <td>4</td>
                        <td>4</td>
                        <td>35</td>
                        <td></td>
                        <td>46</td>
                    </tr>
                    <tr>
                        <td>Special Scholar</td>
                        <td>14</td>
                        <td>1</td>
                        <td>1</td>
                        <td>10</td>
                        <td></td>
                        <td>26</td>
                    </tr>
                    <tr>
                        <td>CMDI Bay/ Tagum</td>
                        <td>1,909</td>
                        <td>3</td>
                        <td>3</td>
                        <td>181</td>
                        <td></td>
                        <td>2,093</td>
                    </tr>
                    <tr>
                        <td>MBA- Boat Partner / MBA Coor.</td>
                        <td>19</td>
                        <td></td>
                        <td>7</td>
                        <td>26</td>
                        <td></td>
                        <td>52</td>
                    </tr>
                    <tr>
                        <td>CARD MRI Scholastic Excellence</td>
                        <td>114</td>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>116</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>11,419</td>
                        <td>308</td>
                        <td>1,316</td>
                        <td>8,315</td>
                        <td>1,700</td>
                        <td>23,058</td>
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
                </div>
            </div>
        </div>
    </div>


@include('includes/footer')
</div>
</div>
</body>
</html>
