<?php
namespace marionnewlevant\twigperversion\twigextensions;

use Twig\Environment;
use Twig\Node\Expression\MacroReferenceExpression;
use Twig\Node\Expression\MethodCallExpression;
use Twig\Node\Node;
use Twig\NodeVisitor\NodeVisitorInterface;

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
class Return_NodeVisitor implements NodeVisitorInterface
{
    public function enterNode(Node $node, Environment $env): Node
    {
        return $node;
    }

    public function leaveNode(Node $node, Environment $env): ?Node
    {
        if (class_exists(MacroReferenceExpression::class)) {
            if (!$node instanceof MacroReferenceExpression) {
                return $node;
            }
        } elseif (!$node instanceof MethodCallExpression) {
            return $node;
        }
        if ($node->getAttribute('is_defined_test')) {
            return $node;
        }

        return new MacroProcessor_Node([
            'macroCallExpression' => $node,
        ], [
            'is_generator' => $node->hasAttribute('is_generator') ? $node->getAttribute('is_generator') : false,
        ]);
    }

    public function getPriority()
    {
        return 0;
    }
}
