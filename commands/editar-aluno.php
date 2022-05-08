<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Quando for pegar apenas 1 entidade, pode usar o finde do entityManager
// $alunoRepository = $entityManager->getRepository(Aluno::class);

$id = $argv[1];
$novoNome = $argv[2];

// Quando for pegar apenas 1 entidade, pode usar o finde do
// EntityManager
// $aluno = $alunoRepository->find($id);

// Porém, precisa passar a classe da entidade e o id
$aluno = $entityManager->find(Aluno::class, $id);
$aluno->setNome($novoNome);

// Não será preciso criar o Persiste, pois o $alunoRepository,
// Ja fez a observação

$entityManager->flush();
