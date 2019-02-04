<?php
// src/Controller/MessageController.php
namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Knp\Component\Pager\PaginatorInterface;


class MessageController extends AbstractController
{

    /**
     * @Route("/messages/")
     */
    public function new(MessageRepository $repository, Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        // new message object
        $message = new Message();

        $form = $this->renderForm($message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$message` variable has also been updated
            $message = $form->getData();

            // ... perform some action, such as saving the message to the database
            // for example, if Message is a Doctrine entity, save it!
             $em->persist($message);
             $em->flush();

            $this->addFlash(
                'notice',
                'Your message has been added!'
            );

            unset($message);
            unset($form);
            $message = new Message();
            $form = $this->renderForm($message);
        }

        return $this->render('messages/new.html.twig', [
            'form' => $form->createView(),
            'pagination' => $this->paginator($repository, $request, $paginator),
        ]);

    }

    public function renderForm($message)
    {
        $form = $this->createFormBuilder($message)

            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Message'])
            ->getForm();

        return $form;
    }


    public function paginator(MessageRepository $repository, Request $request, PaginatorInterface $paginator)
    {

        $q = $request->query->get('q');
        $queryBuilder = $repository->getWithSearchQueryBuilder($q);

        return $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

    }

}

