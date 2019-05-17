<?php
    require dirname(__FILE__) . '/../vendor/autoload.php';
    use WilliamSantAna\TableForShell\TableForShell;

    $tableForShell = new TableForShell();

    // Set a delay if you want to see some 'animation' on output
    //$tableForShell->setDelay(0.1);

    foreach (range(1, 12) as $mes) {
        $day = 1;
        $year = date('Y');
        $mktime = mktime(0,0,0,$mes,1,$year);
        $initialWeekday = date("w", $mktime);

        $tableForShell->header(
            array(
                array(sprintf("%s %04s", date('F', $mktime), $year), 76, 'C')
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
        foreach (range(0, 5) as $lines) {
            foreach (range(0, 6) as $columns) {
                if ($lines == 0 && $columns == $initialWeekday) {
                    $begin = true;
                    $end = false;
                }
                if ($day > date('t', mktime(0,0,0,$mes))) {
                    $end = true;
                }
                if ($begin && !$end) {
                    $tableForShell->cell($day, 10, 'C');
                    $day++;
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