<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo_colegio")
 * @ORM\Entity
 */
class GrupoColegio
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_grupo", type="string", length=190, unique=true)
     */
    private $codigoGrupo;

    /**
     * @var int
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isVotosProfe", type="boolean")
     */
    private $isVotosProfe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isVotosMuestra", type="boolean")
     */
    private $isVotosMuestra;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCitasActive", type="boolean")
     */
    private $isCitasActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isComprasActive", type="boolean")
     */
    private $isComprasActive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Colegio", inversedBy="grupoColegios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $colegio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="grupoColegio")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getColegio();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigoGrupo(): ?string
    {
        return $this->codigoGrupo;
    }

    public function setCodigoGrupo(string $codigoGrupo): self
    {
        $this->codigoGrupo = $codigoGrupo;

        return $this;
    }

    public function getAnio(): ?int
    {
        return $this->anio;
    }

    public function setAnio(int $anio): self
    {
        $this->anio = $anio;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsVotosProfe(): ?bool
    {
        return $this->isVotosProfe;
    }

    public function setIsVotosProfe(bool $isVotosProfe): self
    {
        $this->isVotosProfe = $isVotosProfe;

        return $this;
    }

    public function getIsVotosMuestra(): ?bool
    {
        return $this->isVotosMuestra;
    }

    public function setIsVotosMuestra(bool $isVotosMuestra): self
    {
        $this->isVotosMuestra = $isVotosMuestra;

        return $this;
    }

    public function getIsCitasActive(): ?bool
    {
        return $this->isCitasActive;
    }

    public function setIsCitasActive(bool $isCitasActive): self
    {
        $this->isCitasActive = $isCitasActive;

        return $this;
    }

    public function getIsComprasActive(): ?bool
    {
        return $this->isComprasActive;
    }

    public function setIsComprasActive(bool $isComprasActive): self
    {
        $this->isComprasActive = $isComprasActive;

        return $this;
    }

    public function getColegio(): ?Colegio
    {
        return $this->colegio;
    }

    public function setColegio(?Colegio $colegio): self
    {
        $this->colegio = $colegio;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGrupo($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getGrupo() === $this) {
                $user->setGrupo(null);
            }
        }

        return $this;
    }
}
