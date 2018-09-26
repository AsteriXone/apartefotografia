<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo")
 * @ORM\Entity
 */
class Grupo
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Universidad", inversedBy="grupos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $universidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Especialidad", inversedBy="grupos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $especialidad;

//    /**
//     * @ORM\ManyToOne(targetEntity="Universidad", inversedBy="grupo")
//     */
//    private $universidad;
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Especialidad", inversedBy="grupo")
//     */
//    private $especialidad;
//
//    /**
//     * @ORM\OneToMany(targetEntity="GruposUsuarios", mappedBy="grupo")
//     */
//    private $grupos_usuarios;
//
//    /**
//     * @ORM\OneToMany(targetEntity="GrupoMuestra", mappedBy="grupo")
//     */
//    private $gruposMuestras;
//
//    /**
//     * @ORM\OneToMany(targetEntity="GrupoMuestraVotar", mappedBy="grupo")
//     */
//    private $gruposMuestrasVotar;
//
//    /**
//     * @ORM\OneToMany(targetEntity="CuadranteGrupo", mappedBy="grupo")
//     */
//    private $cuadranteGrupo;
//
//    /**
//     * @ORM\OneToMany(targetEntity="GrupoProfesor", mappedBy="grupo")
//     */
//    private $grupos_profesores;
//
//    /**
//     * One Grupo has Many UsuarioMuestra.
//     * @ORM\OneToMany(targetEntity="UsuariosMuestras", mappedBy="grupo")
//     */
//    private $usuario_muestra;
//
//    /**
//     * @ORM\OneToMany(targetEntity="ImageOrla", mappedBy="grupo", cascade={"persist", "remove"})
//     */
//    protected $imagenes;


    public function __construct()
    {
//        $this->gruposMuestras = new ArrayCollection();
//        $this->grupos_usuarios = new ArrayCollection();
//        $this->cuadranteGrupo = new ArrayCollection();
//        $this->grupos_profesores = new ArrayCollection();
//        $this->imagenes = new ArrayCollection();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
//        return (string) $this->getUniversidad(). " - ".$this->getEspecialidad(). " (" . $this->getAnio().")";
        return (string) $this->getUniversidad(). " - "."(" . $this->getAnio().")";

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

    public function getUniversidad(): ?Universidad
    {
        return $this->universidad;
    }

    public function setUniversidad(?Universidad $universidad): self
    {
        $this->universidad = $universidad;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getEspecialidad(): ?Especialidad
    {
        return $this->especialidad;
    }

    public function setEspecialidad(?Especialidad $especialidad): self
    {
        $this->especialidad = $especialidad;

        return $this;
    }
}
