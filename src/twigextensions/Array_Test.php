<?php
namespace marionnewlevant\twigperversion\twigextensions;

class Array_Test extends \Twig\Node\Expression\TestExpression
{
  public function compile(\Twig\Compiler $compiler): void
  {
    $compiler->raw('is_array(')->subcompile($this->getNode('node'))->raw(')');
  }
}
