<?php

$i = 0;
do{
    echo ++$i;
}while($i < 10);

$i=1;
switch ($i){
    case 0:
        echo 'rien';
        break;
    case 1 :
        echo 'un';
        break;
    default:
        echo 'reste';
}