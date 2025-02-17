<?php
for($i = 1; $i<=5; $i++){
    if ($i==3) {
        goto abc;
    }
    echo $i;
}
abc :
echo "This is a car";
?>