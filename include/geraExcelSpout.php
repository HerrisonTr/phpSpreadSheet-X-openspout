<?php

$inicio = microtime(true);

set_time_limit(0);
ini_set("pcre.backtrack_limit", '500000000');
ini_set('memory_limit', '-1');

session_start();

require "../vendor/autoload.php";

use OpenSpout\Common\Entity\Cell;
use OpenSpout\Common\Entity\Row;

$linhas = (int) $_POST['linhas'];
$colunas = (int) $_POST['colunas'];

if ($linhas == 0 || $colunas == 0) {
    die("Preencha todos os dados corretamente");
}

$nomeArquivo = date("dmYHis") . ".xlsx";
$escrever = new \OpenSpout\Writer\XLSX\Writer();
$escrever->openToBrowser($nomeArquivo);

for ($linha = 1; $linha <= $linhas; $linha++) {
    $letraColuna = 'A';

    $celulas = [];
    for ($coluna = 1; $coluna <= $colunas; $coluna++) {
        $coordenada = $letraColuna . $linha;
        $celulas[] =  $coordenada;
        $letraColuna++;
    }

    $novaLinha = Row::fromValues($celulas);
    $escrever->addRow($novaLinha);
}


$escrever->close();

$fim = microtime(true);
$tempoDeExecucao = $fim - $inicio;

$tempoDeExecucaoFormatado = gmdate("H:i:s", $tempoDeExecucao);

$_SESSION['openspout'][] = [
    'linhas' => $linhas,
    'colunas' => $colunas,
    'tempoExecucao' => $tempoDeExecucaoFormatado,
];
