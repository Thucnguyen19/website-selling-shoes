<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');
?>
<?php 
class User  
{
    private $db;
    private $fm;
 function __construct(){
$this->db = new Database();
$this->fm = new Format();
 }


}
?>