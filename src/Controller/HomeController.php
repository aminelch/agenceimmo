<?php 

namespace App\Controller ;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment; 
class HomeController { 

    private $twig; 

    public function __construct(Environment $twig)
    {
     
        $this->twig =$twig ;
    }

    public function home():Response{

    return new Response($this->twig->render('pages/home.html.twig')); 
    //    return new Response("<h2> Bienvenue sur la home</h2>",200); 
    }

}