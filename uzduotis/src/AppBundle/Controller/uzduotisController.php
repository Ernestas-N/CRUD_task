<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class uzduotisController extends Controller
{
    /**
     * @Route("/uzd", name="uzduotis_sarasas")
     */
    public function listAction()
    {
        // replace this example code with whatever you need
        return $this->render('uzduot/index.html.twig');
    }

    /**
     * @Route("/uzduot/create", name="uzduot_create")
     */
    public function createAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('uzduot/create.html.twig');
    }

    /**
     * @Route("/uzduot/edit/{id}", name="uzduot_edit")
     */
    public function editAction($id, Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('uzduot/edit.html.twig');
    }

    /**
     * @Route("/uzduot/details/{id}", name="uzduot_details")
     */
    public function detailsAction($id)
    {
        // replace this example code with whatever you need
        return $this->render('uzduot/details.html.twig');
    }


}
