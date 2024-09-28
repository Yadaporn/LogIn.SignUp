<?php 
    session_start();
    require_once 'config/db_user.php';

    if(isset($_POST['login'])){
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];
        if(empty($login_username) && empty($login_password)){
            $_SESSION['error'] = 'โปรดกรอกชื่อผู้ใช้และรหัสผ่าน!';
            header('location: login_p.php');
        }
        else if(empty($login_username)){
            $_SESSION['error'] = 'โปรดกรอกชื่อผู้ใช้!';
            header('location: login_p.php');
        } else if(empty($login_password)){
            $_SESSION['error'] = 'โปรดกรอกรหัสผ่าน!';
            header('location: login_p.php');
        } else if (strlen($_POST['login_username']) > 20 && strlen($_POST['login_password']) < 8 ){
            $_SESSION['warning'] = 'ชื่อผู้ใช้และรหัสผ่านไม่ตรงตามเงื่อนไข! ชื่อผู้ใช้ควรน้อยกว่า 20 ตัวอักษร และรหัสผ่านควรมากกว่า 8 ตัวอักษร';
            header('location: login_p.php');
        } else if (strlen($_POST['login_username']) > 20){
            $_SESSION['warning'] = 'ชื่อผู้ใช้ยาวเกินไป!!! ควรน้อยกว่า 20 ตัวอักษร';
            header('location: login_p.php');
        } else if (strlen($_POST['login_password']) < 8){
            $_SESSION['warning'] = 'รหัสผ่านสั้นเกินไป!!! ควรมากกว่า 8 ตัวอักษร';
            header('location: login_p.php');
        } else {
            try {
                $check_data = $conn->prepare("SELECT * FROM personal WHERE psn_user = :login_username ");
                $check_data->bindParam(":login_username",$login_username);
                $check_data->execute();

                if($check_data->rowCount()  > 0) {
                    $row = $check_data->fetch(PDO::FETCH_ASSOC);

                    if($login_username == $row['psn_user']){
                        $verify = password_verify($login_password, $row['psn_pass']);
                        
                        if ($verify) {
                            $_SESSION['nowlogin'] = $row['psn_id'];
                            header("location: dashboard.php");
                        } else {
                            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
                            header("location: login_p.php");
                            exit;
                        }
                    } else{
                        $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
                        header("location: login_p.php");
                        exit;
                    }
                } else{
                    $_SESSION['error'] = 'ไม่มีข้อมูลในฐานข้อมูล.';
                    header('location: login_p.php');
                    exit;
                }
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>