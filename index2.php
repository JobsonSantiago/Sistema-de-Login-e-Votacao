<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    <title>Votação</title>
    
</head>
<body class="bg-body-secondary">
    <div class="container text-center bg-body-secondary">
        <div class="row">
            <div class="col-1">
              &nbsp
            </div>
            <div class="col bg-success">
                <nav class="navbar bg-success navbar-expand-lg" data-bs-theme="dark">
                    <div class="container-fluid">
                        <a class ="navbar-brand" href="#">VOTAÇÃO</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a class="nav-link active" aria-current="page" href="index.php">Cadastrar</a>
                                <a class="nav-link active" aria-current="page" href=""></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-1">
                &nbsp
            </div>
        </div>
        <div class="row">
            <div class="col-1">
              &nbsp
            </div>
            <div class="col bg-white">
              &nbsp
            </div>
            <div class="col-1">
              &nbsp
            </div>
        </div>
        <div class ="row">
            <div class = "col-1">
                &nbsp
            </div>
            <div class ="col bg-white">
                <p class ="text-start fs-5"> <b> <center> <h3>Qual seu Voto? </h3></center></b> </p>
                <p>
                <form method = "POST" action="">
                <input type=radio name="op1" value="1"> Opção 1
                <input type=radio name="op2" value="2"> Opção 2
                <input type=radio name="op3" value="3"> Opção 3
                <br><br>
                <input type=submit name="Votar" value="Votar"  class="btn btn-outline-success">
                <input type="submit" name="Apagar" value="Limpar votos"  class="btn btn-outline-danger">
                <br><br>

                <?php
                $resulta = 0;
                $resultb = 0;
                $resultc = 0;

                // lendo os valores de votos no arquivo.txt
                $filehandle = fopen("votos.txt", "r");
                if ($filehandle !== false) {
                    $filecontent = fread($filehandle, filesize("votos.txt"));
                    fclose($filehandle);

                    //lendo o conteúdo do arquivo "votos.txt" e separando os valores de votos para cada variável.
                    $votos = explode(",", $filecontent);
                    $resulta = isset($votos[0]) ? intval($votos[0]) : 0;
                    $resultb = isset($votos[1]) ? intval($votos[1]) : 0;
                    $resultc = isset($votos[2]) ? intval($votos[2]) : 0;
                } else {
                   
                }

                if ($_SERVER["REQUEST_METHOD"] === "POST") {

                    // Atualizando os valores de votos após um envio
                    if (isset($_POST["op1"])) {
                        $resulta++;
                    }
                    if (isset($_POST["op2"])) {
                        $resultb++;
                    }
                    if (isset($_POST["op3"])) {
                        $resultc++;
                    }

                    // Escrevendo os novos valores de votos no arquivo
                    $result = $resulta . "," . $resultb . "," . $resultc;

                    $filehandle = fopen("votos.txt", "w");
                    if ($filehandle !== false) {
                        fwrite($filehandle, $result);
                        fclose($filehandle);
                    } else {
                        // tratamento de erro ao abrir o arquivo para escrita
                    }
                }
                
                //Comando que abre o arquivo txt e apaga a quantidade de votos
                if (isset($_POST["Apagar"])) {
                    $file = fopen("votos.txt", "w");
                    fwrite($file, "0,0,0");
                    fclose($file);

                    header("Location: ".$_SERVER["PHP_SELF"]);
                }

                //Apresentação dos resultados

                echo "<b>Resultados</b>";
                echo "<br>Opção 1: " . $resulta;
                echo "<br>Opção 2: " . $resultb;
                echo "<br>Opção 3: " . $resultc;

                ?>

                </form>
            </div>
            <div class="col-1">
                    &nbsp
            </div>
        </div>
    </div>
</body>
</html>