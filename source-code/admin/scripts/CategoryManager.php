<?php
class CategoryManager {

    private $conn;
    private $categoryTable = "categories";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($categoryName) {

        $error = false;
        $errMsg = null;

        if(empty($categoryName)) {
            $errMsg = "Category is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => $errMsg
        ];
        
        return $errorInfo;
    }

    public function create($categoryName) {

        $validate = $this->validate($categoryName);
        $success = false;

        if (!$validate['error']){

            $query = "INSERT INTO ";
            $query .= $this->categoryTable; 
            $query .= " (categoryName) ";
            $query .= " VALUES (?)";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $categoryName);
            
            if ($stmt->execute()) {
                $success = true;
                $stmt->close();
            }
        }
         
         $data = [
            'errMsg' => $validate['errMsg'],
            'success' => $success
         ];

         return $data;
    }

    public function get() {

        $data = [];
    
        $query = "SELECT id, categoryName FROM ";
        $query .= $this->categoryTable;
        
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
    
        $query = "SELECT categoryName FROM ";
        $query .= $this->categoryTable; 
        $query .= " WHERE id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data= $result->fetch_assoc();
            $stmt->close();
        } 

        return $data;
    }

    public function updateById($id, $categoryName) {

        $validate = $this->validate($categoryName);
        $success = false;

        if (!$validate['error']){

            $query = "UPDATE ";
            $query .= $this->categoryTable;
            $query .= " SET categoryName = ? WHERE id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $categoryName, $id);
            
            if ($stmt->execute()) {
                $success = true;
                $stmt->close();
            }
        }
         
         $data = [
            'errMsg' => $validate['errMsg'],
            'success' => $success
         ];

         return $data;
    }

    public function deleteById($id) {

        $query = "DELETE FROM ";
        $query .= $this->categoryTable; 
        $query .= " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
        }
        $stmt->close();
    }
    
}



?>
