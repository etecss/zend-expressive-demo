<?php

namespace App\Action\News;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Doctrine\ORM\EntityManager;
use App\Entity\News;
use App\Form\NewsForm;

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
        try {
            $form = new NewsForm();
            if ($request->getMethod() === 'POST') {

                $form->setData($request->getParsedBody());
                if (!$form->isValid()) {
                    echo '<pre>';
                    var_dump($form);
                    echo '</pre>';
                    $form->setAttribute('action', '/news/add');
                    $form->get('submit')->setAttribute('value', 'Create');
                    $data['newsForm'] = $form;
                    return new HtmlResponse($this->template->render('app::news-edit', $data));
                }
                $newsData = $form->getData();
                $news = new News($newsData['title'], $newsData['content']);
                $this->entityManager->persist($news);
                $this->entityManager->flush();
                return new RedirectResponse($this->router->generateUri('news'));
            }
            $form->setAttribute('action', '/news/add');
            $data['newsForm'] = $form;
        } catch (\Exception $e) {

            return $next($request, $response->withStatus(500), 'Unknown error');
        }
        return new HtmlResponse($this->template->render('app::news-edit', $data));
    }
}
