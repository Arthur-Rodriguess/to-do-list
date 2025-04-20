<?php

// Função responsável por marcar um "X" nas tarefas concluidas
function concluirTarefa(array &$tarefas): void {
    // É exibido para o usuário as tarefas existentes
    listarTarefa($tarefas);
    // O usuário escolhe entre concluir a tarefa informando o índice ou o nome
    echo "Você quer concluir as tarefas pelo índice ou pelo nome da tarefa?\n";
    echo "1 - Concluir pelo índice\n";
    echo "2 - Concluir pelo nome\n";
    $opcao = fgets(STDIN);
    
    switch ($opcao) {
        case '1':
            // Se ele escolher a opção 1, ele terá que informar o índice da tarefa que ele concluiu
            echo "Selecione o número correpondente a tarefa que você concluiu: ";
            $tarefaIndice = (int) fgets(STDIN);
            // Se o índice informado existir no array, será buscado o local no elemento indicado que possua '[]' e substituirá por '[X]'
            if (isset($tarefas[$tarefaIndice])) {
                $tarefas[$tarefaIndice] = str_replace('[]', '[X]', $tarefas[$tarefaIndice]);
                echo "Tarefa concluída com sucesso!\n";
            } else {
                echo "Índice inválido, nenhuma tarefa foi concluida.\n";
            }
        case '2':
            // Se ele escolher a opção 2, ele terá que informar o nome da tarefa que ele concluiu
            echo "Informe o nome correspondente a tarefa que você concluiu (escreva corretamente): ";
            $tarefaNome = trim(fgets(STDIN));
            // Aqui é adicionado uma string para ficar igual aos elementos do array, assim tornando a busca pelo elemento possível
            $tarefaNomeFormatado = '- [] ' . $tarefaNome;
            // Aqui é buscado o índice que se encontra o valor contido na variável $tarefaNomeFormatado
            $tarefaIndice = array_search($tarefaNomeFormatado, $tarefas);
            // Se o elemento existir, a função array_search() retornará o índice, caso contrário ele retornará false
            if ($tarefaIndice !== false) {
                $tarefas[$tarefaIndice] = str_replace('[]', '[X]', $tarefas[$tarefaIndice]);
                echo "Tarefa concluída com sucesso!\n";
            } else {
                echo "Nome inválido, nenhuma tarefa foi concluida.\n";
            }
    }
}