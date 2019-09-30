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
class NotaFiscal extends AbstractRegistro
{

    /** @var int série da Nota Fiscal */
    protected $_serie;

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
     * @param string $numero o número da Nota Fiscal
     * @param string $serie a série da Nota Fiscal
     * @return boolean
     */
    public static function valida($numero, $serie)
    {
        $numero = static::filtra($numero);
        $serie = static::filtra($serie);
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
     * Define o número da série da Nota Fiscal.
     *
     * @param mixed $serie a série da Nota Fiscal
     */
    public function setSerie($serie)
    {
        $serie = static::filtra($serie);
        if (static::validaSerie($serie)) {
            $this->_numero = $serie;
        }
    }
}