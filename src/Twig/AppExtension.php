<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Facade\General;



class AppExtension extends AbstractExtension
{

    private $entityManager;
    private $urlGeneratorInterface;
    private $templating;

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlGeneratorInterface, \Twig\Environment $templating)
    {

        $this->entityManager = $em;
        $this->urlGeneratorInterface = $urlGeneratorInterface;
        $this->templating = $templating;
    }


    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
            new TwigFilter('cast_to_array', [$this, 'objectFilter']),

        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getTaskStatus', [$this, 'getTaskStatus']),
            new TwigFunction('getTaskStatusAssigned', [$this, 'getTaskStatusAssigned']),
            new TwigFunction('getTaskStatusSend', [$this, 'getTaskStatusSend']),




        ];
    }



    function getTaskStatus($id, $office)
    {

        $req = General::getTaskStatus($this->entityManager, $id, $office);
        return ($req);
    }
    function getTaskStatusAssigned($id, $office)
    {

        $req = General::getTaskStatusAssigned($this->entityManager, $id, $office);
        return ($req);
    }
    function getTaskStatusSend($id, $office)
    {

        $req = General::getTaskStatusSend($this->entityManager, $id, $office);
        return ($req);
    }
}
