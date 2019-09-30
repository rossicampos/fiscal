<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * AbstractRegistro é a classe base para os vários tipos de registros
 *
 * @author braulio
 */
abstract class AbstractRegistro extends BaseObject
{

    /** @var string número do registro */
    protected $_numero;

    /**
     * Constructor.
     *
     * @param mixed $numero número do registro
     */
    public function __construct($numero)
    {
        static::setNumero($numero);
    }

    /**
     * Retorna o número de registro.
     *
     * @return string o número do registro
     */
    public function getNumero()
    {
        return $this->_numero;
    }

    /**
     * Define o número de registtro.
     *
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $numero = static::filtra($numero);
        if (static::valida($numero)) {
            $this->_numero = $numero;
        }
    }

    /**
     * Filtra o número de registro.
     *
     * @param mixed $numero número do registro
     * @return string o número do registro, somente os dígitos
     */
    public static function filtra($numero)
    {
        return mb_ereg_replace('(\D)', '', $numero);
    }

    /**
     * Retorna o número de registro formatado.
     *
     * @param mixed $numero
     */
    public abstract static function formata($numero);

    /**
     * Testa se o número de registro é válido ou não.
     *
     * @param mixed $numero
     */
    public abstract static function valida($numero);
}