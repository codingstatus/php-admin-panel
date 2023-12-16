<?php
class siteIdentity {

    private $conn;
    private $siteidentityTable = 'siteidentity';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($name) {

        $error = false;
        $errMsg = null;
        $nameErr = '';
       
        if(empty($name)) {
            $nameErr = "name is required";
            $error = true;
        }  

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "name" => $nameErr
            ]
        ];
        
        return $errorInfo;
    }

    public function uploadFavicon($id= null) {
  
            $error = false;
            $faviconErr = '';
            $uploadTo = "public/images/favicon/"; 
            $allowFileType = array('jpg','png','jpeg');
            $fileName = $_FILES['favicon']['name'];

            if(empty($fileName) && null !== $id) {

                $get = $this->getById($id);
                if(isset($get['favicon'])) {
                    $fileName = $get['favicon'];
                }
           
            } else {
            
            $tempPath = $_FILES["favicon"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
         
            if(!empty($fileName)){ 
               if(in_array($fileType, $allowFileType)){ 

                 if(!move_uploaded_file($tempPath, $originalPath)){ 
                    $faviconErr = 'Favicon Not uploaded ! try again';
                    $error = true;
                }
             }else{  
                $faviconErr = 'Favicon type is not allowed'; 
                $error = true;
             }
           } else {
                 $faviconErr = 'Favicon is required'; 
                $error = true;
           }  
         }
        $faviconInfo = [
            "error" => $error, 
            "faviconErr" => $faviconErr, 
            "faviconName" => $fileName
        ];

        return  $faviconInfo;
    }
    // logo

    public function uploadLogo($id= null) {
  
        $error = false;
        $logoErr = '';
        $uploadTo = "public/images/logo/"; 
        $allowFileType = array('jpg','png','jpeg');
        $fileName = $_FILES['logo']['name'];

        if(empty($fileName) && null !== $id) {

            $get = $this->getById($id);
            if(isset($get['logo'])) {
                $fileName = $get['logo'];
            }
       
        } else {
        
        $tempPath = $_FILES["logo"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
     
        if(!empty($fileName)){ 
           if(in_array($fileType, $allowFileType)){ 

             if(!move_uploaded_file($tempPath, $originalPath)){ 
                $logoErr = 'Logo Not uploaded ! try again';
                $error = true;
            }
         }else{  
            $logoErr = 'Logo type is not allowed'; 
            $error = true;
         }
       } else {
             $logoErr = 'Logo is required'; 
            $error = true;
       }  
     }
    $logoInfo = [
        "error" => $error, 
        "logoErr" => $logoErr, 
        "logoName" => $fileName
    ];

    return  $logoInfo;
}
    //

    public function create($name) {

        $validate = $this->validate($name);
       
        $success = false;
       
        if (!$validate['error']){
            
                $uploadFavicon = $this->uploadFavicon();
                // print_r($uploadFavicon);die();
                $uploadLogo = $this->uploadLogo();
                if(!$uploadFavicon['error'] && !$uploadLogo['error']) {
                    $query = "INSERT INTO ";
                    $query .= $this->siteidentityTable;
                    $query .= " (name, favicon, logo) ";
                    $query .= " VALUES (?, ?, ?) ";

                    $stmt = $this->conn->prepare($query);
            
                    $stmt->bind_param("sss", $name, $uploadFavicon['faviconName'], $uploadLogo['logoName']);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
            }
           
        }
         
         $data = [
            'errMsg'            => $validate['errMsg'],
            'uploadFavicon'   => $uploadFavicon['faviconErr'] ?? 'Unable to upload favicon due to other fields facing errors',
            'uploadLogo'   => $uploadLogo['logoErr'] ?? 'Unable to upload logo due to other fields facing errors',
            'success'           => $success
         ];

         return $data;
    }

    public function get() {
        $data = [];
    
        $query = "SELECT id, name, favicon, logo FROM ";
        $query .= $this->siteidentityTable; 
    
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
    
        $query = "SELECT id, name, favicon, logo FROM ";
        $query .= $this->siteidentityTable;
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

    // public function getFromMultipleTables($id) {
    //     $data = [];

    //     $query = "SELECT t1.title, t1.description, t1.thumbnail, t2.categoryName FROM ";
    //     $query .= $this->siteidentityTable;
    //     $query .= " AS t1 ";
    //     $query .= "INNER JOIN ";
    //     $query .= $this->categoryTable;
    //     $query .= " AS t2";
    //     $query .= " ON t1.categoryId = t2.id";
    //     $query .= " WHERE t1.id = ?";
        
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("i", $id);

    //     if ($stmt->execute()) {
    //         $result = $stmt->get_result();
    //         $data = $result->fetch_assoc();
           

    //     }
    //     return $data;
    // }
    public function updateById($id, $name) {

        $validate = $this->validate($id, $name);
       
        $success = false;

        if (!$validate['error']){
                $uploadFavicon = $this->uploadFavicon($id);
                
                $uploadLogo = $this->uploadLogo($id);

                if(!$uploadFavicon['error'] && !$uploadLogo['error']) {

                    $query = "UPDATE ";
                    $query .= $this->siteidentityTable;
                    $query .= " SET name = ?, favicon = ?, logo = ? ";
                    $query .= " WHERE id = ?";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bind_param("sssi", $name, $uploadFavicon['faviconName'], $uploadLogo['logoName'], $id);

                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
                }
           
        }
         
         $data = [
            'errMsg'            => $validate['errMsg'],
            'uploadFavicon'   => $uploadFavicon['faviconErr'] ?? 'Unable to upload favicon due to other fields facing errors',
            'uploadLogo'   => $uploadLogo['logoErr'] ?? 'Unable to upload logo due to other fields facing errors',
            'success'           => $success
         ];

         return $data;
    }

    public function deleteById($id) {

        $query = "DELETE FROM ";
        $query .= $this->siteidentityTable;
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
