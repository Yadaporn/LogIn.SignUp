<?php 
    session_start();
    require_once ('config/db_user.php');

    if(isset($_POST['signup'])){
        $signin_username = $_POST['signin_username'];
        $signin_password = $_POST['signin_password'];
        $confirmpassword = $_POST['confirmpassword'];
        if(empty($signin_username)){
            $_SESSION['error'] = 'โปรดกรอกชื่อผู้ใช้!';
            header('location: signup_p.php');
        } else if(empty($signin_password)){
            $_SESSION['error'] = 'โปรดกรอกรหัสผ่าน!';
            header('location: signup_p.php');
        } else if(empty($confirmpassword)) {
            $_SESSION['error'] = 'โปรดกรอกรหัสผ่านยืนยัน!';
            header('location: signup_p.php');
        } else if($signin_password != $confirmpassword){
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header('location: signup_p.php');
        } else if (strlen($_POST['signin_username']) > 20 && strlen($_POST['signin_password']) < 8 ){
            $_SESSION['warning'] = 'ชื่อผู้ใช้และรหัสผ่านไม่ตรงตามเงื่อนไข! ชื่อผู้ใช้ควรน้อยกว่า 20 ตัวอักษร และรหัสผ่านควรมากกว่า 8 ตัวอักษร';
            header('location: signup_p.php');
        } else if (strlen($_POST['signin_username']) > 20){
            $_SESSION['warning'] = 'ชื่อผู้ใช้ยาวเกินไป! ควรน้อยกว่า 20 ตัวอักษร';
            header('location: signup_p.php');
        } else if (strlen($_POST['signin_password']) < 8){
            $_SESSION['warning'] = 'รหัสผ่านสั้นเกินไป! ควรมากกว่า 8 ตัวอักษร';
            header('location: signup_p.php');
        } else {
            try {
                $check_username = $conn->prepare("SELECT psn_user FROM personal WHERE psn_user = :signin_username ");
                $check_username->bindParam(":signin_username",$signin_username);
                $check_username->execute();
                $row = $check_username->fetch(PDO::FETCH_ASSOC);

                if($row['psn_user'] == $signin_username) {
                    $_SESSION['error'] = 'มีชื่อผู้ใช้นี้แล้ว!';
                    header('location: signup_p.php');
                } else if(!isset($_SESSION['error'])){
                    $hash = password_hash($signin_password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO personal(psn_user, psn_pass) VALUES(:signin_username, :signin_password)");
                    $stmt->bindParam(":signin_username",$signin_username);
                    $stmt->bindParam(":signin_password",$hash);
                    $stmt->execute();
                    $_SESSION['success'] = "ลงทะเบียนสำเร็จ โปรด<a href='login_p.php'>คลิ๊กที่นี่</a> เพื่อไปหน้า login ";
                    header("location: signup_p.php");
                } else{
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: signup_p.php");
                }
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>