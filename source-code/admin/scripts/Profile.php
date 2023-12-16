<?php
class Profile {

    private $conn;
    private $adminTable = 'admins';

    public function __construct($conn) {
        $this->conn = $conn;
        
    }

  
    public function getProfile() {

        $data = [];
        $email = $_SESSION['email'];
        
        $query = "SELECT id, firstName, lastName, gender, emailAddress, mobileNumber, profileImage FROM ";
        $query .= $this->adminTable;
        $query .= " WHERE emailAddress = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $email);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } 
    
        return $data;
    }

    
}



?>
