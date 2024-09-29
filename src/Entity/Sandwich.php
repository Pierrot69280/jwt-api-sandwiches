<?php

namespace App\Entity;

use App\Repository\SandwichRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SandwichRepository::class)]
class Sandwich
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("sandwichesjson")]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("sandwichesjson")]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups("sandwichesjson")]
    private ?float $price = null;

    /**
     * @var Collection<int, Ingredients>
     */
    #[ORM\ManyToMany(targetEntity: Ingredients::class, mappedBy: 'sandwichs')]
    #[Groups("sandwichesjson")]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Ingredients>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredients $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->addSandwich($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removeSandwich($this);
        }

        return $this;
    }
}
