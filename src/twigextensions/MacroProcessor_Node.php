<?php
namespace marionnewlevant\twigperversion\twigextensions;

use marionnewlevant\twigperversion\Plugin;
use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;

/**
 * Twig Perversion
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2024, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 * @since     2.3.0
 */

class MacroProcessor_Node extends AbstractExpression
{
    public function compile(Compiler $compiler): void
    {
        $compiler
            ->raw("\n")
            ->indent()
            ->write(sprintf("%s::processMacroResponse(\n", Plugin::class))
            ->indent()
            ->write('')
            ->subcompile($this->getNode('macroCallExpression'))
            ->raw("\n")
            ->outdent()
            ->write(")\n")
            ->outdent()
            ->write('');
    }
}
