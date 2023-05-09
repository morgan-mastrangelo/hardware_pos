<?php
class Method{
 
    public function __call($name,$arg1){
        $arg_count = count($arg1);
        switch($arg_count){

             case 0  : {

             }
             case 1  : {

             }
        }

        echo "arg2 is ". $name." ". $arg_count;
    }
}

$m = new Method();
$m->doThis("marshall","rag");
