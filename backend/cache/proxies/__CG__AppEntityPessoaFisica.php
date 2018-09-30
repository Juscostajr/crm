<?php

namespace DoctrineProxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class PessoaFisica extends \App\Entity\PessoaFisica implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\PessoaFisica' . "\0" . 'cpf', 'nome', '' . "\0" . 'App\\Entity\\PessoaFisica' . "\0" . 'dtNascimento', 'id', 'telefones', 'enderecos', 'email', 'grupos'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\PessoaFisica' . "\0" . 'cpf', 'nome', '' . "\0" . 'App\\Entity\\PessoaFisica' . "\0" . 'dtNascimento', 'id', 'telefones', 'enderecos', 'email', 'grupos'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (PessoaFisica $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getNome(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNome', []);

        return parent::getNome();
    }

    /**
     * {@inheritDoc}
     */
    public function setNome(string $nome)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNome', [$nome]);

        return parent::setNome($nome);
    }

    /**
     * {@inheritDoc}
     */
    public function getCpf(): \App\Entity\Cpf
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCpf', []);

        return parent::getCpf();
    }

    /**
     * {@inheritDoc}
     */
    public function setCpf(\App\Entity\Cpf $cpf)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCpf', [$cpf]);

        return parent::setCpf($cpf);
    }

    /**
     * {@inheritDoc}
     */
    public function getDtNascimento(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDtNascimento', []);

        return parent::getDtNascimento();
    }

    /**
     * {@inheritDoc}
     */
    public function setDtNascimento(\DateTime $dtNascimento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDtNascimento', [$dtNascimento]);

        return parent::setDtNascimento($dtNascimento);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', []);

        return parent::toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function getGrupos(): \Doctrine\Common\Collections\ArrayCollection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGrupos', []);

        return parent::getGrupos();
    }

    /**
     * {@inheritDoc}
     */
    public function addGrupos(\App\Entity\Grupo $grupo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGrupos', [$grupo]);

        return parent::addGrupos($grupo);
    }

    /**
     * {@inheritDoc}
     */
    public function setGrupos(array $grupos)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGrupos', [$grupos]);

        return parent::setGrupos($grupos);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId(int $id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getTelefones(): \App\Entity\Telefone
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTelefones', []);

        return parent::getTelefones();
    }

    /**
     * {@inheritDoc}
     */
    public function addTelefones(\App\Entity\Telefone $telefone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTelefones', [$telefone]);

        return parent::addTelefones($telefone);
    }

    /**
     * {@inheritDoc}
     */
    public function getEnderecos(): \App\Entity\Endereco
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnderecos', []);

        return parent::getEnderecos();
    }

    /**
     * {@inheritDoc}
     */
    public function addEnderecos(\App\Entity\Endereco $endereco)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEnderecos', [$endereco]);

        return parent::addEnderecos($endereco);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): \App\Entity\Mail
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(\App\Entity\Mail $email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

}
