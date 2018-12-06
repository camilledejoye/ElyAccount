<?php

namespace App\Controller;

use App\Form\RegisterClientType;
use ElyAccount\Client\Command\RegisterAClientCommand;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ClientController extends AbstractController
{
    /**
     * @Route("/client/register", name="client_register")
     */
    public function register(Request $request, MessageBusInterface $commandBus, LoggerInterface $logger)
    {
        $form = $this->createForm(RegisterClientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var RegisterAClientCommand $command */
            $command = $form->getData();

            try {
                $commandBus->dispatch($command);

                $this->addFlash('success', sprintf('Welcome %s', $command->clientName()));

                return $this->redirectToRoute('home');
            } catch (Throwable $exception) {
                $logger->error($exception);

                $this->addFlash('danger', 'An error occured, the client has not been regsitered');
            }
        }

        return $this->render('client/register_client.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
