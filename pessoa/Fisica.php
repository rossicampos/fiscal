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

    /** @var string CPF */
    protected $_cpf;

    /**
     * Retorna o número do CPF ou null se ele não foi definido.
     *
     * @return string|null número do CPF ou null
     */
    public function getCpf()
    {
        return is_object($this->_cpf) ? $this->_cpf->numero : null;
    }

    /**
     * Define o número do CPF.
     *
     * @param mixed $cpf número do CPF
     */
    public function setCpf($cpf)
    {
        $this->_cpf = new Cpf($cpf);
    }
}