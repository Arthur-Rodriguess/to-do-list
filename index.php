<?php
// Esta linha chama todas as funções para o arquivo principal
require __DIR__ . '/src/todasAsFuncoes.php';

echo "****************************************\n";
echo "Bem vindo ao sistema de lista de tarefas\n";
echo "****************************************\n";

do {
    echo "Por favor digite a opção correspondente ao seu desejo:\n";
    echo "[1] - adicionar tarefa\n";
    echo "[2] - listar tarefas\n";
    echo "[3] - concluir tarefa\n";
    echo "[4] - remover tarefa\n";
    echo "[0] - sair\n";
    $opcao = fgets(STDIN);

    switch ($opcao) {
        // Se a opcao for 1, o usuário irá adicionar tarefas
        case '1':
            $tarefas = array_merge($tarefas ?? [], adicionarTarefa());
            break;
        // Se a opção for 2, o usuário irá vizualizar as tarefas pendentes e concluidas
        case '2':
            if (empty($tarefas)) {
                echo "Não é possível listar tarefas, pois não há nenhuma tarefa\n";
            } else {
                listarTarefa($tarefas);
            }
            break;
        // Se a opção for 3, o usuário irá marcar quais tarefas foram concluídas
        case '3':
            if (empty($tarefas)) {
                echo "Não é possível concluir tarefas, pois não há nenhuma tarefa\n";
                break;
            } 

            do {
                concluirTarefa($tarefas);
                
                echo "Deseja concluir outra tarefa? (s/n): ";
                $resposta = strtolower(trim(fgets(STDIN)));
            } while ($resposta === "s");
            break;
        // Se a opção for 4, o usuário irá remover tarefas
        case '4':
            if (empty($tarefas)) {
                echo "Não é possível remover tarefas, pois não há nenhuma tarefa.\n";
                break;
            }

            do {
                removerTarefa($tarefas);
                
                echo "Deseja remover outra tarefa? (s/n): ";
                $resposta = strtolower(trim(fgets(STDIN)));
            } while ($resposta === "s");
            break;
        // Se a opção for 0, o programa irá terminar
        case '0':
            "Programa Encerrado";
            break;
        // Caso o usuário digite alguma entrada inválida irá aparecer esta mensagem e o programa encerrará
        default:
            echo "opção inválida";
            break;
    }
} while ($opcao != 0);
converterTarefas($tarefas);