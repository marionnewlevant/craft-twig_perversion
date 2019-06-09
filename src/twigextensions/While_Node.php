<?php

/**
 * Represents a while node.
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2019, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 *
 */
namespace marionnewlevant\twigperversion\twigextensions;

use Twig\Node\ForLoopNode;
use Twig\Node\Node;
use Twig\Compiler;

class While_Node extends Node
{
    private $loop;

    public function __construct(Node $condition, Node $body, int $lineno, string $tag = null)
    {
        $body = new Node([$body, $this->loop = new ForLoopNode($lineno, $tag)]);
        $nodes = [
            'body' => $body,
            'condition' => $condition
        ];
        parent::__construct($nodes, ['with_loop' => true], $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param Twig_Compiler $compiler
     *
     * @return void
     *
     * @see \Twig_Node::compile
     */
    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("\$context['_parent'] = \$context;\n");

        if ($this->getAttribute('with_loop')) {
            $compiler
                ->write("\$context['loop'] = [\n")
                ->write("  'parent' => \$context['_parent'],\n")
                ->write("  'index0' => 0,\n")
                ->write("  'index'  => 1,\n")
                ->write("  'first'  => true,\n")
                ->write("];\n")
            ;
        }

        $this->loop->setAttribute('with_loop', $this->getAttribute('with_loop'));

        $compiler
            ->write('while (')
            ->subcompile($this->getNode('condition'))
            ->raw(") {\n")
            ->indent()
            // this is a ForLoopNode, so it updates the loop stuff
            ->subcompile($this->getNode('body'))
            ->outdent()
            ->write("}\n")
        ;

        $compiler->write("\$_parent = \$context['_parent'];\n");

        // remove some "private" loop variables (needed for nested loops)
        $compiler->write('unset($context[\'_parent\'], $context[\'loop\']);'."\n");

        // keep the values set in the inner context for variables defined in the outer context
        $compiler->write("\$context = array_intersect_key(\$context, \$_parent) + \$_parent;\n");
    }
}
