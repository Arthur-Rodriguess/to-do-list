<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Minha Lista de Tarefas</h1>
    <form action="src/adicionar.php" method="post" autocomplete="off">
        <input type="text" name="tarefa" id="inputTarefa" placeholder="Digite uma nova tarefa"> <br>
        <button type="submit">Adicionar</button>
    </form>

    <br>

    <div class="tarefas">
        <h2>Tarefas:</h2>
        <ul>
        <?php

        $novaTarefaId = isset($_GET['nova']) ? (int) $_GET['nova'] : -1;

        if(file_exists('tarefas.json'))
        {
            $tarefas = json_decode(file_get_contents('tarefas.json'), true);
        }

        if(!empty($tarefas)) {    
            foreach($tarefas as $index => $tarefa) {

                $texto = htmlspecialchars($tarefa['texto']);
                $concluida = $tarefa['concluida'] ? '✅' : '';

                $classe = ($index === $novaTarefaId) ? "class='nova'" : ""; 

                echo "<li $classe><span>$texto $concluida</span>
                        <a href='src/concluir.php?id=$index' class='alterar' id='concluir'>Concluir</a>
                        <a href='src/excluir.php?id=$index' class ='alterar' id='excluir'>Excluir</a>
                    </li>";
            }
        } else {
            echo "<p style='color: red;'>Não há nenhuma tarefa adicionada</p>";
        }
        ?>
        </ul>
    </div>
</body>
</html>