<?php

session_start();
require 'config.php';

$msg = '';

if (isset($_POST['submit'])) {
    $time = time() - 30; //เวลาปัจจุบัน ลบออก 30 วินาที
    $ip_address = getIpAddress(); //เรียกใช้ ฟังก์ชั่น getIpAddress 
    $failed_login = 3; //ใช้นับจำนวนว่าจะให้ ล็อกอินผิดกี่ครั้ง

    $query = mysqli_query($conn, "SELECT count(*) as total_count FROM loginlogs
    WHERE TryTime > $time AND ipaddress = '$ip_address'"); //เงื่อนไขคือ ถ้าเวลา login เยอะกว่าเวลา ปัจจุบัน และ IpAddress ตรงกับ ข้อมูลในฐานข้อมูล

    $check_login_row = mysqli_fetch_assoc($query);
    $total_count = $check_login_row['total_count']; //ดึงจำนวน Row ของข้อมูลที่ตรงกับเงื่อนไขด้านบน

    if ($total_count == $failed_login) { //เงื่อนไขเมื่อ Login ผิดเกิน จำนวนที่กำหนด
        $msg = "To many failed login attempts. Please login after 30s";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' "); //User Login

        if (mysqli_num_rows($res)) {
            $_SESSION['IS_LOGIN'] = "yes";
            $_SESSION['username'] = $username;
            mysqli_query($conn, "DELETE FROM loginlogs WHERE ipaddress = '$ip_address'");  //เมื่อ login ถูกต้องให้ ลบ ข้อมูลที่ login ผิดพลาด
            echo "<script>window.location.href='dashboard.php';</script>"; //เมื่อ Login สำเร็จให้เด้งไปหน้านี้
        } else {
            $total_count++; 
            $rem_attm = $failed_login - $total_count; //เมื่อ login ผิดจะลด จำนวนครั้งที่ login ได้

            if ($rem_attm == 0) { // ถ้า จำนวนครั้งที่ Login เท่ากับ 0 
                $msg = "To many failed login attempts. Please login after 30s";
            } else { // หากยังไม่ครบจำนวนจะขึ้นข้อความข้างล่างนี้เตือนว่าเหลือกี่ครั้งก่อนจะโดน Lock 30s
                $msg = "Please enter valid login details. <br>$rem_attm attemps remaining";
            }
            $try_time = time(); //ข้อมูลเวลาปัจจุบัน
            mysqli_query($conn, "INSERT INTO loginlogs (ipaddress, TryTime) VALUE('$ip_address', '$try_time')"); //บันทึกข้อมูลลง Table loginlogs
        }
    }
}

// ฟังก์ชั่น ดึง IP ผู้ใช้
function getIpAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARD_FOR'])) {
        $ipAddr = $_SERVER['HTTP_X_FORWARD_FOR'];
    } else {
        $ipAddr = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>Limit Login</title>
</head>

<body>
    <div class="container">
        <h1 class="display-4 mt-4">Login Page</h1>
        <hr>
        <form action="" method="post">
            <div class="form-group">
                <label for="username" class="text-info">Username</label>
                <input type="text" name="username" id="username" class="form-control" require>
            </div>
            <div class="form-group">
                <label for="password" class="text-info">Password</label>
                <input type="password" name="password" id="password" class="form-control" require>
            </div>
            <div class="form-group mt-1">
                <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
            </div>
            <div id="result"><?php echo $msg; ?></div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>