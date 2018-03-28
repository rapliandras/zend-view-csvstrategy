<?php

/*
 * LegoW\Zend-View-CsvStrategy (https://github.com/adamturcsan/zend-view-csvstrategy)
 *
 * @copyright Copyright (c) 2014-2016 Legow Hosting Kft. (http://www.legow.hu)
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace LegoW\View\Strategy;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\ViewEvent;
use LegoW\View\Model\CsvModel;

/**
 * Description of CsvStrategy
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvStrategy extends AbstractListenerAggregate
{
    protected $charset = 'UTF-16LE';

    /**
     *
     * @var RendererInterface
     */
    protected $renderer = null;

    protected $defaultRenderer = null;

    public function __construct(RendererInterface $renderer, RendererInterface $defaultRenderer)
    {
        $this->renderer = $renderer;
        $this->defaultRenderer = $defaultRenderer;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            ViewEvent::EVENT_RENDERER,
                [$this, 'selectRenderer'],
            $priority
        );
        $this->listeners[] = $events->attach(
            ViewEvent::EVENT_RESPONSE,
                [$this, 'injectResponse'],
            $priority
        );
    }


    public function selectRenderer(ViewEvent $e)
    {
        return ($e->getModel() instanceof CsvModel) ? $this->renderer : null;
    }

    /**
     * Inject the response with the JSON payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();


        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        $result = $e->getResult();
        if (!is_string($result)) {
            // We don't have a string, and thus, no CSV
            return;
        }

        // Populate response
        $response = $e->getResponse();
        $response->setContent($result);
        $headers = $response->getHeaders();

        $contentType = 'text/csv; charset=' . $this->charset;
        $headers->addHeaderLine('content-type', $contentType);

        /* @var $model CsvModel */
        $model = $e->getModel();
        if ($model->getFileName()) {
            $headers->addHeaderLine('Content-Disposition: inline; filename="' . $model->getFileName() . '"');
        }
    }
}
