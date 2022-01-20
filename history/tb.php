
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost:81/demo/IOT/assets/fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/style.css">
  
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
        <li><a href="http://localhost:81/demo/chart1/view.php">BIỂU ĐỒ 1</a></li>
        <li><a href="">BIỂU ĐỒ 2</a></li>
        <li><a href="">BIỂU ĐỒ 3</a></li>
        
        </ul>
     </li>
    <li><a href="http://localhost:81/demo/history/tb.php">lịch sử</a></li>
</ul>
</div>  
      <!-- slider -->
      
  <?php
$servername='localhost';
$username='root'; 
$password='';
$dbname = "demo2"; // Cơ sở dữ liệu
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
die('Không thể kết nối Database:' .mysql_error());
}
    
?>
<div id="slider">
  <div class="content-section">
      <!-- bang 1 -->
    <div class="bang column col-half">
    <h2 class="text-green text-center">ĐỊA ĐIỂM 1</h2>
    <p class="text-green text-center"> (Bảng tính trung bình giá trị trong ngày)</p>
    <table>
    <tr>
      <th>Thời gian</th> 
      <th>Nhiệt độ</th>
      <th>Độ ẩm</th>
      <th>Áp suất</th>
    </tr>
    <?php
     $num1=0;
     $num2=500;
     $sql = mysqli_query($conn, "SELECT MAX(id) FROM logs WHERE 1") or die(mysqli_error());
     $fetch1 = mysqli_fetch_array($sql);
     $fetch2=substr($fetch1['MAX(id)'], 0, 10);
     $result = intval($fetch2)/500;
     
     $i=0;
     while ($i<$result){
        
         $query = mysqli_query($conn, "SELECT reading_time,AVG(value1), AVG(value2),AVG(value3)FROM logs WHERE id BETWEEN $num1 AND $num2") or die(mysqli_error());
        while($fetch = mysqli_fetch_array($query)){
    ?>
      <tr>
        <th><?php echo substr($fetch['reading_time'],0,10)?></th>
        <th><?php echo substr($fetch['AVG(value1)'], 0, 5)?></th>
         <th><?php echo substr($fetch['AVG(value2)'], 0, 5)?></th> 
        <th><?php echo substr($fetch['AVG(value3)'], 0, 5)?></th>
        </tr> 
    <?php
        }
        $num1 += 500;
        $num2 +=500;
        $i++;
    }
    ?>
   </table> 
</div>
<!-- bang2 -->

<!-- bang 3 -->
<div class="bang col-half">
    <!-- bo column de khong bi tran -->
    <h2 class="text-green text-center">ĐỊA ĐIỂM 2</h2>
    <p class="text-green text-center"> (Bảng tính trung bình giá trị trong ngày)</p>
    <table>
    <tr>
      <th>Thời gian</th> 
      <th>Nhiệt độ</th>
      <th>Độ ẩm</th>
      <th>Áp suất</th>
    </tr>
    <?php
     $num1=0;
     $num2=500;
     $sql = mysqli_query($conn, "SELECT MAX(id) FROM logs WHERE 1") or die(mysqli_error());
     $fetch1 = mysqli_fetch_array($sql);
     $fetch2=substr($fetch1['MAX(id)'], 0, 10);
     $result = intval($fetch2)/500;
     
     $i=0;
     while ($i<$result){
        
         $query = mysqli_query($conn, "SELECT reading_time,AVG(value1), AVG(value2),AVG(value3)FROM logs WHERE id BETWEEN $num1 AND $num2") or die(mysqli_error());
        while($fetch = mysqli_fetch_array($query)){
    ?>
      <tr>
        <th><?php echo substr($fetch['reading_time'],0,10)?></th>
        <th><?php echo substr($fetch['AVG(value1)'], 0, 5)?></th>
         <th><?php echo substr($fetch['AVG(value2)'], 0, 5)?></th> 
        <th><?php echo substr($fetch['AVG(value3)'], 0, 5)?></th>
        </tr> 
    <?php
        }
        $num1 += 500;
        $num2 +=500;
        $i++;
    }
    ?>
   </table> 
  </div>
 </div>
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