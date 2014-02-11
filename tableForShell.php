<?php

class TableForShell {
    private $delay = 0;
    private $mode = 'shell';
    private $lf = '\r\n';
    
    public function setDelay($delay) {
        $this->delay = $delay * 100000;
    }
    
    public function setLf($lf) {
        $this->lf = $lf;
    }

    public function setMode($mode) {
        $this->mode = $mode;
        if ($this->mode == 'navigator') {
            echo '<pre>' . $this->lf;
        }
    }

    private function detectEnviroment() {
        if (PHP_SAPI == 'cli') {
            /* Rodando no shell */
            $this->setMode('shell');
        }
        else {
            /* Rodando no navegador */
            $this->setMode('navigator');
        }
    }
    
    public function __construct($detectEnviroment = true) {
        $this->setMode('shell');
        $this->setDelay(0);
        $this->setLf(chr(13) . chr(10));
        if ($detectEnviroment) {
            $this->detectEnviroment();
        }
    }

    public function cabecalho() {
        $cabecalhos = func_get_args();
        foreach ($cabecalhos as $cabecalho) {
            $tracejado = "";
            foreach ($cabecalho as $cells) {
                $tracejado .= "+";
                $tracejado .= str_repeat("-", $cells[1]);
            }
            $tracejado .= "+";
            
            echo $tracejado . $this->lf;
            
            foreach ($cabecalho as $cells) {
                $cells[2] = (isset($cells[2]) ? $cells[2] : 'L');
                $this->cell($cells[0], $cells[1], $cells[2]);
            }
            $this->newline();
        }
        echo $tracejado . $this->lf;
    }
    
    public function rodape() {
        $rodapes = func_get_args();
        foreach ($rodapes as $rodape) {
            $tracejado = "";
            foreach ($rodape as $cells) {
                $tracejado .= "+";
                $tracejado .= str_repeat("-", $cells[1]);
            }
            $tracejado .= "+";
            
            echo $tracejado . $this->lf;
            
            foreach ($rodape as $cells) {
                $cells[2] = (isset($cells[2]) ? $cells[2] : 'L');
                $this->cell($cells[0], $cells[1], $cells[2]);
            }
            $this->newline();
        }
        echo $tracejado . $this->lf;
    }
    
    public function line($cells) {
        foreach ($cells as $cell) {
            $cell[2] = (isset($cell[2]) ? $cell[2] : 'L');
            $this->cell($cell[0], $cell[1], $cell[2]);
        }
        $this->newline();
    }
    
    public function cell($texto, $width = 100, $align = 'L', $border = 1) {
        $cell = array('texto' => $texto, 'width' => $width, 'align' => $align, 'border' => $border);

        if ($border == 1) {
            echo "|";
        }
        
        echo " ";

        if ($cell['align'] == 'L') {
            if (strlen($cell['texto']) < ($cell['width'] - 1)) {
                echo $cell['texto'] . str_repeat(" ", $cell['width'] - strlen($cell['texto']) - 2);
            }
            else {
                if ($cell['width'] >= 6) {
                    echo substr($cell['texto'], 0, $cell['width'] - 6) . " ...";
                }
                else {
                    echo substr($cell['texto'], 0, $cell['width'] - 2);
                }
            }
            echo " ";
        }
        else if ($cell['align'] == 'C') {
            if (strlen($cell['texto']) >= ($cell['width'] - 1)) {
                $cell['texto'] = substr($cell['texto'], 0, $cell['width'] - 6) . " ...";
            }

            $begin = floor($cell['width'] / 2) - floor(strlen($cell['texto']) / 2) - 1;
            echo str_repeat(" ", $begin);
            echo $cell['texto'];
            echo str_repeat(" ", $cell['width'] - ($begin + strlen($cell['texto'])) - 2);
            echo " ";
        }
        else if ($cell['align'] == 'R') {
            if (strlen($cell['texto']) >= ($cell['width'] - 1)) {
                $cell['texto'] = "... " . substr($cell['texto'], 0, $cell['width'] - 6);
            }

            $begin = $cell['width'] - strlen($cell['texto']) - 2;
            echo str_repeat(" ", $begin);
            echo $cell['texto'] . " ";
        }
        @usleep($this->delay);
    }
    
    public function newline($border = 1) {
        if ($border == 1) {
            echo "|";
        }
        echo $this->lf;
    }
    
    public function enter() {
        echo $this->lf;
    }
    
    
    
