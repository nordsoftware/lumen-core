<?php namespace Nord\Lumen\Core\Infrastructure;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository as MongoDocumentRepository;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class DocumentRepository extends MongoDocumentRepository
{

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        parent::__construct($dm, $uow, $class);
    }

    /**
     * Get document by short ID
     * @param $id
     * @return object
     */
    public function findByShortId($id)
    {
        return $this->findOneBy(['shortId' => $id]);
    }

    /**
     * Get document(s) by a list of short IDs
     * @param array  $ids List of short IDs
     * @return array
     */
    public function findByShortIdList($ids)
    {
        return $this->createQueryBuilder()
            ->field('shortId')
            ->in($ids)
            ->getQuery()
            ->execute()
            ->toArray();
    }
}
