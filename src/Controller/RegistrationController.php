<?php
/**
 * Created by PhpStorm.
 * User: asterixone
 * Date: 24/09/2018
 * Time: 10:14
 */

namespace App\Controller;

use App\Entity\GrupoColegio;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registrar", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Todo
            // Check if codigoGrupo exist in GrupoColegio Entity
            $codigoGrupo = $form['codigoGrupo']->getData();
            $universidad = null;
            $colegio = $this->getDoctrine()
                ->getRepository(GrupoColegio::class)
                ->findOneBy(
                    ['codigoGrupo' => $codigoGrupo]
                );

            if (!$colegio) {
                // Check if codigoGrupo exist in Grupo (Grupo-Universidad) Entity
                $universidad = $this->getDoctrine()
                    ->getRepository(Grupo::class)
                    ->findOneBy(
                        ['codigoGrupo' => $codigoGrupo]
                    );
                if (!$universidad) {
//                    todo
//                    return codigoerror -> no pertenece a ningun grupo
                }
                else {
//                    codigoGrupo pertenece a universidad
                    // 2.5) Set register date
                    $fecha = new \DateTime();
                    $user->setFechaRegistro($fecha);
                    $user->setRoles(['ROLE_UNIVERSIDAD']);


                    // 3) Encode the password (you could also do this via Doctrine listener)
                    $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                    $user->setPassword($password);

                    // 4) save the User!
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();

                    // todo: Redirect to user saved successfull
                }
            } else {
                // todo
                // codigoGrupo pertenece a colegio
                // 2.5) Set register date
                $fecha = new \DateTime();
                $user->setFechaRegistro($fecha);
                $user->setRoles(['ROLE_COLEGIO']);

                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }


            // Check if codigoGrupo is related to Colegio or Universidad
            // -> Persist in the corresponding group with it corresponding ROLE


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
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}