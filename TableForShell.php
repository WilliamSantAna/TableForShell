<?php

    namespace WilliamSantana\TableForShell;
    /*
        Table For Shell v1.0
        This class provides an easy way to print simple pre-formatted data on console.
        A basic HTML table can also be printed. See examples to undestand better how it works.

        Copyright (c) 2014, William Sant Ana
        All rights reserved.

        Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

        1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
        2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, 
        INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
        IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, 
        OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
        OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT 
        (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 
    */

    class TableForShell {
        private $delay = 0;
        private $mode = 'shell';
        private $lf = '\r\n';

        public function __construct($detectEnviroment = true) {
            $this->setMode('shell');
            $this->setDelay(0);
            $this->setLf(chr(13) . chr(10));
            if ($detectEnviroment) {
                $this->detectEnviroment();
            }
        }

        /**
         * Set some delay (microseconds) to print each set of chars
         * @param int $delay 
         */
        public function setDelay($delay) {
            $this->delay = $delay * pow(10, 6);
        }

        /**
         * Set breakline char
         * @param string $lf 
         */
        public function setLf($lf) {
            $this->lf = $lf;
        }

        /**
         * Get breakline char
         * @param string $lf 
         */
        public function getLf() {
            return $this->lf;
        }

        /**
         * Set output mode (shell or navig)
         * @param type $mode 
         * @return type
         */
        public function setMode($mode) {
            $this->mode = $mode;
            if ($this->mode == 'navig') {
                echo '<xmp>' . $this->lf;
            }
        }

        /**
         * Automacally detect enviroment which is running
         * @return type
         */
        private function detectEnviroment() {
            if (PHP_SAPI == 'cli') {
                /* Running on console */
                $this->setMode('shell');
            }
            else {
                /* Running on browser */
                $this->setMode('navig');
            }
        }

        /**
         * Prints header of table
         */
        public function header() {
            $headers = func_get_args();
            $dashes = "";
            foreach ($headers as $header) {
                $dashes = "";
                foreach ($header as $cells) {
                    $dashes .= "+";
                    $dashes .= str_repeat("-", $cells[1]);
                }
                $dashes .= "+";

                echo $dashes . $this->lf;

                foreach ($header as $cells) {
                    $cells[2] = (isset($cells[2]) ? $cells[2] : 'L');
                    $this->cell($cells[0], $cells[1], $cells[2]);
                }
                $this->newline();
            }
            echo $dashes . $this->lf;
        }

        /**
         * Prints footer of table
         */
        public function footer() {
            $footers = func_get_args();
            foreach ($footers as $footer) {
                $dashes = "";
                foreach ($footer as $cells) {
                    $dashes .= "+";
                    $dashes .= str_repeat("-", $cells[1]);
                }
                $dashes .= "+";

                echo $dashes . $this->lf;

                foreach ($footer as $cells) {
                    $cells[2] = (isset($cells[2]) ? $cells[2] : 'L');
                    $this->cell($cells[0], $cells[1], $cells[2]);
                }
                $this->newline();
            }
            echo $dashes . $this->lf;
        }

        /**
         * Print a separator or a line of table
         * @param array $cells 
         */
        public function line(array $cells) {
            foreach ($cells as $cell) {
                $cell[2] = (isset($cell[2]) ? $cell[2] : 'L');
                $this->cell($cell[0], $cell[1], $cell[2]);
            }
            $this->newline();
        }

        /**
         * Prints a cell of a table
         * @param string $text Text to print
         * @param int $width Width of cell (defaults to 100)
         * @param string $align Alignment of content on cell (defaults to L=Left, but it can be C=CENTER or R-RIGHT)
         * @param boolean $border Prints Border? 
         */
        public function cell($text, $width = 100, $align = 'L', $border = true) {
            $cell = array('text' => $text, 'width' => $width, 'align' => $align, 'border' => $border);

            if ($border) {
                echo "|";
            }

            echo " ";

            if ($cell['align'] == 'L') {
                if (strlen($cell['text']) < ($cell['width'] - 1)) {
                    echo $cell['text'] . str_repeat(" ", $cell['width'] - strlen($cell['text']) - 2);
                }
                else {
                    if ($cell['width'] >= 6) {
                        echo substr($cell['text'], 0, $cell['width'] - 6) . " ...";
                    }
                    else {
                        echo substr($cell['text'], 0, $cell['width'] - 2);
                    }
                }
                echo " ";
            }
            else if ($cell['align'] == 'C') {
                if (strlen($cell['text']) >= ($cell['width'] - 1)) {
                    $cell['text'] = substr($cell['text'], 0, $cell['width'] - 6) . " ...";
                }

                $begin = floor($cell['width'] / 2) - floor(strlen($cell['text']) / 2) - 1;
                echo str_repeat(" ", $begin);
                echo $cell['text'];
                echo str_repeat(" ", $cell['width'] - ($begin + strlen($cell['text'])) - 2);
                echo " ";
            }
            else if ($cell['align'] == 'R') {
                if (strlen($cell['text']) >= ($cell['width'] - 1)) {
                    $cell['text'] = "... " . substr($cell['text'], 0, $cell['width'] - 6);
                }

                $begin = $cell['width'] - strlen($cell['text']) - 2;
                echo str_repeat(" ", $begin);
                echo $cell['text'] . " ";
            }
            @usleep($this->delay);
        }

        public function newline($border = true) {
            if ($border) {
                echo "|";
            }
            echo $this->lf;
        }

        public function enter() {
            echo $this->lf;
        }

        /**
         * Prints a HTML table to enviroment
         * @param string $html HTML to print
         */
        public function tableHTMLToShell($html = '') {
            $tableArray = array();

            $dom = new \DOMDocument();
            $actualLevelError = error_reporting(0);
            $dom->loadHTML($html);
            error_reporting($actualLevelError);

            $tables = $dom->getElementsByTagName("table");

            for ($a = 0; $a < $tables->length; $a++) {
                $tableArray = array();

                /**
                 * Parsing the table to array
                 */
                $table = $tables->item($a);
                if ($table->hasChildNodes()) {
                    $tr = $table->firstChild;
                    do {
                        if ($tr->hasChildNodes()) {
                            $cells = array();
                            $childs = $tr->childNodes;
                            for ($c = 0; $c < $childs->length; $c++) {
                                $child = $childs->item($c);
                                if ($child->nodeName != "#text") {
                                    $text = $child->nodeValue;
                                    $align = "L";
                                    $width = "";
                                    $colspan = "0";

                                    /* Getting some basic <td> attributes */
                                    /* More attrs have to be implemented */
                                    $trs = $child->attributes;
                                    if (!is_null($trs)) {
                                        $align = "L";
                                        for ($d = 0; $d < $trs->length; $d++) {
                                            $attr = $trs->item($d);

                                            /* Parsing alignments */
                                            if ($attr->name == "align") {
                                                switch ($attr->value) {
                                                    case "center":
                                                        $align = "C";
                                                        break;
                                                    case "right":
                                                        $align = "R";
                                                        break;
                                                }
                                            }

                                            /* Parsing width */
                                            if ($attr->name == "width") {
                                                $width = $attr->value;
                                            }

                                            /* Colspan */
                                            if ($attr->name == "colspan") {
                                                $colspan = (is_numeric($attr->value) ? $attr->value : 0);
                                            }

                                            /* Parsing styles */
                                            if ($attr->name == "style") {
                                                $styleAttr = $attr->value;
                                                $styleDesn = explode(";", $styleAttr);
                                                $style = array();
                                                foreach ($styleDesn as $val) {
                                                    if (strpos($val, ":") !== false) {
                                                        list($def, $vlr) = explode(":", $val);
                                                        $style[$def] = trim($vlr);
                                                    }
                                                }

                                                /* text-aling */
                                                if (isset($style['text-align'])) {
                                                    switch ($style['text-align']) {
                                                        case "center":
                                                            $align = "C";
                                                            break;
                                                        case "right":
                                                            $align = "R";
                                                            break;
                                                    }
                                                }

                                                /* text-transform */
                                                if (isset($style['text-transform'])) {
                                                    switch ($style['text-transform']) {
                                                        case "capitalize": case "uppercase":
                                                            $text = strtoupper($text);
                                                            break;
                                                        case "lowercase":
                                                            $text = strtolower($text);
                                                            break;
                                                    }
                                                }

                                                /* direction */
                                                if (isset($style['direction'])) {
                                                    switch ($style['direction']) {
                                                        case "rtl": 
                                                            $text = implode("", array_reverse(str_split($text)));
                                                            break;
                                                    }
                                                }

                                                /* width */
                                                if (isset($style['width'])) {
                                                    $width = $style['width'];
                                                }
                                            }
                                        }
                                    }

                                    $cellType = ($child->nodeName == "th" ? "header" : ($child->nodeName == "tf" ? "footer" : "line")  );
                                    $cells[] = array($text, $width, $align, $cellType, $colspan);
                                }
                            }

                            $tableArray[] = $cells;
                        }
                    } while ($tr = $tr->nextSibling);
                }

                /* 
                 * At this point, table lines were fetched. 
                 * We can analyze each column width and the whole table width 
                 * to measure each non-setted width and the appropriated colspan
                 */

                /* Recalculating each width to standardize the table */
                $colsWidth = array();
                foreach ($tableArray as $lines) {
                    foreach ($lines as $i => $columns) {
                        if ( is_numeric($columns[1]) ) {
                            $colsWidth[$i] = @max($colsWidth[$i], $columns[1]);
                        }
                        else {
                            $colsWidth[$i] = @max($colsWidth[$i], strlen($columns[0]) + 2);
                        }
                    }
                }
                $tableArrayAux = $tableArray;
                foreach ($tableArray as $l => $lines) {
                    foreach ($lines as $c => $columns) {
                        $tableArrayAux[$l][$c] = array($columns[0], $colsWidth[$c], $columns[2], $columns[3]);
                    }
                }
                $tableArray = $tableArrayAux;
                unset($tableArrayAux);

                /**
                 * Plotting the table
                 */

                $headers = array();
                $lines = array();
                $footers = array();
                foreach ($tableArray as $l => $linesx) {
                    foreach ($linesx as $c => $columns) {
                        if ($columns[3] == "header") {
                            $headers[$l] = $linesx;
                        }
                        else if ($columns[3] == "line") {
                            $lines[$l] = $linesx;
                        }
                        if ($columns[3] == "footer") {
                            $footers[$l] = $linesx;
                        }
                    }
                }

                if (count($tableArray) > 0) {
                    $lastCell = $tableArray[0];
                    $dashes = "";
                    foreach ($lastCell as $cell) {
                        $dashes .= "+";
                        $dashes .= str_repeat("-", $cell[1]);
                    }
                    $dashes .= "+";
                    echo $dashes . $this->lf;
                }



                if (count($headers)) {
                    /* plotting the headers */
                    foreach ($headers as $line) {
                        $this->line($line);
                    }
                    if (count($tableArray) > 0) {
                        $lastCell = $line;
                        $dashes = "";
                        foreach ($lastCell as $cell) {
                            $dashes .= "+";
                            $dashes .= str_repeat("-", $cell[1]);
                        }
                        $dashes .= "+";
                        echo $dashes . $this->lf;
                    }
                }


                if (count($lines) > 0) {
                    /* plotting all <tr>s */
                    foreach ($lines as $line) {
                        $this->line($line);
                    }

                    $lastCell = $line;
                    $dashes = "";
                    foreach ($lastCell as $cell) {
                        $dashes .= "+";
                        $dashes .= str_repeat("-", $cell[1]);
                    }
                    $dashes .= "+";
                    echo $dashes . $this->lf;
                }



                if (count($footers)) {
                    /* plotting footers */
                    foreach ($footers as $line) {
                        $this->line($line);
                    }
                }

                /* closing the table */
                if (count($tableArray) > 0) {
                    $lastCell = $tableArray[count($tableArray) - 1];
                    $dashes = "";
                    foreach ($lastCell as $cell) {
                        $dashes .= "+";
                        $dashes .= str_repeat("-", $cell[1]);
                    }
                    $dashes .= "+";
                    echo $dashes . $this->lf;
                }
            }
        }
    }