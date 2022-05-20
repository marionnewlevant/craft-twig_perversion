<?php
namespace marionnewlevant\twigperversion\twigextensions;

/**
 * Twig Perversion
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2014, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 */

class Break_Node extends \Twig\Node\Node
{
	/**
	* Compiles a Break_Node into PHP.
	*/
	public function compile(\Twig\Compiler $compiler): void
	{
		$compiler
			->addDebugInfo($this)
			->write("break;\n");
	}
}
