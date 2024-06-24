<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $tokkenReset = null;

    /**
     * @var Collection<int, Ask>
     */
    #[ORM\ManyToMany(targetEntity: Ask::class, mappedBy: 'Employee')]
    private Collection $asks;

    public function __construct()
    {
        $this->asks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getTokkenReset(): ?string
    {
        return $this->tokkenReset;
    }

    public function setTokkenReset(string $tokkenReset): static
    {
        $this->tokkenReset = $tokkenReset;

        return $this;
    }

    /**
     * @return Collection<int, Ask>
     */
    public function getAsks(): Collection
    {
        return $this->asks;
    }

    public function addAsk(Ask $ask): static
    {
        if (!$this->asks->contains($ask)) {
            $this->asks->add($ask);
            $ask->addEmployee($this);
        }

        return $this;
    }

    public function removeAsk(Ask $ask): static
    {
        if ($this->asks->removeElement($ask)) {
            $ask->removeEmployee($this);
        }

        return $this;
    }
}
