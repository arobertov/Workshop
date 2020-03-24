<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPanelController extends AbstractController
{
    /**
     * @Route("/admin",name="admin_index")
     *
     */
    public function index(){
       return $this->render('admin_panel/index.html.twig');
    }
}