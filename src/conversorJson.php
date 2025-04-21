<?php

function converterTarefas($tarefas): void {

    $remover = '- [] ';

    foreach ($tarefas as $indice => $tarefa) {
        $tarefas[$indice] = str_replace($remover, "", $tarefa);
    }

    $tarefasJson = json_encode($tarefas);
    file_put_contents(__DIR__ . '/tarefas.json', $tarefasJson);
}