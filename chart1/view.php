<?php

$servername = "localhost";

// REPLACE with your Database name
$dbname = "demo2";
// REPLACE with Database user
$username = "root";
// REPLACE with Database user password
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, value1, value2, value3, reading_time FROM logs order by reading_time desc limit 40";

$result = $conn->query($sql);
$sensor_data=[];
while ($data = $result->fetch_assoc()){
    $sensor_data[] = $data;
}

$readings_time = array_column($sensor_data, 'reading_time');

// ******* Uncomment to convert readings time array to your timezone ********
/*$i = 0;
foreach ($readings_time as $reading){
    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading - 1 hours"));
    // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
    //$readings_time[$i] = date("Y-m-d H:i:s", strtotime("$reading + 4 hours"));
    $i += 1;
}*/

$value1 = json_encode(array_reverse(array_column($sensor_data, 'value1')), JSON_NUMERIC_CHECK);
$value2 = json_encode(array_reverse(array_column($sensor_data, 'value2')), JSON_NUMERIC_CHECK);
$value3 = json_encode(array_reverse(array_column($sensor_data, 'value3')), JSON_NUMERIC_CHECK);
$reading_time = json_encode(array_reverse($readings_time), JSON_NUMERIC_CHECK);

/*echo $value1;
echo $value2;
echo $value3;
echo $reading_time;*/

$result->free();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/style.css">
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <style>
    body {
      /* min-width: 310px; */
    	/* max-width: 1280px; */
      width:100%;
    	height: 500px;
      margin: 0 auto;
    }
  </style>
  <script type = "text/JavaScript">

         <!--
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }
         
      </script>
  
  <!-- css cho trang -->
  
  </head>
  <!-- body -->
  <body >
  <!-- nav -->
  <div class="header">

       <ul id="nav">
           <li><a href="http://localhost:81/demo/IOT/index.html">TRANG CHỦ</a></li>
           <li><a href="#about">thông tin</a></li>
           <li>
               <a href="">biểu đồ
                   <i class="ti-angle-down"></i>
               </a>
               <ul class="subnav">
               <li><a href="">BIỂU ĐỒ 1</a></li>
               <li><a href="">BIỂU ĐỒ 2</a></li>
               <li><a href="">BIỂU ĐỒ 3</a></li>
               
               </ul>
            </li>
           <li><a href="http://localhost:81/demo/history/tb.php">lịch sử</a></li>
       </ul>
   </div>
 <!-- search -->
 
 <!-- thanh tim kiem -->
<div id="search" class="text-center">
  <h2 class="text-green">ĐỊA ĐIỂM 1</h2>
    <form action="" method="post">
        <input type="text" name="search" placeholder="yy/mm/dd h/min/sec" class="form-control">
        <input type="submit" name="submit" value="Search" class="form-submit form-control">
    </form>
</div>
<?php
$servername='localhost';
$username='root'; 
$password='';
$dbname = "demo2"; // Cơ sở dữ liệu
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
die('Không thể kết nối Database:' .mysql_error());
}
    if(ISSET($_POST['submit'])){
        $keyword = $_POST['search'];
?>
<!-- kết quả -->
<div class="result ">
    <h2 class="text-green text-center">KẾT QUẢ</h2>
    <table>
    <tr>
      <th>Thời gian</th> 
      <th>Nhiệt độ</th>
      <th>Độ ẩm</th>
      <th>Áp suất</th>
    </tr>
    <?php
        $query = mysqli_query($conn, "SELECT * FROM logs WHERE reading_time LIKE '%$keyword%' ORDER BY reading_time") or die(mysqli_error());
        while($fetch = mysqli_fetch_array($query)){
    ?>
      <tr>
        <th><?php echo $fetch['reading_time']?></th>
        <th><?php echo substr($fetch['value1'], 0, 10)?></th>
         <th><?php echo substr($fetch['value2'], 0, 10)?></th>
        <th><?php echo substr($fetch['value3'], 0, 10)?></th>
        </tr> 
    <?php
        }
    ?>
   </table> 
</div>
<?php
    }
?>

  <!-- slider -->
<div id="slider" onload = "JavaScript:AutoRefresh(5000);">
    <div id="chart-temperature" class="container"></div>
    <div id="chart-humidity" class="container"></div>
    <div id="chart-pressure" class="container"></div>
<script>
var value1 = <?php echo $value1; ?>;
var value2 = <?php echo $value2; ?>;
var value3 = <?php echo $value3; ?>;
var reading_time = <?php echo $reading_time; ?>;

var chartT = new Highcharts.Chart({
  chart:{ renderTo : 'chart-temperature' },
  title: { text: 'Temperature' },
  series: [{
    showInLegend: false,
    data: value1
  }],
  plotOptions: {
    line: { animation: false,
      dataLabels: { enabled: true }
    },
    series: { color: '#059e8a' }
  },
  xAxis: { 
    type: 'datetime',
    categories: reading_time
  },
  yAxis: {
    title: { text: 'Temperature (Celsius)' }
    //title: { text: 'Temperature (Fahrenheit)' }
  },
  credits: { enabled: false }
});

var chartH = new Highcharts.Chart({
  chart:{ renderTo:'chart-humidity' },
  title: { text: ' Humidity' },
  series: [{
    showInLegend: false,
    data: value2
  }],
  plotOptions: {
    line: { animation: false,
      dataLabels: { enabled: true }
    }
  },
  xAxis: {
    type: 'datetime',
    //dateTimeLabelFormats: { second: '%H:%M:%S' },
    categories: reading_time
  },
  yAxis: {
    title: { text: 'Humidity (%)' }
  },
  credits: { enabled: false }
});


var chartP = new Highcharts.Chart({
  chart:{ renderTo:'chart-pressure' },
  title: { text: ' Pressure' },
  series: [{
    showInLegend: false,
    data: value3
  }],
  plotOptions: {
    line: { animation: false,
      dataLabels: { enabled: true }
    },
    series: { color: '#18009c' }
  },
  xAxis: {
    type: 'datetime',
    categories: reading_time
  },
  yAxis: {
    title: { text: 'Pressure (hPa)' }
  },
  credits: { enabled: false }
});

</script>
</div>   
<!-- footer -->
<div id="footer">
      <h2 class="section-heading">LIÊN HỆ</h2>
      <div class="row contact-content">
          <div class="column col-half info">
              <p class="mt-8"><i class="ti-info-alt "></i> Author:Trần Di Ghuyn</p>
              <p class="mt-8"><i class="ti-mobile "></i> Phone:0905140365</p>
            <p class="mt-8"><i class="ti-email "></i> Email:trangh1234@mail.com</p>
          </div>
          <div class="column col-half info1 text-white">
            <a href=""><i class="ti-linkedin"></i></a>
            <a href=""><i class="ti-facebook"></i></a>
            </div>
      </div>
  </div>
</body>
</html>