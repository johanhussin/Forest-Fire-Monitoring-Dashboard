<!DOCTYPE html>
<html lang="en">
<?php
   include("conec.php");
   $link=Conection();
   $result=mysqli_query($link,"select * from tempmoi order by id desc");
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Temperature & Humidity Monitoring</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Plugin CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="http://www.chartjs.org/assets/Chart.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.5.2/firebase.js"></script>
</head>

<body>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper py-3">

        <div class="container-fluid">

            <!-- Breadcrumbs 
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>-->
            <div class="row">
                      <div class="col-md-6"><!-- Area Chart Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-area-chart"></i> Area Chart Example
                    </div>
                    <div class="card-block">
                        <canvas id="updating-chart" width="600" height="300"></canvas>
                        <script id="jsbin-javascript">
//get value from database
var config = {
    apiKey: "AIzaSyCiOTIgOqw7gHxPUMNkUNyAU_9YugUZJb4",
    authDomain: "arduinosensor-d9f15.firebaseapp.com",
    databaseURL: "https://arduinosensor-d9f15.firebaseio.com",
    projectId: "arduinosensor-d9f15",
    storageBucket: "arduinosensor-d9f15.appspot.com",
    messagingSenderId: "568294008744"
  };
  firebase.initializeApp(config);
  console.log(firebase);
  var db = firebase.database();

  var banding;
  var timeval;

//charting
var canvas = document.getElementById('updating-chart'),
    ctx = canvas.getContext('2d'),
    startingData = {
      labels: [1, 2, 3, 4, 5, 6, 7],
      datasets: [
          {
              fillColor: "rgba(220,220,220,0.2)",
              strokeColor: "rgba(220,220,220,1)",
              pointColor: "rgba(220,220,220,1)",
              pointStrokeColor: "#fff",
              data: [30, 25, 32, 12, 34, 20, 43]
          },
          {
              fillColor: "rgba(151,187,205,0.2)",
              strokeColor: "rgba(151,187,205,1)",
              pointColor: "rgba(151,187,205,1)",
              pointStrokeColor: "#fff",
              data: [28, 12, 32, 15, 30, 45, 41]
          }
      ]
    },
    latestLabel = startingData[6];

// Reduce the animation steps for demo clarity.
var myLiveChart = new Chart(ctx).Line(startingData, {animationSteps: 30});


setInterval(function(){


    var path = firebase.database().ref().child("Temp");
path.on('value', function(datasnapshot){
  johan = (datasnapshot.val());
  });

var pathhum = firebase.database().ref().child("Hum");
pathhum.on('value', function(datasnapshot1){
  humval = (datasnapshot1.val());
  });


var pathtime = firebase.database().ref().child("Time");
pathtime.on('value', function(datasnapshot2){
   timeval = (datasnapshot2.val());
   
  });
    console.log(timeval);
    console.log(banding);
    
  if (banding != timeval){
    myLiveChart.addData([johan, humval], timeval);
    myLiveChart.removeData();
    banding = timeval;
}
  // Add two random numbers for each dataset
  //myLiveChart.addData([johan, humval], timeval);
  // Remove the first point so we dont just add values forever
  //myLiveChart.removeData();
}, 5000);

</script>
                    </div>
                    <div class="card-footer small text-muted">
                        Updated yesterday at 11:59 PM
                    </div>
                </div>
                </div>

                      <div class="col-md-6"><!-- Example Tables Card -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <i class="fa fa-table"></i> Data Table Example
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Time</th>
                                                    <th class="text-center">Temperature</th>
                                                    <th class="text-center">Humidity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php      
                                                    while($row = mysqli_fetch_array($result)) {
                                                    printf("<tr>
                                                            <td> &nbsp;%s</td><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td></tr>", $row["Time"], $row["temp1"], $row["moi1"]);
                                                       }
                                                       mysqli_free_result($result);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer small text-muted">
                                    Updated yesterday at 11:59 PM
                                </div>
                            </div></div>
            </div>
            	


                
            			


					  
		

			
        </div>
        <br>
        <br>
        <br>
        <br><!-- /.container-fluid -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <!-- /.content-wrapper -->

    <a class="scroll-to-top rounded" href="#">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript<script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.min.js"></script>

</body>

</html>
