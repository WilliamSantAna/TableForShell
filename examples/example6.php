<?php

include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
$tableForShell = new TableForShell();
$tableForShell->setDelay(0.1);

foreach (range(1, 12) as $mes) {
    $dia = 1;
    $diaSemanaInicial = date("w", mktime(0,0,0,$mes,1));


    $tableForShell->cabecalho(
        array(
            array('Mes ' . $mes . ' - 2013', 76, 'C')
        ),
        array(
            array('Dom', 10, 'C'),
            array('Seg', 10, 'C'),
            array('Ter', 10, 'C'),
            array('Qua', 10, 'C'),
            array('Qui', 10, 'C'),
            array('Sex', 10, 'C'),
            array('Sab', 10, 'C'),
        )
    );

    $begin = false;
    $end = false;
    foreach (range(0, 4) as $linhas) {
        foreach (range(0, 6) as $colunas) {
            if ($linhas == 0 && $colunas == $diaSemanaInicial) {
                $begin = true;
                $end = false;
            }
            if ($dia > date('t', mktime(0,0,0,$mes))) {
                $end = true;
            }
            if ($begin && !$end) {
                $tableForShell->cell($dia, 10, 'C');
                $dia++;
            }
            else {
                $tableForShell->cell('', 10, 'C');
            }
        }
        $tableForShell->newline();
    }
    $tableForShell->rodape(array(array('', 76, 'R')));
    $tableForShell->enter();
    $tableForShell->enter();
    $tableForShell->enter();
}