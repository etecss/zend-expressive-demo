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

class AddAction
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
        $data['news'] = $this->entityManager->getRepository(News::class)->findAll();
        /*echo '<pre>';
        var_dump($data['news']);
        echo '</pre>';*/

        return new HtmlResponse($this->template->render('app::news', $data));
    }
}
