<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal\pessoa;

use rossicampos\fiscal\Cpf;

/**
 * Fisica é a classe responsável da Pessoa Física.
 *
 * @author braulio
 */
class Fisica extends AbstractPessoa
{

    /**
     * {@inheritdoc}
     * @see \rossicampos\fiscal\pessoa\AbstractPessoa::getRegistro()
     */
    public function getRegistro()
    {
        return $this->getCpf();
    }

    /**
     * {@inheritdoc}
     * @see \rossicampos\fiscal\pessoa\AbstractPessoa::setRegistro()
     */
    public function setRegistro($registro)
    {
        $this->setCpf($registro);
    }

    /**
     * Retorna o número do CPF ou null se ele não foi definido.
     *
     * @return string|NULL número do CPF ou null
     */
    public function getCpf()
    {
        return is_object($this->_registro) ? $this->_registro->numero : null;
    }

    /**
     * Define o número do CPF.
     *
     * @param mixed $cpf número do CPF
     */
    public function setCpf($cpf)
    {
        $this->_registro = new Cpf($cpf);
    }
}