<?php

// Função responsável por remover um item do array de acordo com o índice ou nome indicado pelo usuário
function removerTarefa(array &$tarefas): void {
    // Exibe ao usuário as tarefas existentes e seus índices
    listarTarefa($tarefas);
    // Pergunta ao usuário se ele quer remover a tarefa indicando o índice ou o nome da tarefa
    echo "Você quer remover as tarefas pelo índice ou pelo nome da tarefa?\n";
    echo "1 - Remover pelo índice\n";
    echo "2 - Remover pelo nome\n";
    $opcao = fgets(STDIN);
    switch ($opcao) {
        case '1':
            // Se ele escolher a opção 1, ele deverá informar o índice da tarefa
            echo "Selecione o número correspondente a tarefa que você quer remover: ";
            $tarefaIndice = (int) fgets(STDIN);
            // Se esse índice corresponder a alguma tarefa no array tarefas irá remover de acordo com o índice caso contrário, o usuário será informado que o índice é inválido
            if (isset($tarefas[$tarefaIndice])) {
                unset($tarefas[$tarefasIndice]);
            } else {
                echo "Índice inválido, nenhuma tarefa foi removida.\n";
            }

        case '2':
            // Se ele escolher a opção 2, ele deverá informar o nome da tarefa
            echo "Selecione o nome correspondente a tarefa que você quer remover (escreva corretamente): ";
            $tarefaNome = trim(fgets(STDIN));
            // Aqui são declaradas duas variáveis pois a tarefa pode estar pendente ou concluida
            $tarefaNomeFormatado = '- [] ' . $tarefaNome;
            $tarefaNomeConcluida = '- [X]' . $tarefaNome;
            // Aqui para meios de verificação atribuímos o índice do nome informado, supondo que seja uma tarefa pendente
            $tarefaIndice = array_search($tarefaNomeFormatado, $tarefas);
            // Caso o índice não seja encontrado retornará false, isso significa que o índice na verdade se refere a uma tarefa concluida
            if ($tarefaIndice === false) {
                $tarefaIndice = array_search($tarefaNomeConcluida, $tarefas);
            }
            // Caso o índice for encontrado no array tarefas, será removido o elemento nessa posição, se não for encontrado, quer dizer que o nome informado pelo usuário não existe, e será exibida uma mensagem
            if ($tarefaIndice !== false) {
                unset($tarefas[$tarefaIndice]);
                echo "Tarefa Removida com sucesso!\n";
            } else {
                echo "Não foi possível remover a tarefa, pois ela não existe.\n";
            }
            // Após a remoção dos elementos, os índices do array tarefas são reorganizados para ficarem de maneira crescente, assim preservando o entendimento na exibição do array ao usuário 
            $tarefas = array_values($tarefas);
    }
}