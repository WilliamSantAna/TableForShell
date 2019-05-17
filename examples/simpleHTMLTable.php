<?php
    require dirname(__FILE__) . '/../vendor/autoload.php';
    use WilliamSantAna\TableForShell\TableForShell;

    $tableForShell = new TableForShell();

    $htmlToPrint = '
    <table>
        <tr>
            <th style="text-align:right;text-transform: uppercase;">Name</th>
            <th align="center">Address</th>
            <th align="left">Phone</th>
        </tr>
        <tr>
            <td>William Sant Ana</td>
            <td>39-40 Beacon Street</td>
            <td>+55 (319) 919-3823</td>
        </tr>
        <tr>
            <tf>Listed Address</tf>
            <tf>Real addresses</tf>
            <tf>Bogus phone number</tf>
        </tr>
    </table>';

    $htmlExpected = '';
    $htmlExpected .= '+------------------+---------------------+--------------------+' . $tableForShell->getLf();
    $htmlExpected .= '|             NAME |       Address       | Phone              |' . $tableForShell->getLf();
    $htmlExpected .= '+------------------+---------------------+--------------------+' . $tableForShell->getLf();
    $htmlExpected .= '| William Sant Ana | 39-40 Beacon Street | +55 (319) 919-3823 |' . $tableForShell->getLf();
    $htmlExpected .= '+------------------+---------------------+--------------------+' . $tableForShell->getLf();
    $htmlExpected .= '| Listed Address   | Real addresses      | Bogus phone number |' . $tableForShell->getLf();
    $htmlExpected .= '+------------------+---------------------+--------------------+';

    $tableForShell->tableHTMLToShell($htmlToPrint);
