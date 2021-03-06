<?php

namespace DoctrineProxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Usuario extends \App\Entity\Usuario implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'login', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'pessoa', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'senha', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'perfils', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'senhaExpirada', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'rotas'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'login', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'pessoa', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'senha', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'perfils', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'senhaExpirada', '' . "\0" . 'App\\Entity\\Usuario' . "\0" . 'rotas'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Usuario $proxy) {
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
    public function getRotas(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRotas', []);

        return parent::getRotas();
    }

    /**
     * {@inheritDoc}
     */
    public function setRotas(array $rotas)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRotas', [$rotas]);

        return parent::setRotas($rotas);
    }

    /**
     * {@inheritDoc}
     */
    public function getSenhaExpirada(): bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSenhaExpirada', []);

        return parent::getSenhaExpirada();
    }

    /**
     * {@inheritDoc}
     */
    public function setSenhaExpirada(bool $senhaExpirada)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSenhaExpirada', [$senhaExpirada]);

        return parent::setSenhaExpirada($senhaExpirada);
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
    public function getLogin(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLogin', []);

        return parent::getLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function setLogin(string $login)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLogin', [$login]);

        return parent::setLogin($login);
    }

    /**
     * {@inheritDoc}
     */
    public function getPessoa(): \App\Entity\PessoaFisica
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPessoa', []);

        return parent::getPessoa();
    }

    /**
     * {@inheritDoc}
     */
    public function setPessoa(\App\Entity\PessoaFisica $pessoa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPessoa', [$pessoa]);

        return parent::setPessoa($pessoa);
    }

    /**
     * {@inheritDoc}
     */
    public function setSenha(string $senha)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSenha', [$senha]);

        return parent::setSenha($senha);
    }

    /**
     * {@inheritDoc}
     */
    public function getSenha(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSenha', []);

        return parent::getSenha();
    }

    /**
     * {@inheritDoc}
     */
    public function getPerfils(): \App\Entity\Perfil
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPerfils', []);

        return parent::getPerfils();
    }

    /**
     * {@inheritDoc}
     */
    public function addPerfil(\App\Entity\Perfil $perfil)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPerfil', [$perfil]);

        return parent::addPerfil($perfil);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', []);

        return parent::toArray();
    }

}
