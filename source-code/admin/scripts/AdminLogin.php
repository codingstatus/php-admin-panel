<?php
require_once('../database.php');

class AdminLogin {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($emailAddress, $pass) {

        $loginErr = null;
        $query = "SELECT * FROM admins WHERE emailAddress = ? AND pass = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $emailAddress, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // Successful login
            session_start();
            $_SESSION['email'] = $emailAddress;
            header("Location: dashboard.php");
        } else {
            $loginErr = "Please enter valid admin credential";
            
        }
        return $loginErr;

    }

    public function validateLogin($emailAddress, $pass) {

        $error = false;
        $emailErr = null;
        $passErr = null;
        $validEmail = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';

        if(empty($emailAddress)) {
            $emailErr = "Email Address is required";
            $error = true;
           
        } elseif(!preg_match($validEmail,$emailAddress)) {
            $emailErr = "Wrong email address";
            $error = true;
        }

        if(empty($pass)) {
            $passErr = "Password is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "emailErr" => $emailErr,
            "passErr" => $passErr
        ];
        
        return $errorInfo;
    }
}

if (isset($_POST['login']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $emailAddress = $_POST['emailAddress'];
    $pass = $_POST['pass'];
    
    $loginSystem = new AdminLogin($conn);
    $validateLogin = $loginSystem->validateLogin($emailAddress, $pass);
    
    if (!$validateLogin['error']){
    
       $login = $loginSystem->login($emailAddress, $pass);
    }
}
?>
