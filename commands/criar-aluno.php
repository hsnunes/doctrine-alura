<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';

// Chamar o EntityManager
$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Criar uma instancia do aluno para persistir
$aluno = new Aluno();
// $aluno->setNome('Hilder Nunes');

// $argv recebe um argumento pela linha de comando
$aluno->setNome($argv[1]);

// Pegar o(s) telefones do Aluno, passados por argumentos
// Na linha de comando
for ($i = 2; $i < $argc; $i++) {
    $numeroTelefone = $argv[$i];
    $telefone = new Telefone();
    $telefone->setNumero($numeroTelefone);

    // Fazer com que o Doctrine observe esta entidade
    $entityManager->persist($telefone);

    $aluno->addTelefone($telefone);
}

// Para fazer os procedimentos no banco
$entityManager->flush();