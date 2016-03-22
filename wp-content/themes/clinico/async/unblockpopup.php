<?php
/**
 * Created by PhpStorm.
 * User: entony
 * Date: 21/12/15
 * Time: 09:04
 */
if(!isset($_COOKIE["__ACCESSMICOMEDICAL__"])) {
    setcookie("__ACCESSMICOMEDICAL__",true,time()+3600);
}
echo json_encode(array('errorCode' => 'OK', 'message' => 'ACCEPTED'));
?>