<?php
    /**
    * author: Robin St-Georges date: 2020-08-06
    * Simple demo project realized with the goal to show understanding of PHP, Javascript & co.
    *
    * User: Entity file used to create and manage new users.
    */
    namespace App\Entity;

    use App\Repository\UserRepository;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Security\Core\User\UserInterface;

    /**
     * @ORM\Entity(repositoryClass=UserRepository::class)
     */
    class User implements UserInterface
    {
      /**
       * @ORM\Id()
       * @ORM\GeneratedValue()
       * @ORM\Column(type="integer")
       */
      private $id;

      /**
       * @ORM\Column(type="string", length=255, unique=true)
       */
      private $name;

      /**
       * @ORM\Column(type="string", length=255)
       */
      private $password;

      /**
       * @ORM\Column(type="string", length=255)
       */
      private $phoneNumber;

      /**
       * @ORM\Column(type="json")
       */
      private $roles = [];

      public function getId(): ?int
      {
          return $this->id;
      }

      public function getName(): ?string
      {
          return $this->name;
      }

      public function setName(string $name): self
      {
          $this->name = $name;

          return $this;
      }

      public function getPhoneNumber(): ?string
      {
          return $this->phoneNumber;
      }

      public function setPhoneNumber(string $phoneNumber): self
      {
          $this->phoneNumber = $phoneNumber;

          return $this;
      }

        /**
         * A visual identifier that represents this user.
         *
         * @see UserInterface
         */
        public function getUsername(): string
        {
            return (string) $this->name;
        }

        /**
         * @see UserInterface
         */
        public function getRoles(): array
        {
            $roles = $this->roles;
            // guarantee every user at least has ROLE_USER
            $roles[] = 'ROLE_USER';

            return array_unique($roles);
        }

        public function setRoles(array $roles): self
        {
            $this->roles = $roles;

            return $this;
        }

        /**
         * @see UserInterface
         */
        public function getPassword(): string
        {
            return (string) $this->password;
        }

        public function setPassword(string $password): self
        {
            $this->password = $password;

            return $this;
        }

        /**
         * @see UserInterface
         */
        public function getSalt()
        {
            // not needed when using the "bcrypt" algorithm in security.yaml
        }

        /**
         * @see UserInterface
         */
        public function eraseCredentials()
        {
            // If you store any temporary, sensitive data on the user, clear it here
            // $this->plainPassword = null;
        }
    }
?>
