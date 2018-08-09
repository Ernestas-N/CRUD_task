<?php

namespace AppBundle\Controller;

use AppBundle\Entity\uzduotis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class uzduotisController extends Controller
{
    /**
     * @Route("/", name="uzduotis_sarasas")
     */
    public function listAction()
    {
        $uzd = $this->getDoctrine()
            ->getRepository('AppBundle:uzduotis')
            ->findAll();
        // replace this example code with whatever you need
        return $this->render('uzduot/index.html.twig', array ('uzd'=>$uzd));
    }

    /**
     * @Route("/uzduot/create", name="uzduot_create")
     */
    public function createAction(Request $request)
    {
        $uzduot = new  Uzduotis;

        $form = $this->createFormBuilder($uzduot)
            ->add('name', TextType::class, array('label' =>'Uzduotis','attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))
            ->add('category', TextType::class, array('label' =>'Kategorija','attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))
            ->add('description', TextareaType::class, array('label' =>'Placiau','attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))
            ->add('priority', ChoiceType::class, array('label' =>'Statusas','choices'=>array('Low'=>'Zemas', 'Normal' => 'Normalus', 'High' =>'Aukstas'), 'attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))
            ->add('due_date', DateTimeType::class, array('attr'=>array('class'=>'formcontrol', 'style'=>'margin-bottom:15px')))
            ->add('person', TextType::class, array('label' =>'Vardas','attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' =>'Sukurk uzduoti', 'attr'=>array('class'=>'btn btn-primary', 'style'=>'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $name = $form['name']->getData();
                $category = $form['category']->getData();
                $description = $form['description']->getData();
                $priority = $form['priority']->getData();
                $due_date = $form['due_date']->getData();
                $person = $form['person']->getData();

                $now = new\DateTime('now');

                $uzduot->setName($name);
                $uzduot->setCategory($category);
                $uzduot->setDescription($description);
                $uzduot->setPriority($priority);
                $uzduot->setDueDate($due_date);
                $uzduot->setPerson($person);
                $uzduot->setcreateDate($now);

                $em = $this->getDoctrine()->getManager();
                $em->persist($uzduot);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Uzduotis prideta'
                );

                return $this->redirectToRoute('uzduotis_sarasas');

        }
        // replace this example code with whatever you need
        return $this->render('uzduot/create.html.twig', array(
            'form' =>$form->createView()
        ));
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
