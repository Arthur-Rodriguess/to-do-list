<?php
// Função responsável por transformar o array de tarefas em um json.
function converterTarefas($tarefas): void {
    // Neste pedaço de código, é removido a caixa de seleção de uma tarefa pendente ou completa.
    $removerPendente = '- [] ';
    $removerConcluido = '- [X] ';

    // Aqui ele percorre o array e retorna o índice e o valor dele.
    foreach ($tarefas as $indice => $tarefa) {
        /* Para cada elemento que ele percorrer será verificado se ele é pendente ou concluído, caso ele for pendente,
        ele vai buscar dentro da string e verificar se a substring '- [] ' está no ínicio da string.
        a função é comparada com 0 porque se existir a substring, a função retornará 0 e isso é considerado como false.
        */
        if (strpos($tarefa, $removerPendente) === 0) {
            $tarefas[$indice] = str_replace($removerPendente, "", $tarefa);
        } elseif (strpos($tarefa, $removerConcluido) === 0) {
            $tarefas[$indice] = str_replace($removerConcluido, "", $tarefa);
        }
    }

    // Aqui há a conversão do array em um json
    $tarefasJson = json_encode($tarefas);
    // Aqui ele coloca o json em um arquivo, que é criado aqui mesmo.
    file_put_contents(__DIR__ . '/tarefas.json', $tarefasJson);
}
