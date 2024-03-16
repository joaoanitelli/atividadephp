<?php

class Funcionario {
    private $nome;
    private $codigo;
    private $salarioBase;

    public function __construct($codigo, $nome, $salarioBase) {
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->salarioBase = $salarioBase;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getSalarioBase() {
        return $this->salarioBase;
    }

    public function setSalarioBase($salarioBase) {
        $this->salarioBase = $salarioBase;
    }

    public function getSalarioLiquido() {
        $inss = $this->salarioBase * 0.1;
        $ir = 0.0;
        return $this->salarioBase - $inss - $ir;
    }

    public function __toString() {
        return get_class($this) . "\n Codigo: " . $this->getCodigo() . "\n Nome: " . $this->getNome() . "\n Salario Base: " . $this->getSalarioBase()
                . "\n Salario liquido: " . $this->getSalarioLiquido();
    }
}

class Servente extends Funcionario {
    private const ADICIONAL_INSALUBRIDADE = 0.05;

    public function __construct($codigo, $nome, $salarioBase) {
        parent::__construct($codigo, $nome, $salarioBase);
    }

    public function getSalarioLiquido() {
        $salarioLiquido = parent::getSalarioLiquido();
        return $salarioLiquido + ($this->getSalarioBase() * self::ADICIONAL_INSALUBRIDADE);
    }
}

class Motorista extends Funcionario {
    private $numeroCarteiraMotorista;

    public function __construct($codigo, $nome, $salarioBase, $numeroCarteiraMotorista) {
        parent::__construct($codigo, $nome, $salarioBase);
        $this->numeroCarteiraMotorista = $numeroCarteiraMotorista;
    }

    public function getNumeroCarteiraMotorista() {
        return $this->numeroCarteiraMotorista;
    }

    public function setNumeroCarteiraMotorista($numeroCarteiraMotorista) {
        $this->numeroCarteiraMotorista = $numeroCarteiraMotorista;
    }
}

class MestreDeObras extends Servente {
    private $numFuncionariosSupervisao;
    private const ADICIONAL_SUPERVISAO = 0.1;
    private const GRUPO_FUNCIONARIOS = 10;

    public function __construct($codigo, $nome, $salarioBase, $numFuncionariosSupervisao) {
        parent::__construct($codigo, $nome, $salarioBase);
        $this->numFuncionariosSupervisao = $numFuncionariosSupervisao;
    }

    public function getSalarioLiquido() {
        $salarioLiquido = parent::getSalarioLiquido();
        $gruposSupervisionados = $this->numFuncionariosSupervisao / self::GRUPO_FUNCIONARIOS;
        return $salarioLiquido + ($this->getSalarioBase() * self::ADICIONAL_SUPERVISAO * $gruposSupervisionados);
    }

    public function getNumFuncionariosSupervisao() {
        return $this->numFuncionariosSupervisao;
    }

    public function setNumFuncionariosSupervisao($numFuncionariosSupervisao) {
        $this->numFuncionariosSupervisao = $numFuncionariosSupervisao;
    }
}
