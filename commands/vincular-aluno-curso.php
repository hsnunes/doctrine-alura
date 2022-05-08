<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Comando para vincular Aluno ao Curso
// php vincular-aluno-curso.php 1(id_aluno) 1(id_curso)

// Pegar os Ids do Aurso e Aluno, para busca da entidade
$idCurso = $argv[1];
$idAluno = $argv[2];

// Pegar as entidades pelos Ids, para fazer os vinculos
/** @var Curso $curso */
$curso = $entityManager->find(Curso::class, $idCurso);
/** @var Aluno $aluno */
$aluno = $entityManager->find(Aluno::class, $idAluno);

// Fazer os vinculos, de ambas as partes, o resultado será
// O mesmo;
$curso->addAluno($aluno);
// $aluno->addCurso($curso);

// Como o Classe foi buscada pelo Entity, ja está sendo observada
// Então não será necessário fazer o persist();

$entityManager->flush();
