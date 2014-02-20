<?php
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
    $tableForShell = new TableForShell();

    $tableForShell->header(
        array(
            array('List numbers of 1 to 999, and splitting in columns', 98, 'C')
        ),
        array(
            array('Column 1', 10, 'L'),
            array('Column 2', 10, 'L'),
            array('Column 3', 10, 'L'),
            array('Column 4', 10, 'C'),
            array('Column 5', 10, 'C'),
            array('Column 6', 10, 'C'),
            array('Column 7', 10, 'R'),
            array('Column 8', 10, 'R'),
            array('Column 9', 10, 'R'),
        )
    );

    foreach (range(1, 999) as $n) {
        $align = (in_array($n % 9, array(1, 2, 3)) ? "L" : (in_array($n % 9, array(4, 5, 6)) ? "C" : "R"));
        $tableForShell->cell($n, 10, $align);
        if ($n % 9 == 0) {
            $tableForShell->newline();
        }
    }

    $somaTotal = (1 + 999) * (999 / 2);

    $tableForShell->footer(array(array('Total: ' . $somaTotal, 98, 'C')));