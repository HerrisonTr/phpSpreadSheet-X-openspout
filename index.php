<?php
session_start();

$openSpoutTabela = isset($_SESSION['openspout']) ? $_SESSION['openspout'] : [];
$phpSpreadSheetTabela = isset($_SESSION['phpspreadsheet']) ? $_SESSION['phpspreadsheet'] : [];

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> openspout x phpspreadsheet </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background-color: #DADBDA;
            min-width: 100vw;
            min-height: 100vh;
        }

        h1 {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>

    <main class="p-3 row">
        <div class="col-lg-6 col-s-12 p-3">
            <div class="card">
                <div class="card-header text-center">
                    <h1> Gerando excel com openspout/openspout </h1>
                </div>

                <div class="card-body">
                    <form action="include/geraExcelSpout.php" target="_blank" method="POST">
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label"> Quantidade de linhas: </label>
                            <div class="col-sm-8">
                                <input type="number" min="1" max="1000000" name="linhas" required class="form-control" placeholder="Exemplo: 10000">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label"> Quantidade de colunas: </label>
                            <div class="col-sm-8">
                                <input type="number" min="1" max="20" name="colunas" required class="form-control" placeholder="Exemplo: 20">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary"> Gerar com openspout </button>
                        </div>
                    </form>

                    <hr>

                    <div>
                        <h4> ùltimas gerações (Salvas em sessão) </h4>
                        <table class="table-responsive table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th> Linhas </th>
                                    <th> Colunas </th>
                                    <th> Total de celulas </th>
                                    <th> Tempo total </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($openSpoutTabela as $linha) {
                                ?>
                                    <tr>
                                        <td> <?= $linha['linhas'] ?> </td>
                                        <td> <?= $linha['colunas'] ?> </td>
                                        <td> <?= $linha['linhas'] * $linha['colunas'] ?> </td>
                                        <td> <?= $linha['tempoExecucao'] ?> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-s-12 p-3">
            <div class="card">
                <div class="card-header text-center">
                    <h1> Gerando excel com phpoffice/phpspreadsheet </h1>
                </div>

                <div class="card-body">
                    <form action="include/geraExcelPhpSpreadsheet.php" target="_blank" method="POST">
                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label"> Quantidade de linhas: </label>
                            <div class="col-sm-8">
                                <input type="number" min="1" max="1000000" name="linhas" required class="form-control" placeholder="Exemplo: 10000">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-4 col-form-label"> Quantidade de colunas: </label>
                            <div class="col-sm-8">
                                <input type="number" min="1" max="20" name="colunas" required class="form-control" placeholder="Exemplo: 20">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary"> Gerar com phpspreadsheet </button>
                        </div>
                    </form>

                    <hr>

                    <div>
                        <h4> ùltimas gerações (Salvas em sessão) </h4>
                        <table class="table-responsive table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th> Linhas </th>
                                    <th> Colunas </th>
                                    <th> Total de celulas </th>
                                    <th> Tempo total </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($phpSpreadSheetTabela as $linha) {
                                ?>
                                    <tr>
                                        <td> <?= $linha['linhas'] ?> </td>
                                        <td> <?= $linha['colunas'] ?> </td>
                                        <td> <?= $linha['linhas'] * $linha['colunas'] ?> </td>
                                        <td> <?= $linha['tempoExecucao'] ?> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>