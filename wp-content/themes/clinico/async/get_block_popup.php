<?php
/**
 * Created by PhpStorm.
 * User: entony
 * Date: 21/12/15
 * Time: 09:02
 */
if(!isset($_COOKIE["__ACCESSMICOMEDICAL__"])) {
    echo json_encode(array('errorCode' => 'OK', 'blocked' => true));
}
else {
    echo json_encode(array('errorCode' => 'OK', 'blocked' => false));
}
?>