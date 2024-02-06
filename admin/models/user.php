<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../sys/lib/PHPMailer/src/Exception.php';
require '../../sys/lib/PHPMailer/src/PHPMailer.php';
require '../../sys/lib/PHPMailer/src/SMTP.php';
class User {
    public function getUserNameByUserId($userId) {
        include '../../sys/config.php';

        $db = $conn->prepare("SELECT username FROM user WHERE id = :userId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':userId' => $userId));

        $result = $db->fetch();

        $conn = null;

        // Kiểm tra và trả về dữ liệu người dùng
        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }

    public function getUserByUsername($username) {
        include '../../sys/config.php';

        $db = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':username' => $username));

        $result = $db->fetch();

        $conn = null;

        // Kiểm tra và trả về dữ liệu người dùng
        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }

    public function getAllUser() {
        include '../../sys/config.php';

        $db = $conn->prepare("SELECT * FROM user");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute();

        $result = $db->fetchAll();

        $conn = null;
        
        // Kiểm tra và trả về dữ liệu người dùng
        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }

    public function getUserByUserId($userId) {
        include '../../sys/config.php';

        $db = $conn->prepare("SELECT * FROM user WHERE id = :userId");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute(array(':userId' => $userId));

        $result = $db->fetch();

        $conn = null;

        if ($result !== false) {
            return $result;
        } else {
            return null;
        }
    }

    public function inputUser($name, $email, $phone, $role) {
        include '../../sys/config.php';
        $password = 1111;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $ava = 'public/img/ava/default.png';
        $query = "INSERT INTO user (name, email, phone, username, password, ava, role) VALUES (:name, :email, :phone, :username, :password, :ava, :role)";
        $db = $conn->prepare($query);
        $db->bindParam(':name', $name);
        $db->bindParam(':email', $email);
        $db->bindParam(':phone', $phone);
        $db->bindParam(':username', $email);
        $db->bindParam(':password', $hashedPassword);
        $db->bindParam(':ava', $ava);
        $db->bindParam(':role', $role);
    
        $db->execute();
    
        if ($db) {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            $mail->SMTPDebug = 0;
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'anhloc280@gmail.com';                     //SMTP username
                $mail->Password   = 'gncrbdfqzuyjqmwz';                               //SMTP password
                $mail->SMTPSecure = 'tls'; // Sử dụng TLS
                $mail->Port = 587; 
                //Recipients
                $mail->setFrom('anhloc280@gmail.com', 'Admin of PClub');    //Add a recipient
                $mail->addAddress($email);               //Name is optional
                

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Welcome to PClub! Here is your information account!';
                $mail->Body    = "
                Hi $name, <br/>
                <br/>
                Welcome to Pclub! This is your information account!<br/>
                username: $email<br/>
                password: $password<br/>
                <br/>
                Thank you!<br/>
                Best wishes,<br/>
                Admin<br/>
                ";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        $conn = null;
        return true;
    }
    
    
    public function updateUser($name,$email,$phone,$username,$password,$role, $id) {
        include '../../sys/config.php';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $db = $conn->prepare("UPDATE user SET name= :name, email = :email, phone = :phone, username = :username, password = :password, role = :role WHERE id= :id");
        $db->bindParam(':id',$id);
        $db->bindParam(':name', $name);
        $db->bindParam(':email', $email);
        $db->bindParam(':phone', $phone);
        $db->bindParam(':username', $username);
        $db->bindParam(':password',$hashedPassword);
        $db->bindParam(':role', $role);

        $db->execute();

        $conn = null;
        return true;
    }

    public function deleteUser($userId) {
        include '../../sys/config.php';
        $db = $conn->prepare("DELETE FROM user WHERE id= :userId");
        $db->bindParam(':userId', $userId);
        $db->execute();

        $conn = null;
        return true;
    }

    public function updateUserInfo($name,$email,$phone,$username,$password, $id) {
        include '../../sys/config.php';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $db = $conn->prepare("UPDATE user SET name= :name, email = :email, phone = :phone, username = :username, password = :password WHERE id= :id");
        $db->bindParam(':id',$id);
        $db->bindParam(':name', $name);
        $db->bindParam(':email', $email);
        $db->bindParam(':phone', $phone);
        $db->bindParam(':username', $username);
        $db->bindParam(':password', $hashedPassword);

        $db->execute();

        $conn = null;
        return true;
    }
}
?>
