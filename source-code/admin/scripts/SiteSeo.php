<?php
class SiteSeo {

    private $conn;
    private $siteseoTable = 'siteseo';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($metaKeyword, $metaDescription) {

        $error = false;
        $errMsg = null;
        $metaKeywordErr = '';
        $metaDescriptionErr = '';
 
        if(empty($metaKeyword)) {
            $metaKeywordErr = "meta keyword is required";
            $error = true;
        } 
        if(empty(trim($metaDescription))) {
            $metaDescriptionErr = "Meta Description is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "metaKeyword" => $metaKeywordErr,
                "metaDescription" => $metaDescriptionErr,

            ]
        ];
        
        return $errorInfo;
    }

    

    public function create($metaKeyword, $metaDescription) {

        $validate = $this->validate($metaKeyword, $metaDescription);
       
        $success = false;

        if (!$validate['error']){
              
                    $query = "INSERT INTO ";
                    $query .= $this->siteseoTable;
                    $query .= " (metaKeyword,metaDescription) ";
                    $query .= " VALUES (?, ?) ";

                    $stmt = $this->conn->prepare($query);
            
                    $stmt->bind_param("ss", $metaKeyword, $metaDescription);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
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
    
        $query = "SELECT id, metaKeyword, metaDescription FROM ";
        $query .= $this->siteseoTable;

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
    
        $query = "SELECT id, metaKeyword, metaDescription FROM ";
        $query .= $this->siteseoTable;
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

    public function updateById($id, $metaKeyword, $metaDescription) {

        $validate = $this->validate($metaKeyword, $metaDescription);
       
        $success = false;

        if (!$validate['error']){
                

                    $query = "UPDATE ";
                    $query .= $this->siteseoTable;
                    $query .= " SET metaKeyword = ?, metaDescription = ?";
                    $query .= " WHERE id = ?";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bind_param("ssi", $metaKeyword, $metaDescription, $id);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
                }
           
         
         $data = [
            'errMsg'            => $validate['errMsg'],
            'success'           => $success
         ];

         return $data;
    }

    public function deleteById($id) {

        $query = "DELETE FROM ";
        $query .= $this->siteseoTable;
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
