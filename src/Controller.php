<?php

declare(strict_types=1);

namespace Choult\Metrics;

//use Beberlei\Metrics\Collector\Collector;
use Domnikl\Statsd\Client as Collector;
use Symfony\Component\HttpFoundation\Response;

class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    private $collector;

    public function __construct(Collector $collector)
    {
        $this->collector = $collector;
    }

    public function home()
    {
        $this->collector->increment('route.home');
        return $this->render('default/index.html.twig',
            [
                'name' => 'yo'
            ]
        );
    }

    public function event(string $name)
    {
        $this->collector->increment('route.event');
        $this->collector->increment("event.{$name}");
        $start = microtime(true);
        $time = rand(0, 1000000);
        usleep($time);
        $this->collector->timing("event_timing.{$name}", microtime(true) - $start);

        return new Response('OK');
    }
}
