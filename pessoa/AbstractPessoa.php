<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal\pessoa;

use rossicampos\fiscal\BaseObject;

/**
 * PessoaInterface é a classe base para as classes Física e Juridica
 *
 * @author braulio
 */
abstract class AbstractPessoa extends BaseObject
{

    /** @var string nome da pessoa */
    protected $_nome;

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
        $this->_nome = trim($nome);
    }
}