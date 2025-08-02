<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; }
    </style>
</head>
<body>
    <h1>Minha lista de tarefas</h1>
    <form action="src/adicionar.php" method="post" autocomplete="off">
        <input type="text" name="tarefa" placeholder="Digite uma nova tarefa">
        <button type="submit">Adicionar</button>
    </form>

    <br>

    <h2>Tarefas:</h2>
    <ul>
    <?php
    if(file_exists('tarefas.json'))
    {
        $tarefas = json_decode(file_get_contents('tarefas.json'), true);
    }

    if(!empty($tarefas)) {    
        foreach($tarefas as $index => $tarefa) {
            $texto = htmlspecialchars($tarefa['texto']);
            $concluida = $tarefa['concluida'] ? '✅' : '';
            echo "<li>$texto $concluida
                    <a href='src/concluir.php?id=$index'>[Concluir]</a>
                    <a href='src/excluir.php?id=$index'>[Excluir]</a>
                </li>";
        }
    } else {
        echo "<p style='color: red;'>Não há nenhuma tarefa adicionada</p>";
    }
    ?>
    </ul>
</body>
</html>