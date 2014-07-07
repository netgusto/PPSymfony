<?php

namespace Pulpy\CoreBundle\Services\Post;

use Symfony\Component\Finder\Finder;

use Doctrine\ORM\EntityManager;

use Pulpy\CoreBundle\Services\PostFile\PostFileRepositoryService,
    Pulpy\CoreBundle\Entity\AbstractPost,
    Pulpy\CoreBundle\Entity\Post;

class PostRepository {

    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function findOneById($id) {
        return $this->em->getRepository('Pulpy\CoreBundle\Entity\Post')->findOneById($id);
    }

    public function findOneBySlug($slug) {
        return $this->em->getRepository('Pulpy\CoreBundle\Entity\Post')->findOneBySlug($slug);
    }

    public function qb_findAllPublished() {
        return $this->em->createQueryBuilder()
            ->select('p')
            ->from('Pulpy\CoreBundle\Entity\Post', 'p')
            ->add('where', 'p.status=:status')->setParameter('status', 'publish');
    }

    public function findAll() {
        return $this->qb_findAllPublished()
            ->add('orderBy', 'p.date DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllAtPage($page, $perpage) {
        $qb = $this->qb_findAllPublished()
            ->add('orderBy', 'p.date DESC');

        $start = ($page - 1) * $perpage;
        $qb->setFirstResult($start);
        $qb->setMaxResults($perpage);

        return $qb->getQuery()->getResult();
    }

    public function count() {
        $qb = $this->qb_findAllPublished();
        return intval($qb->select('COUNT(p)')
            ->getQuery()
            ->getSingleScalarResult());
    }

    public function deleteAll() {
        $q = $this->em->createQuery('DELETE FROM Pulpy\CoreBundle\Entity\Post');
        $q->execute();
    }

    public function deleteOneBySlug($slug) {
        $q = $this->em->createQuery('DELETE FROM Pulpy\CoreBundle\Entity\Post p where p.slug = :slug');
        $q->setParameter('slug', $slug);
        $q->execute();
    }
    
    public function findPrevious(Post $post) {
        
        $qb = $this->em->createQueryBuilder()
            ->select('p')
            ->from('Pulpy\CoreBundle\Entity\Post', 'p')
            ->add('where', 'p.status = :status AND p.date < :date OR (p.date = :date AND (p.title < :title OR (p.title = :title AND p.slug < :slug)))')
                ->setParameter('status', 'publish')
                ->setParameter('date', $post->getDate())
                ->setParameter('title', $post->getTitle())
                ->setParameter('slug', $post->getSlug())
            ->add('orderBy', 'p.date DESC')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getResult();
        if(!$result) {
            return null;
        }

        return $result[0];
    }

    public function findNext(Post $post) {
        $qb = $this->em->createQueryBuilder()
            ->select('p')
            ->from('Pulpy\CoreBundle\Entity\Post', 'p')
            ->add('where', 'p.status = :status AND p.date > :date OR (p.date = :date AND (p.title > :title OR (p.title = :title AND p.slug > :slug)))')
                ->setParameter('status', 'publish')
                ->setParameter('title', $post->getTitle())
                ->setParameter('date', $post->getDate())
                ->setParameter('slug', $post->getSlug())
            ->add('orderBy', 'p.date ASC')
            ->setMaxResults(1);

        $result = $qb->getQuery()->getResult();
        if(!$result) {
            return null;
        }

        return $result[0];
    }
}