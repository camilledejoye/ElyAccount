<?php

namespace App\Controller;

use App\Form\RegisterClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/register", name="client")
     */
    public function register(Request $request)
    {
        $form = $this->createForm(RegisterClientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        }

        return $this->render('client/register_client.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
