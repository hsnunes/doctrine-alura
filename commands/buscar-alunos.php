<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Criar um repositorio de alunos - grupo
// $alunoRepository = $entityManager->getRepository(Aluno::class);

// O entityManager consigo mandar para o banco Alunos
// Com o entityRepository consigo pegar os alunos para aplicação

/** @var Aluno[] $alunoList */
// $alunoList = $alunoRepository->findAll();

/** UTILIZANDO DQL */

$dql = "SELECT aluno FROM Alura\\Doctrine\\Entity\\Aluno aluno WHERE aluno.id = 2 OR aluno.nome = 'Bruno Nunes' ORDER BY aluno.nome";
$query = $entityManager->createQuery($dql);
$alunoList = $query->getResult();


foreach ($alunoList as $aluno) {
    echo "Id: {$aluno->getId()}\n Nome: {$aluno->getNome()}\n\n";

    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone) {
            return $telefone->getNumero();
        })
        ->toArray();

    echo "Telefones: " . implode(", ", $telefones);
    echo "\n";

}

// Exibir apenas 1 aluno
// $alunoX = $alunoRepository->find(4);
// echo $alunoX->getNome().'\n\n';

// Buscar por Nome, retorna um array com o aluno
// $alunoY = $alunoRepository->findBy(['nome' => 'Eloa Nunes']);
// retorna um objeto com o aluno
// $alunoY = $alunoRepository->findOneBy(['nome' => 'Eloa Nunes']);
// var_dump($alunoY);