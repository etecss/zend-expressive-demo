<?php

namespace App\Service;

use App\Exception\NewsNotFoundException;
use App\Mapper\NewsMapperInterface;
use App\Model\NewsInterface;

class NewsService implements NewsServiceInterface
{
    /**
     * @var NewsMapperInterface
     */
    protected $newsMapper;

    /**
     * @param NewsMapperInterface $newsMapper
     */
    public function __construct(NewsMapperInterface $newsMapper)
    {
        $this->newsMapper = $newsMapper;
    }

    /**
     * @param int $id
     * @return NewsInterface
     * @throws NewsNotFoundException if news with provided id doesn't exist
     */
    public function findById($id)
    {
        $news = $this->newsMapper->find($id);
        if (!$news) {
            throw new NewsNotFoundException('Couldn\'t find news with id: ' . $id);
        }

        return $news;
    }

    /**
     * @return NewsInterface[]
     */
    public function findAll()
    {
        return $this->newsMapper->findAll();
    }

    /**
     * @param NewsInterface $news
     * @return NewsInterface
     */
    public function save(NewsInterface $news)
    {
        return $this->newsMapper->save($news);
    }

    /**
     * @param NewsInterface $news
     * @return bool
     */
    public function delete(NewsInterface $news)
    {
        return $this->newsMapper->delete($news);
    }

    /**
     * @return array
     */
    public function findAllForView()
    {
        $result = [];
        $newss = $this->findAll();
        foreach ($newss as $news) {
            $result[] = $news->toArray();
        }
        return $result;
    }
}

