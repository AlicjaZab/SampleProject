<?php

namespace App\Entity;

use App\Repository\FacultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacultyRepository::class)
 */
class Faculty
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Major::class, mappedBy="faculty", orphanRemoval=true)
     */
    private $majors;

    //Getters & Setters

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

    /**
     * @return Collection|Major[]
     */
    public function getMajors(): Collection
    {
        return $this->majors;
    }

    public function addMajor(Major $major): self
    {
        if (!$this->majors->contains($major)) {
            $this->majors[] = $major;
            $major->setFaculty($this);
        }

        return $this;
    }

    public function removeMajor(Major $major): self
    {
        if ($this->majors->removeElement($major)) {
            // set the owning side to null (unless already changed)
            if ($major->getFaculty() === $this) {
                $major->setFaculty(null);
            }
        }

        return $this;
    }

}
