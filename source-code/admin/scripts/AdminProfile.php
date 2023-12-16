<?php
class AdminProfile {

    private $conn;
    private $adminTable = 'admins';
    

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($firstName, $lastName, $gender, $emailAddress, $mobileNumber, $pass = 123  ) {

        $error = false;
        $errMsg = null;
        $firstNameErr = '';
        $lastNameErr = '';
        $genderErr = '';
        $emailAddressErr = '';
        $mobileNumberErr = '';
        $passErr = '';
       
        if(empty($firstName)) {
            $firstNameErr = "First Name is required";
            $error = true;
        } 
        if(empty($lastName)) {
            $lastNameErr = "Last Name is required";
            $error = true;
        } 
        if(empty($gender)) {
            $genderErr = "Gender is required";
            $error = true;
        } 
        if(empty(trim($emailAddress))) {
            $emailAddressErr = "Email Address is required";
            $error = true;
        } 
        if(empty(trim($mobileNumber))) {
            $mobileNumberErr = "Mobile Number is required";
            $error = true;
        } 

        if(empty($pass)) {
            $passErr = "Password is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "firstName" => $firstNameErr,
                "lastName" => $lastNameErr,
                "gender" => $genderErr,
                "emailAddress" => $emailAddressErr,
                "mobileNumber" => $mobileNumberErr,
                "pass" => $passErr

            ]
        ];
        
        return $errorInfo;
    }

    public function uploadProfileImage($id= null) {
  
            $error = false;
            $thumbnailErr ='';
            $profileImageErr = '';
            $uploadTo = "public/images/admin-profile/"; 
            $allowFileType = array('jpg','png','jpeg');
            $fileName = $_FILES['profileImage']['name'];

            if(empty($fileName) && null !== $id) {

                $get = $this->getById($id);
                if(isset($get['profileImage'])) {
                    $fileName = $get['profileImage'];
                }
           
            } else {
            
            $tempPath = $_FILES["profileImage"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
         
            if(!empty($fileName)){ 
               if(in_array($fileType, $allowFileType)){ 

                 if(!move_uploaded_file($tempPath, $originalPath)){ 
                    $thumbnailErr = 'Profile Not uploaded ! try again';
                    $error = true;
                }
             }else{  
                $thumbnailErr = 'Profile type is not allowed'; 
                $error = true;
             }
           } else {
                 $thumbnailErr = 'Profile is required'; 
                $error = true;
           }  
         }
        $thumbnailInfo = [
            "error" => $error, 
            "profileImageErr" => $thumbnailErr, 
            "profileImage" => $fileName
        ];

        return  $thumbnailInfo;
    }
    public function create($firstName, $lastName, $gender, $emailAddress, $mobileNumber, $pass) {
        $validate = $this->validate($firstName, $lastName, $gender, $emailAddress, $mobileNumber, $pass);
        $success = false;
    
        if (!$validate['error']) {
            $uploadProfileImage = $this->uploadProfileImage();

            if (!$uploadProfileImage['error']) {
                //  table name for admin profiles
                $query = "INSERT INTO " . $this->adminTable . " (firstName, lastName, gender, emailAddress, mobileNumber, pass, profileImage) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
    
                $stmt->bind_param("sssssss", $firstName, $lastName, $gender, $emailAddress, $mobileNumber, $pass, $uploadProfileImage['profileImage']);
    
                if ($stmt->execute()) {
                    $success = true;
                    $stmt->close();
                }
            }
        }
    
        $data = [
            'errMsg' => $validate['errMsg'],
            'uploadProfileImage' => $uploadProfileImage['profileImageErr'] ?? 'Unable to upload profile due to other fields facing errors',
            'success' => $success
        ];
    
        return $data;
    }
    

        public function get() {

        $data = [];
    
        $query = "SELECT id, firstName, lastName, gender, emailAddress, mobileNumber, profileImage FROM ";
        $query .= $this->adminTable;

        $result = $this->conn->query($query);
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
    
        return $data;
    }

    public function getById($id) {

        $data = [];
    
        $query = "SELECT id, firstName, lastName, gender, emailAddress, mobileNumber, profileImage FROM ";
        $query .= $this->adminTable;
        $query .= " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } 

        return $data;
    }

    public function updateById($id, $firstName, $lastName, $gender, $emailAddress, $mobileNumber) {
        $validate = $this->validate($firstName, $lastName, $gender, $emailAddress, $mobileNumber);
        $success = false;
        
        
        if (!$validate['error']) {
            $uploadProfileImage = $this->uploadProfileImage($id);
           
            if (!$uploadProfileImage['error']) {
            // Replace 'content' with the correct table name for admin profiles
                $query = "UPDATE " . $this->adminTable . " SET firstName = ?, lastName = ?, gender = ?, emailAddress = ?, mobileNumber = ?, profileImage = ? WHERE id = ?";
                $stmt = $this->conn->prepare($query);
            
                $stmt->bind_param("ssssssi", $firstName, $lastName, $gender, $emailAddress, $mobileNumber, $uploadProfileImage['profileImage'], $id);
            
                if ($stmt->execute()) {
                    $success = true;
                    
                } 
           }
        }
        
        $data = [
            'success' => $success,
            'errMsg' => $validate['errMsg'],
            'uploadProfileImage' => $uploadProfileImage['profileImageErr'] ?? 'Unable to upload profile due to other fields facing errors',
        ];

        
        return $data;
    }
    
    
    public function deleteById($id) {

        $query = "DELETE FROM ";
        $query .= $this->adminTable;
        $query .= " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
       
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
}



?>
