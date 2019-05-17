<?php

	use PHPUnit\Framework\TestCase;

	use WilliamSantAna\TableForShell\TableForShell;	

	class TableForShellTest extends TestCase {


		public function testMustPrintNothing() {
			$expected = '';
			$this->expectOutputString($expected);

			$TableForShell = new TableForShell();
			$TableForShell->tableHTMLToShell();
		}

		public function testMustPrintALeftAlignedCell() {
		    $tableForShell = new TableForShell();
		    
			$expected = '| TEXT     ';
			$this->expectOutputString($expected);

			$tableForShell->cell('TEXT', 10, 'L', true);
		}

		public function testMustPrintACenterAlignedCell() {
		    $tableForShell = new TableForShell();

			$expected = '|   TEXT   ';
			$this->expectOutputString($expected);

			$tableForShell->cell('TEXT', 10, 'C', true);
		}

		public function testMustPrintARightAlignedCell() {
		    $tableForShell = new TableForShell();

			$expected = '|     TEXT ';
			$this->expectOutputString($expected);

			$tableForShell->cell('TEXT', 10, 'R', true);
		}

		public function testMustPrintAWholeBorderedHeader() {
		    $tableForShell = new TableForShell();

			$expected = '';
			$expected .= '+----------+----------+----------+----------+----------+----------+----------+' . $tableForShell->getLf();
			$expected .= '|    Sun   |    Mon   |    Tue   |    Wed   |    Thu   |    Fri   |    Sat   |' . $tableForShell->getLf();
			$expected .= '+----------+----------+----------+----------+----------+----------+----------+' . $tableForShell->getLf();
			$this->expectOutputString($expected);

			$tableForShell->header(array(
                array('Sun', 10, 'C'),
                array('Mon', 10, 'C'),
                array('Tue', 10, 'C'),
                array('Wed', 10, 'C'),
                array('Thu', 10, 'C'),
                array('Fri', 10, 'C'),
                array('Sat', 10, 'C'),
            ));
		}

		public function testMustPrintAWholeBorderedFooter() {
		    $tableForShell = new TableForShell();

			$expected = '';
			$expected .= '+----------+----------+----------+----------+----------+----------+----------+' . $tableForShell->getLf();
			$expected .= '|    Sun   |    Mon   |    Tue   |    Wed   |    Thu   |    Fri   |    Sat   |' . $tableForShell->getLf();
			$expected .= '+----------+----------+----------+----------+----------+----------+----------+' . $tableForShell->getLf();
			$this->expectOutputString($expected);

			$tableForShell->footer(array(
                array('Sun', 10, 'C'),
                array('Mon', 10, 'C'),
                array('Tue', 10, 'C'),
                array('Wed', 10, 'C'),
                array('Thu', 10, 'C'),
                array('Fri', 10, 'C'),
                array('Sat', 10, 'C'),
            ));
		}


		public function testMustPrintAComplexBorderedSampleHtmlTable() {
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
			$htmlExpected .= '+------------------+---------------------+--------------------+' . $tableForShell->getLf();
			
			$this->expectOutputString($htmlExpected);
		    $tableForShell->tableHTMLToShell($htmlToPrint);
		}
	}