<?php
    
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . '../tableForShell.php';
    $tableForShell = new TableForShell();

    
    $contacts = array(
        array('Henry Wadsworth Longfellow courted and married Fanny Appleton',              '39-40 Beacon Street',          sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('John Fitzgerald Kennedy',                                                    '122 Bowdoin Street',           sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('Church of the Advent',                                                       '30 Brimmer Street',            sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('Upper Plaza - Garden of Peace',                                              '100 Cambridge Street',         sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('Mary Sullivan, last victim of the Boston Strangler, murdered here',          '44A Charles Street',           sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('architect Charles Bulfinch designed row-houses for Hepzibah Swan',           '13, 15, 17 Chestnut Street',   sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('Leonard A. Grimes, black clergyman header of the abolitionist movement.',    '28 Grove Street',              sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('Birthplace of Charles Sumner, abolitionist, U.S. Senator.',                  '58 Irving Street',             sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('African Meeting House.',                                                     '46 Joy Street',                sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('singer Jenny Lind married Otto Goldschmidt here',                            '20 Louisburg Square',          sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
        array('home of The Real World: Boston and Spenser',                                 '127 Mount Vernon Street',      sprintf("%+d (%d) %03s-%04s", mt_rand(1, 99), mt_rand(100, 999), mt_rand(100, 999), mt_rand(100, 9999))),
    );

    $html = '
            <table>
                <tr>
                    <th style="text-align:right;text-transform: uppercase;">List of addresses in Beacon Hill, Boston</th>
                    <th align="center">Address</th>
                    <th align="left">Phone</th>
                </tr>
    ';
    foreach ($contacts as $contact) {
        $html .= '<tr>
                    <td>' . $contact[0] . '</td>
                    <td>' . $contact[1] . '</td>
                    <td>' . $contact[2] . '</td>
                </tr>';
    }
    $html .= '  <tr>
                    <tf>Listed some POI on Boston</tf>
                    <tf>Some real addresses</tf>
                    <tf>Some bogus phone numbers</tf>
                </tr>';
    $html .= '</table>';


    $tableForShell->tableHTMLToShell($html);
