<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * NotaFiscal é a classe responsável da Nota Fiscal.
 *
 * @author braulio
 */
class NotaFiscal extends BaseObject
{
    use NumeroTrait;

    const FRETE_CIF = 1;

    const FRETE_FOB = 2;

    const LEGENDA_FRETE = [
        self::FRETE_CIF => 'CIF',
        self::FRETE_FOB => 'FOB'
    ];

    /** @var string número do registro */
    protected $_numero;

    /** @var int série da Nota Fiscal */
    protected $_serie;

    /**
     * Constructor.
     *
     * @param mixed $numero número do registro
     * @param mixed $serie série do registro
     */
    public function __construct($numero, $serie)
    {
        static::setNumero($numero);
        static::setSerie($serie);
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
     * Define o número de registro.
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
     * Retorna a série da Nota Fiscal
     *
     * @return number série da Nota Fiscal
     */
    public function getSerie()
    {
        return $this->_serie;
    }

    /**
     * Define o número da série da Nota Fiscal.
     *
     * @param mixed $serie a série da Nota Fiscal
     */
    public function setSerie($serie)
    {
        $serie = static::filtra($serie);
        if (static::validaSerie($serie)) {
            $this->_serie = $serie;
        }
    }

    /**
     * Formata e agrupa o número e a série da Nota Fiscal.
     *
     * @param mixed $numero o número da Nota Fiscal
     * @param mixed $serie a série da Nota Fiscal
     * @return string|NULL
     */
    public static function formata($numero, $serie)
    {
        $numero = static::filtra($numero);
        $serie = static::filtra($serie);
        if (static::valida($numero, $serie)) {
            $numero = str_pad($numero, 9, '0', STR_PAD_LEFT);
            $numero = substr_replace($numero, '.', 3, 0);
            $numero = substr_replace($numero, '.', 7, 0);
            return $numero . '/' . str_pad($serie, 3, '0', STR_PAD_LEFT);
        }
        return null;
    }

    /**
     * Valida o número e a séria da Nota Fiscal.
     *
     * @param mixed $numero o número da Nota Fiscal
     * @param mixed $serie a série da Nota Fiscal
     * @return boolean
     */
    public static function valida($numero, $serie)
    {
        $numero = static::filtra($numero);
        return static::validaNumero($numero) && static::validaSerie($serie);
    }

    /**
     * Valida o número da Nota Fiscal
     *
     * @param string $numero o número da Nota Fiscal
     */
    public static function validaNumero($numero)
    {
        $numero = static::filtra($numero);
        if (intval($numero) < 0 || intval($numero) > 999999999) {
            return false;
        }
        return true;
    }

    /**
     * Valida a série da Nota Fiscal
     *
     * @param string $serie a série da Nota Fiscal
     */
    public static function validaSerie($serie)
    {
        $serie = static::filtra($serie);
        if (intval($serie) < 0 || intval($serie) > 999) {
            return false;
        }
        return true;
    }

    /**
     * Retorna a legenda do frete.
     * Se não for informado o frete, retorna um array com a legenda de todos os fretes.
     *
     * @param int $valor
     * @return string|array|null
     */
    public static function getFreteLegenda($valor = null)
    {
        if ($valor !== null) {
            return isset(static::LEGENDA_FRETE[$valor]) ? static::LEGENDA_FRETE[$valor] : null;
        }
        return static::LEGENDA_FRETE;
    }
}