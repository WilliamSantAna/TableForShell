<?php

$contador1 = 0;
$contador2 = 0;
$contador3 = 0;
$contador4 = 0;
$somaGeral = 0;

include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';

foreach (range(2,6,2) as $j) { 
    $tableForShell = new TableForShell();
    $tableForShell->setDelay(0.1);

    $tableForShell->cabecalho(
        array(
            array('Lista e soma colunas aleatoriamente', 91, 'C')
        ),
        array(
            array('Coluna Centralizada', 30, 'C'),
            array('A Direita', 23, 'R'),
            array('A Esquerda', 20, 'L'),
            array('Col. Pequena', 15, 'R'),
        )
    );

    foreach (range(1, 10) as $i) {
        $contador1 += 1 * $j;
        $contador2 += 2 * $j * $j;
        $contador3 += 3 * $j * $j * $j;
        $contador4 += 4 * $j * $j * $j * $j;
        
        $tableForShell->line(
            array(
                array("Contador 1: " . $contador1, 30, 'C'),
                array("Contador 2: " . $contador2, 23, 'R'),
                array("Contador 3: " . $contador3, 20, 'L'),
                array("Contador 4: " . $contador4, 15, 'R'),
            )
        );
    }

    $tableForShell->rodape(
        array(
            array("Total 1: " . $contador1, 30, 'C'),
            array("Total 2: " . $contador2, 23, 'R'),
            array("Total 3: " . $contador3, 20, 'L'),
            array("Total 4: " . $contador4, 15, 'R'),
        ),
        array(
            array('Total Geral: ' . ($contador1 + $contador2 + $contador3 + $contador4), 91, 'C'),
        )
    );

    $tableForShell->enter();
    $tableForShell->enter();
    
    $somaGeral += ($contador1 + $contador2 + $contador3 + $contador4);
    
}

$tableForShell->rodape(
    array(
        array('>>>>>>>>>>>>>> Total Geral De Tudo Somado: ' . $somaGeral . " <<<<<<<<<<<<<<", 91, 'C'),
    )
);
