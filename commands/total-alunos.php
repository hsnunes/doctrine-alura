<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// $repository = $entityManager->getRepository(Aluno::class);
// $alunoList = $repository->findAll();

$classAluno = Aluno::class;
$dql = "SELECT COUNT(a) FROM $classAluno a";
$query = $entityManager->createQuery($dql);

// Retorna um array de results
// $totalAlunos = $query->getScalarResult();


/** Para pegar uma média de possiveis idades de alunos */
// $dql "SELECT AVG(a.idades) FROM $classeAluno a"
// $media = $query->getSingleScalarResult();


// Retorna apenas o resultado simples
$totalAlunos = $query->getSingleScalarResult();

echo "Total de Alunos: ". $totalAlunos;