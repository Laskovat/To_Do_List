<?php
namespace Route\todolist ;
class validation {
    public array $errors=[];
    public function notempty($key,$msg){
            if(empty($key)){
                $this->errors[]="$msg";
            }
        }
        public function less($key,$msg){
            if(strlen($key)<=3){
                $this->errors[]="$msg";
            }
        }
    
    
    }
