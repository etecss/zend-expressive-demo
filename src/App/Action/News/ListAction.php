<?php

namespace App\Action\News;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Doctrine\ORM\EntityManager;
use App\Entity\News;

class ListAction
{
    private $router;

    private $template;

    public function __construct(Router\RouterInterface $router, Template\TemplateRendererInterface $template = null, EntityManager $entityManager = null)
    {
        $this->router   = $router;
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        $data = [];
        $data['title'] = "News";
        //var_dump($this->entityManager->find(News::class, 1));exit;
        //var_dump($this->entityManager->getRepository(News::class));
        $data['news'] = $this->entityManager->getRepository(News::class)->findAll();

        return new HtmlResponse($this->template->render('app::news', $data));
    }
}
