<?php
    /**
    * author: Robin St-Georges date: 2020-08-06
    * Simple demo project realized with the goal to show understanding of PHP, Javascript & co.
    *
    * Submission: Entity file used to create and manage new Submissions. 
    */
    namespace App\Entity;

    use App\Repository\SubmissionRepository;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity(repositoryClass=SubmissionRepository::class)
     */
    class Submission
    {
        /**
         * @ORM\Id()
         * @ORM\GeneratedValue()
         * @ORM\Column(type="integer")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $type;

        /**
         * @ORM\Column(type="integer")
         */
        private $numberOfCars;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $submissionAddress;

        /**
         * @ORM\Column(type="boolean")
         */
        private $pastClaims;

        /**
         * @ORM\Column(type="date")
         */
        private $date;

        /**
         * @ORM\Column(type="integer")
         */
        private $userId;

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getType(): ?string
        {
            return $this->type;
        }

        public function setType(string $type): self
        {
            $this->type = $type;

            return $this;
        }

        public function getNumberOfCars(): ?int
        {
            return $this->numberOfCars;
        }

        public function setNumberOfCars(int $numberOfCars): self
        {
            $this->numberOfCars = $numberOfCars;

            return $this;
        }

        public function getSubmissionAddress(): ?string
        {
            return $this->submissionAddress;
        }

        public function setSubmissionAddress(string $submissionAddress): self
        {
            $this->submissionAddress = $submissionAddress;

            return $this;
        }

        public function getPastClaims(): ?bool
        {
            return $this->pastClaims;
        }

        public function setPastClaims(bool $pastClaims): self
        {
            $this->pastClaims = $pastClaims;

            return $this;
        }

        public function getDate(): ?\DateTimeInterface
        {
            return $this->date;
        }

        public function setDate(\DateTimeInterface $date): self
        {
            $this->date = $date;

            return $this;
        }

        public function getUserId(): ?int
        {
            return $this->userId;
        }

        public function setUserId(int $userId): self
        {
            $this->userId = $userId;

            return $this;
        }
    }
?>
