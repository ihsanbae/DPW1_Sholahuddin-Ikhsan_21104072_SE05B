<?php
function prima($number){
    if($number < 2){
        return false;
    }
    for($i=2; $i<=$number/2; $i++){
        if($number % $i == 0){
            return false;
        }
    }
    return true;
}

for($i=1; $i<=100; $i++){
    if(prima($i)){
        echo $i." adalah bilangan prima<br>";
    }
}
?>