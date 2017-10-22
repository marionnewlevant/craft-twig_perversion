<?php
namespace marionnewlevant\twigperversion\twigextensions;

class Numeric_Test extends \Twig_Node_Expression_Test
{
	public function compile(\Twig_Compiler $compiler)
	{
		$compiler->raw('is_numeric(')->subcompile($this->getNode('node'))->raw(')');
	}
}
