<?php 

class AdminDanhMuc {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDanhMuc(){
        try {
            $sql = 'SELECT * FROM danh_mucs';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertDanhMuc($ten_danh_muc, $mo_ta){
        try {
            $sql = "INSERT INTO danh_mucs (ten_danh_muc, mo_ta)
                    VALUES (:ten_danh_muc, :mo_ta)";
    
            $stmt = $this->conn->prepare($sql);
    
            if ($stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta
            ])) {
                return true; // Thêm thành công
            } else {
                return false; // Có lỗi xảy ra
            }
        } catch (Exception $e) {
            // Log lỗi chi tiết vào file log
            error_log("Error inserting danh_muc: " . $e->getMessage());
            // Trả về thông báo lỗi chung
            return false;
        }
    }
    

    public function getDetailDanhMuc($id){
        try {
            $sql = 'SELECT * FROM danh_mucs WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateDanhMuc($id, $ten_danh_muc, $mo_ta){
        try {
            $sql = 'UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function destroyDanhMuc($id){
        try {
            $sql = 'DELETE FROM danh_mucs WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}