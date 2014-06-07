<?php

/**
 * This file is part of symforium
 *
 * (c) Aaron Scherer <aequasi@gmail.com>
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE
 */

namespace Symforium\Plugin\CmsPlugin\Listener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symforium\Plugin\CmsPlugin\Entity\Page;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class CmsRouteListener extends RouterListener
{
    /**
     * @var RouteCollection
     */
    protected $routes;

    /**
     * @var Page[] $pages
     */
    protected $pages;

    /**
     * @var bool $baseRoute
     */
    protected $baseRoute = false;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->routes = new RouteCollection();
        parent::__construct(
            new UrlMatcher($this->routes, new RequestContext())
        );

        $this->pages = $this->fetchPages($entityManager);

        $this->loadRoutes();
    }

    /**
     * @param EntityManager $entityManager
     *
     * @return array|\Symforium\Plugin\CmsPlugin\Entity\Page[]
     */
    private function fetchPages(EntityManager $entityManager)
    {
        $repo = $entityManager->getRepository('SymforiumCmsPlugin:Page');

        return $repo->findAll();
    }

    /**
     * Loads routes
     */
    protected function loadRoutes()
    {
        foreach ($this->pages as $page) {
            $route = new Route(
                $page->getUrl(),
                [
                    '_controller' => 'SymforiumCmsPlugin:Frontend:index',
                    'page_id'     => $page->getId()
                ],
                []
            );
            $routeName = 'symforium_cmsplugin_page_'.$page->getSlug();
            $this->routes->add($routeName, $route);
            $this->baseRoute = $this->baseRoute ? true : $page->getUrl() === '/';
        }
    }

    /**
     * {@inheritDoc}
     *
     * @todo Change /manage/cms to the cms route
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($this->isUrlAllowed($event->getRequest()->getPathInfo())) {
            return true;
        }

        if (!$this->baseRoute) {
            throw new RouteNotFoundException(
                sprintf(
                    'There was no page found for "/". Please create a page with a url as "/" in the <a href="%s%s">CMS admin</a>.',
                    $event->getRequest()->getSchemeAndHttpHost(),
                    '/manage/cms'
                )
            );
        }

        try {
            parent::onKernelRequest($event);
        } catch(NotFoundHttpException $e) {
        }
    }

    private function isUrlAllowed($url)
    {
        $allowed = ['/_', '/manage', '/login', '/logout'];
        foreach ($allowed as $path) {
            if (strpos($url, $path) === 0) {
                return true;
            }
        }

        return false;
    }
    //*/
}
 