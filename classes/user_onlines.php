<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class UserOnlines {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Chỉ khởi động session nếu nó chưa được khởi động
        }

        // $this->online();
        $this->TotalVisits();

    }
     public function online() {
        // Đếm số người đang online
        $countOnline = $this->countOnline();
        return $countOnline;
        // echo "Đang truy cập: " . $countOnline;
     }

    public function TotalVisits() {
        // Lấy tổng số lượt truy cập
        $totalVisits = $this->getTotalVisits();
        // echo "Số lượt truy cập: " . $totalVisits;
        return $totalVisits;

    }

    public function countOnline() {
        // Truy vấn cơ sở dữ liệu để đếm số lượng người đang online
        $query = "SELECT COUNT(*) as count FROM user_onlines WHERE time_out >= UNIX_TIMESTAMP(NOW() - INTERVAL 15 MINUTE)";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public function getTotalVisits() {
        // Truy vấn cơ sở dữ liệu để lấy tổng số lượt truy cập
        $query = "SELECT COUNT(*) as total FROM user_onlines";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // public function __destruct() {
    //     // Đóng kết nối cơ sở dữ liệu khi kết thúc
    //     $this->db->close();
    // }
}

// Tạo đối tượng UserOnlines và thực hiện các xử lý
$userOnlines = new UserOnlines();


?>