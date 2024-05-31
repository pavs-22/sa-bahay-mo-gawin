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


