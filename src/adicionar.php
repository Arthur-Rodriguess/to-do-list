<?php

$tarefa = trim(htmlspecialchars($_POST['tarefa']));

if ($tarefa === '') {
    header("Location: ../index.php?erro=1");
    exit;
}

$caminho = '../tarefas.json';

$tarefasJson = file_exists($caminho) ? file_get_contents($caminho) : '[]';

$tarefasArray = json_decode($tarefasJson, true);

$tarefasArray[] = [
    'texto' => $tarefa,
    'concluida' => 0
];

$ultimoId = count($tarefasArray) - 1;

$tarefasJson = json_encode($tarefasArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

file_put_contents($caminho, $tarefasJson);


header("Location: ../index.php?nova=$ultimoId");
exit;