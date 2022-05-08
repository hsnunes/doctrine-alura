<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;

require __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Verificar os LOGS dos sql que rodaram no codigo
$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);


$classAluno = Aluno::class;
$dql = "SELECT a, t, c FROM $classAluno a JOIN a.telefones t JOIN a.cursos c";
$query = $entityManager->createQuery($dql);

// Pegar o Repositorio de Alunos com o EntityManager
// $alunosRepository = $entityManager->getRepository(Aluno::class);

/** @var Aluno[] $aluno */
//$alunos = $alunosRepository->findAll();

$alunos = $query->getResult();

foreach ($alunos as $aluno) {

    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone) {
            return $telefone->getNumero();
        })
        ->toArray();

    //echo "Telefones: " . implode(", ", $telefones);exit;
    // Pegar os Telefones deste aluno
    // $telefones = $aluno
    //     ->getTelefones()
    //     ->map(function(Telefone $telefone) {
    //         return $telefone->getNumero();
    //     })
    //     ->toArray();
        // var_dump($telefones);exit;

        // Dados do aluno
    echo "ID: {$aluno->getId()}\n";
    echo "Nome: {$aluno->getNome()}\n";
    echo "Telefone(s): " . implode(", ", $telefones);
    echo "\n";

    // Pegar os Cursos do aluno
    $cursos = $aluno->getCursos();
    foreach ($cursos as $curso) {
        echo "\tID CURSO: " . $curso->getId()."\n";
        echo "\tNOME CURSO: " . $curso->getNome()."\n";
    }
    echo "\n";
}
echo "\n";
// print_r($debugStack);

// Pegar as informaçõse que estão em array associativo debugStack->queries
foreach ($debugStack->queries as $queryInfo) {
    # pegar os SQL
    echo $queryInfo['sql']. "\n";
}
