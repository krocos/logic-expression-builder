<?php

namespace Krocos\LogicExpressionBuilder;

interface OperandInterface
{
    /**
     * @return bool
     */
    public function toBool();
}
