<?php
/**
*Session Class
**/
class Session{
public static function init(){
if (version_compare(phpversion(), '5.4.0', '<')) {
if (session_id() == '') {
session_start(); // Gọi hàm này trước khi gửi bất kỳ tiêu đề nào
}
} else {
if (session_status() == PHP_SESSION_NONE) {
session_start(); // Gọi hàm này trước khi gửi bất kỳ tiêu đề nào
}
}
}

public static function set($key, $val){
$_SESSION[$key] = $val;
}

public static function get($key){
if (isset($_SESSION[$key])) {
return $_SESSION[$key];

} else {
return false;
}
}

public static function checkSession(){
self::init();
if (self::get("adminlogin")== false) {
self::destroy();
header("Location:login.php"); // Gọi hàm này trước khi gửi bất kỳ nội dung HTML nào
}
}

public static function checkLogin(){
self::init();
if (self::get("adminlogin")== true) {
header("Location:index.php"); // Gọi hàm này trước khi gửi bất kỳ nội dung HTML nào
}
}

public static function destroy(){
if (session_id() != '') { // Kiểm tra xem phiên đã được khởi tạo chưa
session_destroy(); // Chỉ gọi hàm này khi đã khởi tạo phiên
}
// header("Location:login.php"); // Gọi hàm này trước khi gửi bất kỳ nội dung HTML nào
}
}

?>