    public function tableHTMLToShell($html) {
        $widthTabela = 0;
        $arrayTabela = array();
        
        $dom = new DOMDocument();
        $nivel_atual_erro = error_reporting(0);
        $isLoaded = $dom->loadHTML($html);
        error_reporting($nivel_atual_erro);
        
        $tables = $dom->getElementsByTagName("table");
        
        
        for ($a = 0; $a < $tables->length; $a++) {
            $temLinhas = false;
            $arrayTabela = array();
            
            
            /**
             * ****************************************************************************************************************************
             */
            /**
             * Parsing da tabela para arrays
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
                                $texto = $child->nodeValue;
                                $align = "L";
                                $width = "";
                                $colspan = "0";

                                /* Pegando os atributos do TD */
                                $trs = $child->attributes;
                                if (!is_null($trs)) {
                                    $align = "L";
                                    for ($d = 0; $d < $trs->length; $d++) {
                                        $attr = $trs->item($d);
                                        /* Parsing do align */
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
                                        /* Parsing do width */
                                        if ($attr->name == "width") {
                                            $width = $attr->value;
                                        }
                                        /* Parsing dos styles */
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

                                            /* Verificando se ha algum text-transform */
                                            if (isset($style['text-transform'])) {
                                                switch ($style['text-transform']) {
                                                    case "capitalize": case "uppercase":
                                                        $texto = strtoupper($texto);
                                                        break;
                                                    case "lowercase":
                                                        $texto = strtolower($texto);
                                                        break;
                                                }
                                            }

                                            /* Verificando se ha algum direction */
                                            if (isset($style['direction'])) {
                                                switch ($style['direction']) {
                                                    case "rtl": 
                                                        $texto = implode("", array_reverse(str_split($texto)));
                                                        break;
                                                }
                                            }

                                            /* Verificando se ha algum width */
                                            if (isset($style['width'])) {
                                                $width = $style['width'];
                                            }
                                        }
                                        /* Parsing do colspan */
                                        if ($attr->name == "colspan") {
                                            $colspan = (is_numeric($attr->value) ? $attr->value : 0);
                                        }
                                    }
                                }
                                
                                $tipoCell = ($child->nodeName == "th" ? "header" : ($child->nodeName == "tf" ? "footer" : "line")  );
                                $cells[] = array($texto, $width, $align, $tipoCell, $colspan);
                            }
                        }
                        
                        $arrayTabela[] = $cells;
                    }
                } while ($tr = $tr->nextSibling);
            }
            

            /**
             * ****************************************************************************************************************************
             */
            /* 
             * Com as linhas da tabela montada, vamos analisar os widths de cada coluna e o width da tabela inteira 
             *      para dar widths as colunas que nao foram informados, e tambem os colspan adequados
             */
            
            
            
            /* Corrigindo o width de cada coluna, para padronizar a tabela */
            $colsWidth = array();
            foreach ($arrayTabela as $linhas) {
                foreach ($linhas as $i => $colunas) {
                    if ( is_numeric($colunas[1]) ) {
                        $colsWidth[$i] = @max($colsWidth[$i], $colunas[1]);
                    }
                    else {
                        $colsWidth[$i] = @max($colsWidth[$i], strlen($colunas[0]) + 2);
                    }
                }
            }
            $arrayTabelaAux = $arrayTabela;
            foreach ($arrayTabela as $l => $linhas) {
                foreach ($linhas as $c => $colunas) {
                    $arrayTabelaAux[$l][$c] = array($colunas[0], $colsWidth[$c], $colunas[2], $colunas[3]);
                }
            }
            $arrayTabela = $arrayTabelaAux;
            unset($arrayTabelaAux);
            /* Fim da correcao dos widths das colunas */
            
            
            
            
            
            
            
            /**
             * ****************************************************************************************************************************
             */
            /**
             * Escrevendo a tabela
             */
            
            /* Abrindo a tabela */
            $headers = array();
            $lines = array();
            $footers = array();
            foreach ($arrayTabela as $l => $linhas) {
                foreach ($linhas as $c => $colunas) {
                    if ($colunas[3] == "header") {
                        $headers[$l] = $linhas;
                    }
                    else if ($colunas[3] == "line") {
                        $lines[$l] = $linhas;
                    }
                    if ($colunas[3] == "footer") {
                        $footers[$l] = $linhas;
                    }
                }
            }
            

            /* Abrindo a tabela */
            if (count($arrayTabela) > 0) {
                $lastCell = $arrayTabela[0];
                $tracejado = "";
                foreach ($lastCell as $cell) {
                    $tracejado .= "+";
                    $tracejado .= str_repeat("-", $cell[1]);
                }
                $tracejado .= "+";
                echo $tracejado . $this->lf;
            }
            
            
            
            if (count($headers)) {
                /* Imprimindo os headers */
                foreach ($headers as $line) {
                    $this->line($line);
                }
                /* Fechando os headers */
                if (count($arrayTabela) > 0) {
                    $lastCell = $line;
                    $tracejado = "";
                    foreach ($lastCell as $cell) {
                        $tracejado .= "+";
                        $tracejado .= str_repeat("-", $cell[1]);
                    }
                    $tracejado .= "+";
                    echo $tracejado . $this->lf;
                }
            }
            
            
            if (count($lines) > 0) {
                /* Imprimindo todos os <tr> */
                foreach ($lines as $line) {
                    $this->line($line);
                }
                
                /* Fechando as linhas */
                $lastCell = $line;
                $tracejado = "";
                foreach ($lastCell as $cell) {
                    $tracejado .= "+";
                    $tracejado .= str_repeat("-", $cell[1]);
                }
                $tracejado .= "+";
                echo $tracejado . $this->lf;
            }
            
            
            
            if (count($footers)) {
                /* Imprimindo os footers */
                foreach ($footers as $line) {
                    $this->line($line);
                }
            }
            
            
            /* Fechando a tabela */
            if (count($arrayTabela) > 0) {
                $lastCell = $arrayTabela[count($arrayTabela) - 1];
                $tracejado = "";
                foreach ($lastCell as $cell) {
                    $tracejado .= "+";
                    $tracejado .= str_repeat("-", $cell[1]);
                }
                $tracejado .= "+";
                echo $tracejado . $this->lf;
            }
            
            
        }
    }
    
    
    /** 
     * Metodos privados
     */
    
    
}