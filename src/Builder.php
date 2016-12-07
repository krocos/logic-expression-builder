<?php

namespace Krocos\LogicExpressionBuilder;

final class Builder implements OperandInterface
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function x($x)
    {
        $this->elements[] = ($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false';

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function notX($x)
    {
        $this->elements[] = '!'.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function andX($x)
    {
        $this->elements[] = ' && '.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function orX($x)
    {
        $this->elements[] = ' || '.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function andNotX($x)
    {
        $this->elements[] = ' && !'.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function orNotX($x)
    {
        $this->elements[] = ' || !'.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function xorX($x)
    {
        $this->elements[] = ' xor '.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @param OperandInterface|bool $x
     *
     * @return Builder
     */
    public function xorNotX($x)
    {
        $this->elements[] = ' xor !'.(($x instanceof OperandInterface ? $x->toBool() : $x) ? 'true' : 'false');

        return $this;
    }

    /**
     * @return Builder
     */
    public function closeBrace()
    {
        $this->elements[] = ')';

        return $this;
    }

    /**
     * @return Builder
     */
    public function openBrace()
    {
        $this->elements[] = '(';

        return $this;
    }

    /**
     * @return Builder
     */
    public function notOpenBrace()
    {
        $this->elements[] = '!(';

        return $this;
    }

    /**
     * @return Builder
     */
    public function andOpenBrace()
    {
        $this->elements[] = ' && (';

        return $this;
    }

    /**
     * @return Builder
     */
    public function andNotOpenBrace()
    {
        $this->elements[] = ' && !(';

        return $this;
    }

    /**
     * @return Builder
     */
    public function orOpenBrace()
    {
        $this->elements[] = ' || (';

        return $this;
    }

    /**
     * @return Builder
     */
    public function orNotOpenBrace()
    {
        $this->elements[] = ' || !(';

        return $this;
    }

    /**
     * @return Builder
     */
    public function xorOpenBrace()
    {
        $this->elements[] = ' xor (';

        return $this;
    }

    /**
     * @return Builder
     */
    public function xorNotOpenBrace()
    {
        $this->elements[] = ' xor !(';

        return $this;
    }

    /**
     * @return bool
     */
    public function toBool()
    {
        return eval('return '.implode('', $this->elements).';');
    }
}
