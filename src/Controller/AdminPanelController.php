<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPanelController extends AbstractController
{
    /**
     * @Route("{vueRouting}",requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"},name="admin_index")
     */
    public function index(){
       return $this->render('admin_panel/index.html.twig');
    }
}