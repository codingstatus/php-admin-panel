<?php
class ContentManager {

    private $conn;
    private $contentTable = 'content';
    private $categoryTable = 'categories';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($categoryId, $title, $description) {

        $error = false;
        $errMsg = null;
        $categoryIdErr = '';
        $titleErr = '';
        $descriptionErr = '';
       
        if(empty($categoryId)) {
            $categoryIdErr = "Category is required";
            $error = true;
        } 
        if(empty($title)) {
            $titleErr = "title is required";
            $error = true;
        } 
        if(empty(trim($description))) {
            $descriptionErr = "Description is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "title" => $titleErr,
                "description" => $descriptionErr,
                "categoryId" => $categoryIdErr

            ]
        ];
        
        return $errorInfo;
    }

    public function uploadThumbnail($id= null) {
  
            $error = false;
            $thumbnailErr = '';
            $uploadTo = "public/images/thumbnail/"; 
            $allowFileType = array('jpg','png','jpeg');
            $fileName = $_FILES['thumbnail']['name'];

            if(empty($fileName) && null !== $id) {

                $get = $this->getById($id);
                if(isset($get['thumbnail'])) {
                    $fileName = $get['thumbnail'];
                }
           
            } else {
            
            $tempPath = $_FILES["thumbnail"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
         
            if(!empty($fileName)){ 
               if(in_array($fileType, $allowFileType)){ 

                 if(!move_uploaded_file($tempPath, $originalPath)){ 
                    $thumbnailErr = 'Thumbnail Not uploaded ! try again';
                    $error = true;
                }
             }else{  
                $thumbnailErr = 'Thumbnail type is not allowed'; 
                $error = true;
             }
           } else {
                 $thumbnailErr = 'Thumbnail is required'; 
                $error = true;
           }  
         }
        $thumbnailInfo = [
            "error" => $error, 
            "thumbnailErr" => $thumbnailErr, 
            "thumbnailName" => $fileName
        ];

        return  $thumbnailInfo;
    }

    public function create($categoryId, $title, $description) {

        $validate = $this->validate($categoryId, $title, $description);
       
        $success = false;

        if (!$validate['error']){
                $uploadThumbnail = $this->uploadThumbnail();
                if(!$uploadThumbnail['error']) {
                    $query = "INSERT INTO ";
                    $query .= $this->contentTable;
                    $query .= " (categoryId, title, description, thumbnail) ";
                    $query .= " VALUES (?, ?, ?,?) ";

                    $stmt = $this->conn->prepare($query);
            
                    $stmt->bind_param("ssss", $categoryId, $title, $description, $uploadThumbnail['thumbnailName']);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
            }
           
        }
         
         $data = [
            'errMsg'            => $validate['errMsg'],
            'uploadThumbnail'   => $uploadThumbnail['thumbnailErr'] ?? 'Unable to upload thumnail due to other fields facing errors',
            'success'           => $success
         ];

         return $data;
    }

    public function get() {

        $data = [];
    
        $query = "SELECT id, categoryId, title, description, thumbnail FROM ";
        $query .= $this->contentTable;

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
    
        $query = "SELECT id, categoryId, title, description, thumbnail FROM ";
        $query .= $this->contentTable;
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

    public function getFromMultipleTables($id) {
        $data = [];

        $query = "SELECT t1.title, t1.description, t1.thumbnail, t2.categoryName FROM ";
        $query .= $this->contentTable;
        $query .= " AS t1 ";
        $query .= "INNER JOIN ";
        $query .= $this->categoryTable;
        $query .= " AS t2";
        $query .= " ON t1.categoryId = t2.id";
        $query .= " WHERE t1.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
           

        }
        return $data;
    }
    public function updateById($id, $categoryId, $title, $description) {

        $validate = $this->validate($categoryId, $title, $description);
       
        $success = false;

        if (!$validate['error']){
                $uploadThumbnail = $this->uploadThumbnail($id);

                if(!$uploadThumbnail['error']) {

                    $query = "UPDATE ";
                    $query .= $this->contentTable;
                    $query .= " SET categoryId = ?, title = ?, description = ?, thumbnail = ? ";
                    $query .= " WHERE id = ?";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bind_param("isssi", $categoryId, $title, $description, $uploadThumbnail['thumbnailName'], $id);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
                }
           
        }
         
         $data = [
            'errMsg'            => $validate['errMsg'],
            'uploadThumbnail'   => $uploadThumbnail['thumbnailErr'] ?? 'Unable to upload thumnail due to other fields facing errors',
            'success'           => $success
         ];

         return $data;
    }

    public function deleteById($id) {

        $query = "DELETE FROM ";
        $query .= $this->contentTable;
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
