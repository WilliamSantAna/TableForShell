<?php

/*
 * Imprindo no navegador
 */

include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
$tableForShell = new TableForShell();
$tableForShell->setMode('navigator');

$tableForShell->cabecalho(
    array(
        array('Listando numeros de 1 a 999, e separando em colunas', 98, 'C')
    ),
    array(
        array('Coluna 1', 10, 'R'),
        array('Coluna 2', 10, 'R'),
        array('Coluna 3', 10, 'R'),
        array('Coluna 4', 10, 'R'),
        array('Coluna 5', 10, 'R'),
        array('Coluna 6', 10, 'R'),
        array('Coluna 7', 10, 'R'),
        array('Coluna 8', 10, 'R'),
        array('Coluna 9', 10, 'R'),
    )
);

foreach (range(1, 9999) as $n) {
    $tableForShell->cell($n, 10, 'R');
    if ($n % 9 == 0) {
        $tableForShell->newline();
    }
}

$somaTotal = (1 + 9999) * (9999 / 2);

$tableForShell->rodape(array(array('Pronto, terminamos de imprimir tudo. Agora kbo. Teve bao hein! Soma Total: ' . $somaTotal, 98, 'C')));
?>
