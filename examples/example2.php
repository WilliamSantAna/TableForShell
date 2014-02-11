<?php

$time = microtime(true);
include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';

$tableForShell = new TableForShell();
$tableForShell->setDelay(0.15);

$handle = fopen(dirname(__FILE__) . DIRECTORY_SEPARATOR . "dados.csv","r");
$row = 1;
while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
    if ($row == 1) {
        /* Primeira linha, cabecalho */
        $fields = array();
        $widths = array(5, 9, 9, 9, 30, 30, 30);
        for ($c = 0; $c < count($data); $c++) {
            $fields[] = array($data[$c], $widths[$c], 'C');
        }
        
        $tableForShell->cabecalho($fields);
    }
    else {
        /* Demais linhas, corpo */
        $lines = array();
        for ($c = 0; $c < count($data); $c++) {
            $texto = $data[$c];
            $width = $widths[$c];
            $align = (is_numeric($texto) ? 'R' : 'L');
            $tableForShell->cell($texto, $width, $align);
        }
        $tableForShell->newline();
    }
    $row++;
}
fclose($handle);

$widthRodape = array_sum($widths) + count($widths) - 1;
$time = round(microtime(true) - $time, 2);
$tableForShell->rodape(
    array(
        array($row . ' registros em ' . $time . ' segundos.', $widthRodape - 31, 'C'),
        array('FIM DE PROCESSAMENTO.', 30, 'C')
    )
);
