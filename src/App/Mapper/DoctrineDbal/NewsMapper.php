<?php

namespace App\Mapper\DoctrineDbal;

use App\Mapper\NewsMapperInterface;
use App\Model\News;

class NewsMapper extends AbstractMapper implements NewsMapperInterface
{
    /**
     * @var string $tableName
     */
    protected $tableName = 'news';

    /**
     * @param array $newsRow
     * @return \App\Entity\NewsInterface
     */
    public function createEntity(array $newsRow)
    {
        $newsEntity = new News(
            $newsRow['newsname'],
            $newsRow['email']
        );
        $newsEntity->setId($newsRow['id']);

        return $newsEntity;
    }
}

