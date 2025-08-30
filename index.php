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
    <form action="src/adicionar.php" method="post" autocomplete="off" id="form-tarefa">
        <?php if (isset($_GET['erro'])) {
            echo "<p style='color: red; margin-bottom: 20px'>Por favor, escreve uma tarefa antes de adicionar!</p>";
        }
        ?>
        <input type="text" name="tarefa" id="inputTarefa" placeholder="Digite uma nova tarefa"> <br>
        <button type="submit">Adicionar</button>
    </form>

    <script>
        document.getElementById("form-tarefa").addEventListener("submit", function(e) {
            const tarefa = document.getElementById("inputTarefa").value.trim();
            if (tarefa === "") {
                e.preventDefault();
                alert("Você precisa escrever algo antes de adicionar!");
            }
        })
    </script>

    <br>

    <div class="tarefas" id="tarefas">
        <h2>Tarefas</h2>
        <ul>
        <?php

        function verificarConcluido($tarefas): bool
        {
            foreach($tarefas as $index => $tarefa) {
                if($tarefas[$index]['concluida'] === 0){
                    return true;
                }
            }
            return false;
        }

        $novaTarefaId = isset($_GET['nova']) ? (int) $_GET['nova'] : -1;
        $true = true;

        if(file_exists('tarefas.json'))
        {
            $tarefas = json_decode(file_get_contents('tarefas.json'), true);
        }

        if(!empty($tarefas)) {    
            foreach($tarefas as $index => $tarefa) {

                $texto = htmlspecialchars($tarefa['texto']);
                $concluida = $tarefa['concluida'] ? '✅' : '';

                $classe = ($index === $novaTarefaId) ? "class='nova'" : ""; 

                echo "<li $classe>
                        <div class='item-tarefa'>
                            <span>$texto $concluida</span>
                            <div class='botoes'>
                                <a href='src/concluir.php?id=$index' class='alterar' id='concluir'>Concluir</a>
                                <a href='src/excluir.php?id=$index' class ='alterar' id='excluir'>Excluir</a>
                            </div>
                        </div>
                    </li>";
            }

            if(count($tarefas) > 1 && verificarConcluido($tarefas)) {
                    echo "
                    <div class='alterar-tudo'>
                        <a href='src/concluir.php?true=$true' id='concluir-tudo' class='alterar-tudo-link'>Concluir Tudo</a>
                        <a href='src/excluir.php?true=$true' id='excluir-tudo' class='alterar-tudo-link'>Excluir Tudo</a>
                    </div>";
                }
        } else {
            echo "<p style='color: red;' class='sem-tarefa'>Não há nenhuma tarefa adicionada</p>";
        }
        ?>
        </ul>
    </div>
</body>
</html>