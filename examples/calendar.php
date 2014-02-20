<?php

include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
$tableForShell = new TableForShell();
//$tableForShell->setDelay(0.1);

foreach (range(1, 12) as $mes) {
    $dia = 1;
    $ano = date('Y');
    $mktime = mktime(0,0,0,$mes,1,$ano);
    $diaSemanaInicial = date("w", $mktime);


    $tableForShell->header(
        array(
            array(sprintf("%s %04s", date('F', $mktime), $ano), 76, 'C')
        ),
        array(
            array('Sun', 10, 'C'),
            array('Mon', 10, 'C'),
            array('Tue', 10, 'C'),
            array('Wed', 10, 'C'),
            array('Thu', 10, 'C'),
            array('Fri', 10, 'C'),
            array('Sat', 10, 'C'),
        )
    );

    $begin = false;
    $end = false;
    foreach (range(0, 5) as $linhas) {
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
        if ($end) break;
        $tableForShell->newline();
    }
    $tableForShell->newline();
    $tableForShell->footer(array(array('-', 76, 'C')));
    $tableForShell->enter();
    $tableForShell->enter();
    $tableForShell->enter();
}