<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal\pessoa;

use rossicampos\fiscal\BaseObject;

/**
 * PessoaInterface é a classe responsável
 *
 * @author braulio
 */
abstract class AbstractPessoa extends BaseObject
{

    /** @var string nome da pessoa */
    protected $_nome;

    /** @var mixed número do registro */
    protected $_registro;

    /**
     * Retorna o nome da pessoa.
     *
     * @return string nome da pessoa
     */
    public function getNome()
    {
        return $this->_nome;
    }

    /**
     * Define o nome da pessoa.
     *
     * @param string $nome nome da pessoa
     */
    public function setNome($nome)
    {
        $this->_nome = $nome;
    }

    /**
     * Retorna o número do registro.
     *
     * @return string número do registro
     */
    public function getRegistro()
    {
        return $this->_registro;
    }

    /**
     * Define o número do registro.
     *
     * @param string $registro número do registro
     */
    public function setRegistro($registro)
    {
        $this->_registro = $registro;
    }
}