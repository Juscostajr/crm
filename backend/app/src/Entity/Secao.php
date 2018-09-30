<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 27/09/2018
 * Time: 20:59
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Secao
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table("secao")
 */
class Secao
{

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string", length=1)
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $descricao;


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }


    public function toArray()
    {
        return get_object_vars($this);
    }




}