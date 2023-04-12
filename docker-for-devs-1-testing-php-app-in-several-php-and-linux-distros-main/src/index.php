<?php

// Exibe as informações do sistema
    exec("cat /etc/os-release", $output);
    foreach ($output as $line) {
        echo $line."<br>";
    }
//

echo php_uname();

phpinfo();
?>
