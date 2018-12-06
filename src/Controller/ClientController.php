<?php

namespace App\Controller;

use App\Form\RegisterClientType;
use ElyAccount\Client\Command\RegisterAClientCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client/register", name="client_register")
     */
    public function register(Request $request)
    {
        $form = $this->createForm(RegisterClientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            /** @var RegisterAClientCommand $command */
            $command = $form->getData();

            $this->addFlash('success', sprintf('Welcome %s', $command->clientName()));
            /* return $this->redirectToRoute('home'); */
        }

        return $this->render('client/register_client.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
