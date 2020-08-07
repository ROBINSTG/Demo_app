<?php
    /**
    * author: Robin St-Georges date: 2020-08-06
    * Simple demo project realized with the goal to show understanding of PHP, Javascript & co.
    *
    * UsersController: Controller in charge of the creation of new users in the application
    */

    namespace App\Controller;

    use App\Entity\User;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

    use \DateTime;

    class UsersController extends AbstractController
    {

      /**
      * @route("/demo_application/user/create/", name="create_user")
      * Method({"GET", "POST"})
      */
      public function create(Request $request, UserPasswordEncoderInterface $encoder) {
          $user = new User();

          // create form with the necessary fields
          $form = $this->createFormBuilder($user)
              ->add('name', TextType::class, array('label' => 'Name', 'attr' => array('class' => 'form-control')))
              ->add('password', TextType::class, array('label' => 'Password', 'attr' => array('class' => 'form-control')))
              ->add('phoneNumber', TextType::class, array('label' => 'Phone number', 'attr' => array('class' => 'form-control')))
              ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-dark mt-4')))
              ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {
              $user = $form->getData();

              $plainPassword = $user->getPassword();

              // encode the password
              $encoded = $encoder->encodePassword($user,$plainPassword);

              $user->setPassword($encoded);

              // save new user in the MySQL database
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($user);
              $entityManager->flush();

              // redirect users to the home page
              return $this->redirectToRoute('index');
          }

          return $this->render('users/userCreate.html.twig', array('form' => $form->createView()));
      }
    }
?>
