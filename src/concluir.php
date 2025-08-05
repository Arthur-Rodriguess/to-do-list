<?php

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $arquivo = '../tarefas.json';

    if(file_exists($arquivo)) {
        $tarefasJson = file_get_contents($arquivo);
        $tarefasArray = json_decode($tarefasJson, true);
        
        if(isset($tarefasArray[$id])) {
            $tarefasArray[$id]['concluida'] = true;
            file_put_contents($arquivo, json_encode($tarefasArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}

if(isset($_GET['true'])) {
    $true = (bool) $_GET['true'];
    $arquivo = '../tarefas.json';

    if(file_exists($arquivo)) {
        $tarefasJson = file_get_contents($arquivo);
        $tarefasArray = json_decode($tarefasJson, true);

        if($true === true) {
            foreach($tarefasArray as $index => $tarefa) {
                $tarefasArray[$index]['concluida'] = true;
            }
            file_put_contents($arquivo, json_encode($tarefasArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}
header('Location: ../index.php');
exit;