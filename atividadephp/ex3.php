<?php

abstract class Telefone {
    private $ddd;
    private $numero;

    public function __construct($ddd, $numero) {
        $this->ddd = $ddd;
        $this->numero = $numero;
    }

    public abstract function calculaCusto($tempoDeLigacao);
}

class Fixo extends Telefone {
    private $custoPorMinuto;

    public function __construct($ddd, $numero, $custoPorMinuto) {
        parent::__construct($ddd, $numero);
        $this->custoPorMinuto = $custoPorMinuto;
    }

    public function calculaCusto($tempoDeLigacao) {
        return $tempoDeLigacao * $this->custoPorMinuto;
    }
}

abstract class Celular extends Telefone {
    private $custoPorMinutoBase;
    private $operadora;

    public function __construct($ddd, $numero, $custoPorMinutoBase, $operadora) {
        parent::__construct($ddd, $numero);
        $this->custoPorMinutoBase = $custoPorMinutoBase;
        $this->operadora = $operadora;
    }

    public function getCustoPorMinutoBase() {
        return $this->custoPorMinutoBase;
    }

    public function getOperadora() {
        return $this->operadora;
    }
}

class PrePago extends Celular {
    public function __construct($ddd, $numero, $custoPorMinutoBase, $operadora) {
        parent::__construct($ddd, $numero, $custoPorMinutoBase, $operadora);
    }

    public function calculaCusto($tempoDeLigacao) {
        return $tempoDeLigacao * $this->getCustoPorMinutoBase() * 1.4; 
    }
}

class PosPago extends Celular {
    public function __construct($ddd, $numero, $custoPorMinutoBase, $operadora) {
        parent::__construct($ddd, $numero, $custoPorMinutoBase, $operadora);
    }

    public function calculaCusto($tempoDeLigacao) {
        return $tempoDeLigacao * $this->getCustoPorMinutoBase() * 0.9;
    }
}
