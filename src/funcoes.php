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

// Função responsável para exibir ao usuário as tarefas
function listarTarefa(array $tarefas): void {
    // Utilizando o foreach, o array é percorrido e retorna a chave que nesse caso é o índice e o seu valor 
    foreach ($tarefas as $indice => $tarefa) {
        // E o retorno é exibido para o usuário
        echo "{$indice} {$tarefa}\n";
    }
}

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