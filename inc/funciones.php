<?php

function print_pre($arr){
    echo '<pre>';
        print_r($arr);   
    echo '</pre>';   
}


function selected($a,$b){
    if($a == $b){
        return 'selected';
    }
}

?>