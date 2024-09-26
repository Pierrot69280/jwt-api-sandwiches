<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    /**
     * @var Collection<int, Sandwich>
     */
    #[ORM\ManyToMany(targetEntity: Sandwich::class, inversedBy: 'ingredients')]
    private Collection $sandwichs;

    public function __construct()
    {
        $this->sandwichs = new ArrayCollection();
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

    /**
     * @return Collection<int, Sandwich>
     */
    public function getSandwichs(): Collection
    {
        return $this->sandwichs;
    }

    public function addSandwich(Sandwich $sandwich): static
    {
        if (!$this->sandwichs->contains($sandwich)) {
            $this->sandwichs->add($sandwich);
        }

        return $this;
    }

    public function removeSandwich(Sandwich $sandwich): static
    {
        $this->sandwichs->removeElement($sandwich);

        return $this;
    }
}
