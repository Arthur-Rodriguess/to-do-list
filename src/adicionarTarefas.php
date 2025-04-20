<?php

// Função responsável por armazenar as tarefas que o usuário informar em um array
function adicionarTarefa(): array {
    // O usuário informa quantas tarefas ele quer adicionar
    echo "Digite a quantidade de tarefas que você quer adicionar: ";
    $quantidadeTarefas = (int) fgets(STDIN);
    // é declarada a lista de tarefas
    $tarefas = [];

// Loop que de acordo com a quantidade de tarefas informadas pelo usuário, repete o pedido de digitar o nome da tarefa
    for ($i = 0; $i < $quantidadeTarefas; $i++) {
        echo "Digite o nome da tarefa: ";
        $tarefas[] = '- [] ' . trim(fgets(STDIN));
    }

    return $tarefas;
}