<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal\pessoa;

use rossicampos\fiscal\Cnpj;

/**
 * Juridica é a classe responsável da Pessoa Jurídica.
 *
 * @author braulio
 */
class Juridica extends AbstractPessoa
{

    /** @var string CNPJ */
    protected $_cnpj;

    /**
     * Retorna o número do CNPJ ou null se ele não foi definido.
     *
     * @return string|null número do CNPJ
     */
    public function getCnpj()
    {
        return is_object($this->_cnpj) ? $this->_cnpj->numero : null;
    }

    /**
     * Define o número do CNPJ.
     *
     * @param mixed $cnpj número do CNPJ
     */
    public function setCnpj($cnpj)
    {
        $this->_cnpj = new Cnpj($cnpj);
    }
}