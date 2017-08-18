<!DOCTYPE html>
<html lang="en">
<?php
   include("conec.php");
   $link=Conection();
   $result=mysqli_query($link,"select * from tempmoi order by id desc");
   $result2=mysqli_query($link,"select * from fcmtoken order by id desc");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.4.min.js"></script>')</script>
    <script src="https://www.gstatic.com/firebasejs/3.5.2/firebase.js"></script>
</head>
<script>
var counter = 0;
//localStorage.setItem(counter, "0");
</script>
<body>
    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Forest Fire Monitoring</a>
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

                <div class="row">
                      <div class="col-md-8">
                        <!-- Breadcrumbs
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>-->
            <div class="card mb-3">
            <div class="card-block text-center">
            	<div class="row">
            	<div class="col-md-3">
            		<img src="temp.png" class="rounded float-center" height="40" width="40">
            		</br>
            	<h6 id="hahatemp" class="text-center"></h6>
            	</div>
            	<div class="col-md-3">
            		<img src="hum.png" class="rounded float-center" height="40" width="40">
            		</br>
            	<h6 id=hahahumi class="text-center"></h6>
            	</div>
            	<div class="col-md-3">
                      <img src="rain.png" class="rounded float-center" height="40" width="40">
                      </br>
                      <h6 id=haharain class="text-center"></h6>
                    </div>

                    <div class="col-md-3">
                      <h6>Chances of Fire:</h6>
                      <h6 id=chancesfire class="text-center"></h6>
                    </div>
            	</div>

            </div>
            </div>

<!-- Area Chart Example -->

<div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Area Chart Example
            </div>
            <div class="card-block text-center">
            <canvas id="myChart" width="100%" height="40"></canvas>
           <!--<div id="parent">-->
           <!--</div>-->

<script>
<!-- GET ALL THE INFO FROM THE FIREBASE CONSOLE WHEN YOU CREATE FIREBASE PROJECT -->
var config = {
    apiKey: "XXXXXXXXXXXXXXXXXXXXXXXX",
    authDomain: "XXXXXXXXXXXXXXXXXXXXXXXX",
    databaseURL: "XXXXXXXXXXXXXXXXXXXXXXXX",
    projectId: "XXXXXXXXXXXXXXXXXXXXXXXX",
    storageBucket: "XXXXXXXXXXXXXXXXXXXXXXXX",
    messagingSenderId: "XXXXXXXXXXXXXXXXXXXXXXXX"
	
  };
  firebase.initializeApp(config);
  console.log(firebase);
  var db = firebase.database();

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [1,2,3,4,5,],
        datasets: [
            {
            label: 'Temperature',
            data: [15,21,32,12,30,20],
           	backgroundColor: 'rgba(75, 192, 192, 0.3)',
            borderColor:'rgba(75, 192, 192, 1)',
            borderWidth: 1
            },
            {
            label: 'Humidity',
            data: [23,34,35,38,42,50],
            backgroundColor: 'rgba(153, 102, 255, 0.3)',
            borderColor:'rgba(153, 102, 255, 0.2)',
            borderWidth: 1
            },
            ]
    },
    options: {
        scales: {
            yAxes: [{
                type: "linear",
                animationSteps: 5,
            }]
        }
    }
});

var check = firebase.database().ref().child("Time");
check.on("value", function(snapshot) {
      
      var path = firebase.database().ref().child("Temp");
      path.on('value', function(datasnapshot){
       temp = (datasnapshot.val());
       document.getElementById("hahatemp").innerHTML = "Temperature: " + temp +"°C";
	
       if(temp > 40 && counter == "0"){
        document.getElementById("chancesfire").innerHTML = "Fire Might Occur";
        
        <?php
        while($row1 = mysqli_fetch_array($result2))
        {
        printf("$.get( 'fire.php', { temp1: temp, moi1: humval, id:'%s' });" ,$row1["token"]);
        }
        mysqli_free_result($result2);?>
		counter = 1;
		//localStorage.setItem("1",counter);
	}
     
	else if (temp > 40 && counter == "1"){
	document.getElementById("chancesfire").innerHTML = "Fire Might Occur";
	console.log(counter)
	}

	else if (temp <= 40 && counter == "1")
	{
        document.getElementById("chancesfire").innerHTML = "No Fire";
        	counter = 0;
		//localStorage.setItem("0",counter);
		console.log(counter)
    }

    else if (temp <= 40 && counter == "0")
	{
        document.getElementById("chancesfire").innerHTML = "No Fire";
    }
      });

      var pathhum = firebase.database().ref().child("Hum");
      pathhum.on('value', function(datasnapshot1){
       humval = (datasnapshot1.val());
       document.getElementById("hahahumi").innerHTML = "Humidity: " + humval+"%";
      });

      var pathrain = firebase.database().ref().child("Rain");
      pathrain.on('value', function(datasnapshot2){
       rainval = (datasnapshot2.val());
       document.getElementById("haharain").innerHTML = rainval;
      });

      var pathtime = firebase.database().ref().child("Time");
      pathtime.on('value', function(datasnapshot2){
       timeval = (datasnapshot2.val());
      });

     $('#dataTable').load('index.php #dataTable');
     myChart.data.datasets[0].data.shift();
     myChart.data.datasets[1].data.shift();
     myChart.data.labels.shift();
     myChart.data.datasets[0].data[4] = temp;
     myChart.data.datasets[1].data[4] = humval;
     myChart.data.labels[4] = timeval;
     myChart.update();
});
</script>
                      
            </div>
            <div class="card-footer small text-muted">
                Updated yesterday at 11:59 PM
            </div>
              </div>


<div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Location
            </div>
            <div class="card-block text-center">
	    	<style>
      		#map {
        	height: 400px;
        	width: 100%;
       		}
    </style>
    		<div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 6.461253, lng: 100.351763};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4opcLGTKyKQmI71iwrhojuEcmvn_cOAM&callback=initMap">
    </script>
	    </div>
</div>
                      </div>
                      <div class="col-md-4">
                        <!-- Example Tables Card -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <i class="fa fa-table"></i> Data Table Example
                                </div>
                                <div class="card-block">
                                    <div  class="table-responsive" >

                                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Time</th>
                                                    <th class="text-center">Temperature</th>
                                                    <th class="text-center">Humidity</th>
                                                </tr>
                                            </thead>
                                            <script type="text/javascript">
                                              //$(document).ready(function() {
                                                //setInterval(function () {
                                                  //$('#dataTable').load('index.php #dataTable')
                                                //}, 2000);
                                              //});
                                            </script>
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
                            </div>
                      </div>
                </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

    <a class="scroll-to-top rounded" href="#">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>  
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom scripts for this template <script src="js/sb-admin.min.js"></script>-->
    <script src="js/sb-admin.js"></script>
    <!-- Plugin JavaScript<script src="vendor/datatables/jquery.dataTables.min.js"></script>-->
    
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script> 
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>
