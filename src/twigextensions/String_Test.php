<?php
namespace marionnewlevant\twigperversion\twigextensions;

class String_Test extends \Twig\Node\Expression\TestExpression
{
  public function compile(\Twig\Compiler $compiler): void
  {
    $compiler->raw('is_string(')->subcompile($this->getNode('node'))->raw(')');
  }
}
