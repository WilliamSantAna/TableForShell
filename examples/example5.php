<?php

include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
$tableForShell = new TableForShell();


foreach (range(1, 10) as $i) {
    
    echo '               *' . PHP_EOL;
    usleep(50000);
    echo '              ***' . PHP_EOL;
    usleep(50000);
    echo '             *****' . PHP_EOL;
    usleep(50000);
    echo '            *******' . PHP_EOL;
    usleep(50000);
    echo ' ******************************' . PHP_EOL;
    usleep(50000);
    echo '   *************************' . PHP_EOL;
    usleep(50000);
    echo '      *******************' . PHP_EOL;
    usleep(50000);
    echo '        **************' . PHP_EOL;
    usleep(50000);
    echo '       ******     *****' . PHP_EOL;
    usleep(50000);
    echo '      *****        *****' . PHP_EOL;
    usleep(50000);
    echo '     ****            ****' . PHP_EOL;
    usleep(50000);
    echo '    ***                ***' . PHP_EOL;
    usleep(50000);
    echo '   **                    **' . PHP_EOL;
    usleep(50000);
    echo '  *                        *' . PHP_EOL;

    echo PHP_EOL;
    echo PHP_EOL;
    
}