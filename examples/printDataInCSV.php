<?php

    $time = microtime(true);
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';

    $tableForShell = new TableForShell();
    $tableForShell->setDelay(0.15);

    $handle = fopen(dirname(__FILE__) . DIRECTORY_SEPARATOR . "csvData.csv", "r");
    $row = 1;
    while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
        if ($row == 1) {
            /* first line, header */
            $fields = array();
            $widths = array(5, 9, 9, 9, 30, 30, 30);
            for ($c = 0; $c < count($data); $c++) {
                $fields[] = array($data[$c], $widths[$c], 'C');
            }

            $tableForShell->header($fields);
        }
        else {
            /* lines */
            for ($c = 0; $c < count($data); $c++) {
                $text = $data[$c];
                $width = $widths[$c];
                $align = (is_numeric($text) ? 'R' : 'L');
                $tableForShell->cell($text, $width, $align);
            }
            $tableForShell->newline();
        }
        $row++;
    }
    fclose($handle);

    $footerWidth = array_sum($widths) + count($widths) - 1;
    $time = round(microtime(true) - $time, 2);
    $tableForShell->footer(
        array(
            array($row . ' lines in ' . $time . ' secs.', $footerWidth - 31, 'C'),
            array('END OF PROC.', 30, 'C')
        )
    );

    