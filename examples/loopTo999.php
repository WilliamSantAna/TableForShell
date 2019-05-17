<?php
    require dirname(__FILE__) . '/../vendor/autoload.php';
    use WilliamSantAna\TableForShell\TableForShell;

    
    $tableForShell = new TableForShell();

    // Prints a multiheader
    // 1st line are colspaned to 9 columns as can be in 2nd line
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
        // First 3 columns are left aligned, next 3 are centered, last 3 are right aligned
        $align = (in_array($n % 9, array(1, 2, 3)) ? "L" : (in_array($n % 9, array(4, 5, 6)) ? "C" : "R"));
        $tableForShell->cell($n, 10, $align);
        if ($n % 9 == 0) {
            $tableForShell->newline();
        }
    }
    $sum = (1 + 999) * (999 / 2);

    // Print a footer with centered text you want
    $tableForShell->footer(array(array('SUM: ' . $sum, 98, 'C')));