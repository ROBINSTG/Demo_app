<?php
    /**
    * author: Robin St-Georges date: 2020-08-06
    * Simple demo project realized with the goal to show understanding of PHP, Javascript & co.
    *
    * SubsbriptionController: Controller in charge of the CRUD used to manage all submissions
    */
    namespace App\Controller;

    use App\Entity\Submission;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    use \DateTime;

    class SubmissionsController extends AbstractController
    {
      /**
      * @Route("/demo_application/home", name="index")
      * @Method({"GET"})
      */
      public function index() {

          return $this->render('index.html.twig');
      }

      /**
      * @Route("/demo_application/about/", name="about")
      * @Method({"GET"})
      */
      public function about() {

          return $this->render('about.html.twig');
      }

      /**
      * @Route("/demo_application/submissions/{created}", name="submissions", defaults={"created"=false})
      * @Method({"GET"})
      */
      public function submissions($created, UserInterface $user) {

          // check permissions due to dynamic parameter messing with path
          if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
              return $this->redirectToRoute('app_login');
          }

          // get the current user id and select all related submissions entries
          $user_id = $user->getId();
          $submissions = $this->getDoctrine()->getRepository(Submission::class)->findBy(['userId' => $user_id]);

          return $this->render('submissions/submissions.html.twig', array('submissions' => $submissions, 'created' => $created));
      }

      /**
      * @route("/demo_application/submission/create/", name="create_submission")
      * Method({"GET", "POST"})
      */
      public function create(Request $request, UserInterface $user) {
          $submission = new Submission();
          $user_id = $user->getId();

          // create form with the necessary fields
          $form = $this->createFormBuilder($submission)
              ->add('type', TextType::class, array('label' => 'Type of submission', 'attr' => array('class' => 'form-control')))
              ->add('numberOfCars', IntegerType::class, array('label' => 'Number of cars owned', 'attr' => array('class' => 'form-control')))
              ->add('submissionAddress', TextType::class, array('label' => 'Submission\'s address', 'attr' => array('class' => 'form-control')))
              ->add('pastClaims', CheckboxType::class, array('label' => 'Did you already make a claim in the last 3 years?', 'attr' => array('class' => 'form-check ml-2'), 'required' => false))
              ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-dark mt-4')))
              ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {
              $submission = $form->getData();
              // save current creation date & current user
              $submission->setDate(new DateTime());
              $submission->setUserId($user_id);

              // save new submission in the MySQL database
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($submission);
              $entityManager->flush();

              return $this->redirectToRoute('submissions' , array('created' => true));
          }

          return $this->render('submissions/create.html.twig', array('form' => $form->createView()));
      }

      /**
      * @route("/demo_application/submission/edit/{id}", name="edit_submission")
      * Method({"GET", "POST"})
      */
      public function edit(Request $request, $id) {
          $submission = new Submission();
          $submission = $this->getDoctrine()->getRepository(Submission::class)->find($id);

          // create form with the necessary fields
          $form = $this->createFormBuilder($submission)
              ->add('type', TextType::class, array('label' => 'Type of submission', 'attr' => array('class' => 'form-control')))
              ->add('numberOfCars', IntegerType::class, array('label' => 'Number of cars owned', 'attr' => array('class' => 'form-control')))
              ->add('submissionAddress', TextType::class, array('label' => 'Submission\'s address', 'attr' => array('class' => 'form-control')))
              ->add('pastClaims', CheckboxType::class, array('label' => 'Did you already make a claim in the last 3 years?', 'attr' => array('class' => 'form-check ml-2'), 'required' => false))
              ->add('save', SubmitType::class, array('label' => 'Confirm changes', 'attr' => array('class' => 'btn btn-dark mt-4')))
              ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {

              // push changes in the database
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->redirectToRoute('submissions');
          }

          return $this->render('submissions/edit.html.twig', array('form' => $form->createView()));
      }

      /**
      * @Route("/demo_application/submission/delete/{id}", name="delete_submission")
      * @Method({"DELETE"})
      */
      public function delete(Request $request, $id) {
          $submission = $this->getDoctrine()->getRepository(Submission::class)->find($id);

          // remove submission from the database and confirm deletion
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($submission);
          $entityManager->flush();

          $response = new Response();
          $response->send();
      }
    }
?>
