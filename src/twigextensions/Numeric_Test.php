<?php
namespace marionnewlevant\twigperversion\twigextensions;

class Numeric_Test extends \Twig\Node\Expression\TestExpression
{
	public function compile(\Twig\Compiler $compiler): void
	{
		$compiler->raw('is_numeric(')->subcompile($this->getNode('node'))->raw(')');
	}
}
