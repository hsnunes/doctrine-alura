<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$id = $argv[1];

// Com esta linha, ganho performance, pois não será feita consulta (query)
// no banco, passando apenas a referencia do ID
$aluno = $entityManager->getReference(Aluno::class, $id);

// Com esta linha, será feito um select, ou seja, 2 consultas para remover
// $aluno = $entityManager->find(Aluno::class, $id);

// Isto pode ser feito!
// if ( is_null($aluno) ) {
//     echo 'ALuno Inexistente';
// }

$entityManager->remove($aluno);
$entityManager->flush();