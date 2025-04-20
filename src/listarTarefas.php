<?php

// Função responsável para exibir ao usuário as tarefas
function listarTarefa(array $tarefas): void {
    // Utilizando o foreach, o array é percorrido e retorna a chave que nesse caso é o índice e o seu valor 
    foreach ($tarefas as $indice => $tarefa) {
        // E o retorno é exibido para o usuário
        echo "{$indice} {$tarefa}\n";
    }
}