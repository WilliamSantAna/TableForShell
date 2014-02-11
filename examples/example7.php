<?php
include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
$tableForShell = new TableForShell();


$html = '
    <table>
        <tr>
            <th style="text-align:right;">nome </th>
            <th align="center">Telefone Um</th>
            <th align="right">Telefone Dois</th>
        </tr>
        <tr>
            <td>Leferso 1</td>
            <td>(93) 4138-8111</td>
            <td>(80) 8986-3284</td>
        </tr>
        <tr>
            <td>Leferso 2</td>
            <td>(45) 3977-8749</td>
            <td>(63) 5414-9396</td>
        </tr>
        <tr>
            <td>Leferso 3</td>
            <td>(81) 8917-2456</td>
            <td>(57) 7203-1173</td>
        </tr>
        <tr>
            <td>Leferso 4</td>
            <td>(76) 5538-9753</td>
            <td>(56) 2981-8089</td>
        </tr>
        <tr>
            <td>Leferso 5</td>
            <td>(62) 4982-3117</td>
            <td>(32) 1341-6327</td>
        </tr>
        <tr>
            <td>Leferso 6</td>
            <td>(49) 6806-6464</td>
            <td>(31) 8672-3159</td>
        </tr>
        <tr>
            <td>Leferso 7</td>
            <td>(83) 6463-7715</td>
            <td>(14) 4744-3647</td>
        </tr>
        <tr>
            <td>Leferso 8</td>
            <td>(82) 7443-4819</td>
            <td>(64) 8519-5855</td>
        </tr>
        <tr>
            <td>Leferso 9</td>
            <td>(23) 3258-8516</td>
            <td>(20) 8311-2707</td>
        </tr>
        <tr>
            <td>Leferso 10</td>
            <td>(14) 9785-7948</td>
            <td>(99) 9335-7851</td>
        </tr>
        <tr>
            <tf align="left">Opaaaa</tf>
            <tf align="center">Kbo hein</tf>
            <tf align="right">Teve bao</tf>
        </tr>
    </table>
';


$tableForShell->tableHTMLToShell($html);
?>
