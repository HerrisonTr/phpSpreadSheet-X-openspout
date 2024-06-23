<?php

$inicio = microtime(true);

set_time_limit(0);
ini_set("pcre.backtrack_limit", '500000000');
ini_set('memory_limit', '-1');

session_start();

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$linhas = (int) $_POST['linhas'];
$colunas = (int) $_POST['colunas'];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if ($linhas == 0 || $colunas == 0) {
    die("Preencha todos os dados corretamente");
}

$nomeArquivo = date("dmYHis") . "_spreadsheet.xlsx";

for ($linha = 1; $linha <= $linhas; $linha++) {
    $letraColuna = 'A';
    for ($coluna = 1; $coluna <= $colunas; $coluna++) {
        $coordenada = $letraColuna . $linha;
        $sheet->setCellValue($coordenada, $coordenada);
        $letraColuna++;
    };
}

$escrever = new Xlsx($spreadsheet);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename={$nomeArquivo}");
ob_end_clean();
$escrever->save('php://output');

$fim = microtime(true);
$tempoDeExecucao = $fim - $inicio;

$tempoDeExecucaoFormatado = gmdate("H:i:s", $tempoDeExecucao);

$_SESSION['phpspreadsheet'][] = [
    'linhas' => $linhas,
    'colunas' => $colunas,
    'tempoExecucao' => $tempoDeExecucaoFormatado,
];