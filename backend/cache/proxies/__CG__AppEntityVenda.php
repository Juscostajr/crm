<?php

namespace DoctrineProxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Venda extends \App\Entity\Venda implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'pessoaJuridica', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'etapa', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'interesses', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'interacaos'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'pessoaJuridica', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'etapa', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'interesses', '' . "\0" . 'App\\Entity\\Venda' . "\0" . 'interacaos'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Venda $proxy) {
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
    public function getEtapa(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEtapa', []);

        return parent::getEtapa();
    }

    /**
     * {@inheritDoc}
     */
    public function setEtapa(string $etapa)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEtapa', [$etapa]);

        return parent::setEtapa($etapa);
    }

    /**
     * {@inheritDoc}
     */
    public function getPessoaJuridica(): \App\Entity\PessoaJuridica
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPessoaJuridica', []);

        return parent::getPessoaJuridica();
    }

    /**
     * {@inheritDoc}
     */
    public function setPessoaJuridica(\App\Entity\PessoaJuridica $pessoaJuridica)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPessoaJuridica', [$pessoaJuridica]);

        return parent::setPessoaJuridica($pessoaJuridica);
    }

    /**
     * {@inheritDoc}
     */
    public function getInteresses(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInteresses', []);

        return parent::getInteresses();
    }

    /**
     * {@inheritDoc}
     */
    public function setInteresses(array $interesses)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInteresses', [$interesses]);

        return parent::setInteresses($interesses);
    }

    /**
     * {@inheritDoc}
     */
    public function getInteracaos(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInteracaos', []);

        return parent::getInteracaos();
    }

    /**
     * {@inheritDoc}
     */
    public function addInteracaos(\App\Entity\Interacao $interacao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addInteracaos', [$interacao]);

        return parent::addInteracaos($interacao);
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
