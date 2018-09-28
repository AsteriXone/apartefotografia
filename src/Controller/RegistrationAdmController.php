<?php
/**
 * Created by PhpStorm.
 * User: asterixone
 * Date: 24/09/2018
 * Time: 10:14
 */

namespace App\Controller;

use App\Entity\Administrator;
use App\Form\AdministratorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationAdmController extends AbstractController
{
    /**
     * @Route("/registrar-admin", name="admin_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new Administrator();
        $form = $this->createForm(AdministratorType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // 2.5) Set register date
            $fecha = new \DateTime();
            $user->setFechaRegistro($fecha);

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/register-administrator.html.twig',
            array('form' => $form->createView())
        );
    }
}