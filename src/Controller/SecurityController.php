<?php
    /**
    * author: Robin St-Georges date: 2020-08-06
    * Simple demo project realized with the goal to show understanding of PHP, Javascript & co.
    *
    * SecurityController: Controller in charge of the login and logout operations of the application
    */

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    class SecurityController extends AbstractController
    {
        /**
         * @Route("/demo_application/login/", name="app_login")
         */
        public function login(AuthenticationUtils $authenticationUtils): Response
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        }

        /**
         * @Route("/demo_application/logout", name="app_logout")
         */
        public function logout()
        {
            // everything is taken cared of in security
        }
    }
?>
