<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Aluno;
use Doctrine\ORM\EntityRepository;

class AlunoRepository extends EntityRepository
{
    public function buscaCursosPorAluno()
    {
        // $classAluno = Aluno::class;
        // $entityManager = $this->getEntityManager();
        // $dql = "SELECT a, t, c FROM $classAluno a JOIN a.telefones t JOIN a.cursos c";
        // $query = $entityManager->createQuery($dql);

        /** Verificando uma condição de exibir os cursos */
        /**
         * buscaCursosPorAluno(bool $exibeCursos)
         * $builder = $this->createQueryBuilder('a')
         *      ->join('a.telefones', 't')
         *      ->addSelect('t');
         * if ($exibeCursos) {
         *      $builder->join('a.cursos', 'c')
         *          ->addSelect('c');
         * }
         * $query = $builder->getQuery();
         */


        /** Utiliando Um QueryBuild */
        $query = $this->createQueryBuilder('a')
            ->join('a.telefones', 't')
            ->join('a.cursos', 'c')
            ->addSelect('t')
            ->addSelect('c')
            ->getQuery();

        return $query->getResult();
    }
}