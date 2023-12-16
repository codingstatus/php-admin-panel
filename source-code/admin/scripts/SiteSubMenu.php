<?php
class SiteSubMenu {

    private $conn;
    private $sitesubmenuTable = "sitesubmenu";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($sitesubmenuName, $sitemenuId) {

        $error = false;
        $errMsg = null;
        $sitemenuIdErr = '';
    
        if (empty($sitemenuId)) {
            $sitemenuIdErr = "Site menu is required";
            $error = true;
        }
    
        if (empty($sitesubmenuName)) {
            $errMsg = "Site menu name is required";
            $error = true;
        }
    
        $errorInfo = [
            "error" => $error,
            "errMsg" => $errMsg,
            "sitemenuId" => $sitemenuIdErr
        ];
    
        return $errorInfo;
    }
    

    public function create($sitesubmenuName,$sitemenuId) {

        // echo "sub". $sitesubmenuName;
        // echo  "menu". $sitemenuId;
        $validate = $this->validate($sitesubmenuName, $sitemenuId);
       
        $success = false;
       
        if (!$validate['error']) {
            
            $query = "INSERT INTO " . $this->sitesubmenuTable . " (sitesubmenuName,sitemenuId) VALUES (?,?)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $sitesubmenuName,$sitemenuId);

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

        $query = "SELECT id, sitesubmenuName,sitemenuId FROM " . $this->sitesubmenuTable;
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

        $query = "SELECT sitesubmenuName,sitemenuId FROM " . $this->sitesubmenuTable . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        }

        return $data;
    }

    public function updateById($id, $sitesubmenuName,$sitemenuId) {
        $validate = $this->validate($sitesubmenuName,$sitemenuId);
        $success = false;

        if (!$validate['error']) {
            $query = "UPDATE " . $this->sitesubmenuTable . " SET sitesubmenuName = ?,sitemenuId = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sii", $sitesubmenuName, $sitemenuId, $id);

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
        $query = "DELETE FROM " . $this->sitesubmenuTable . " WHERE id = ?";

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
