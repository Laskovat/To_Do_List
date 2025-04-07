<?php
namespace Route\todolist;
class session {
public function __construct()
{
    session_start();
}
public function set($key,$value){
$_SESSION["$key"]=$value;
} 
public function get($key){
    return $_SESSION["$key"] ;
} 
    public function check($key){
        return isset($_SESSION["$key"]) ;
} 
public function unnset($key){
    unset($_SESSION["$key"]) ;
} 

}
