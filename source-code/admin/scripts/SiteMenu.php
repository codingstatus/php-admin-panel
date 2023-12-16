<?php
class SiteMenu {

    private $conn;
    private $sitemenuTable = "sitemenu";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($sitemenuName) {
        $error = false;
        $errMsg = null;

        if (empty($sitemenuName)) {
            $errMsg = "Site menu name is required";
            $error = true;
        }

        $errorInfo = [
            "error" => $error,
            "errMsg" => $errMsg
        ];

        return $errorInfo;
    }

    public function create($sitemenuName) {
        $validate = $this->validate($sitemenuName);
        $success = false;

        if (!$validate['error']) {
            $query = "INSERT INTO " . $this->sitemenuTable . " (sitemenuName) VALUES (?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $sitemenuName);

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

        $query = "SELECT id, sitemenuName FROM " . $this->sitemenuTable;
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

        $query = "SELECT sitemenuName FROM " . $this->sitemenuTable . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        }

        return $data;
    }

    public function updateById($id, $sitemenuName) {
        $validate = $this->validate($sitemenuName);
        $success = false;

        if (!$validate['error']) {
            $query = "UPDATE " . $this->sitemenuTable . " SET sitemenuName = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $sitemenuName, $id);

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
        $query = "DELETE FROM " . $this->sitemenuTable . " WHERE id = ?";

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
