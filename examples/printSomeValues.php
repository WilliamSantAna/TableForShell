<?php

    $counter1 = 0;
    $counter2 = 0;
    $counter3 = 0;
    $counter4 = 0;
    $generalSum = 0;

    include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';

    foreach (range(2,6,2) as $j) { 
        $tableForShell = new TableForShell();
        $tableForShell->setDelay(0.1);

        $tableForShell->header(
            array(
                array('List and sum some values', 94, 'C')
            ),
            array(
                array('Centralized Column', 30, 'C'),
                array('To the Right', 23, 'R'),
                array('To the Left', 20, 'L'),
                array('Small Col', 18, 'R'),
            )
        );

        foreach (range(1, 10) as $i) {
            $counter1 += 1 * $j;
            $counter2 += 2 * $j * $j;
            $counter3 += 3 * $j * $j * $j;
            $counter4 += 4 * $j * $j * $j * $j;

            $tableForShell->line(
                array(
                    array("Counter 1: " . $counter1, 30, 'C'),
                    array("Counter 2: " . $counter2, 23, 'R'),
                    array("Counter 3: " . $counter3, 20, 'L'),
                    array("Counter 4: " . $counter4, 18, 'R'),
                )
            );
        }

        $tableForShell->footer(
            array(
                array("Total 1: " . $counter1, 30, 'C'),
                array("Total 2: " . $counter2, 23, 'R'),
                array("Total 3: " . $counter3, 20, 'L'),
                array("Total 4: " . $counter4, 18, 'R'),
            ),
            array(
                array('General Total: ' . ($counter1 + $counter2 + $counter3 + $counter4), 94, 'C'),
            )
        );

        $tableForShell->enter();
        $tableForShell->enter();

        $generalSum += ($counter1 + $counter2 + $counter3 + $counter4);

    }

    $tableForShell->footer(
        array(
            array('>>>>>>>>>>>>>> General Total of All Sum: ' . $generalSum . " <<<<<<<<<<<<<<", 94, 'C'),
        )
    );
