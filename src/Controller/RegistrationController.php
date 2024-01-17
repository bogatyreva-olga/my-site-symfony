<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use App\Repository\UserSaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", methods={"GET"})
     */
    public function showRegistration(): Response
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
        $form = $this->createForm(TaskType::class, $task);

        return $this->render('registration/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/registration", name="registration", methods={"POST"})
     */
    public function saveRegistration(Request $request, UserSaveRepository $repository): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $userData = $repository->getUserData();
            $userData[] = $task;
            $repository->persistUserData($userData);

            return $this->redirectToRoute('registration');
        }

        return $this->render('registration/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
