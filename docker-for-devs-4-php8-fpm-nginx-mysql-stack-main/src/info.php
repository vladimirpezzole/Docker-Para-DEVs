<?php
echo "<h2><a href='Handclass---Descubra-os-Novos-Superpoderes-do-PHP-8/index.php'>Handclass---Descubra-os-Novos-Superpoderes-do-PHP-8</a></h2>";
echo "Server Name: &#09&#09"."<b>"      .$_SERVER['SERVER_NAME']        ."</b>"."</br></br>";
echo "Server Adress: &#09&#09"."<b>"      .$_SERVER['SCRIPT_FILENAME']        ."</b>"."</br></br>";
echo "Server ADDR: &#09&#09"."<b>"      .$_SERVER['SERVER_ADDR']        ."</b>"."</br>";
echo "Server Gateway: &#09"."<b>"   .$_SERVER['GATEWAY_INTERFACE']  ."</b>"."</br>";
echo "Server Software: &#09"."<b>"  .$_SERVER['SERVER_SOFTWARE']    ."</b>"."</br>";
echo "Server Protocol: &#09"."<b>"  .$_SERVER['SERVER_PROTOCOL']    ."</b>"."</br>";
echo "Request Method: &#09"."<b>"   .$_SERVER['REQUEST_METHOD']     ."</b>"."</br></br>";
echo "<b>" . __DIR__ . "</b><br><br><hr>";

echo "<h3><a href='#module_xdebug'><b>>> XDEBUG PHP</b></center></a><hr></h3>";
echo "<h3><a href='./index.php'><b>>> HOME</b></center></a><hr></h3>";
echo "<hr><h2><u>PHP INFO</u></h2></pre>";
echo "</header>";

// ************************** */
phpinfo();
