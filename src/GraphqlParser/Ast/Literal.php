<?php
/**
 * @author Paweł Dziok <pdziok@gmail.com>
 */

namespace Salupro\GraphqlParser\Ast;


class Literal {

    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}