<?php
/**
 * Twig Perversion plugin for Craft CMS 3.x
 *
 * Making twig do things it really shouldn't
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2017 Marion Newlevant
 */

namespace marionnewlevant\twigperversion\twigextensions;

/**
 *
 * @author    Marion Newlevant
 * @package   TwigPerversion
 * @since     1.0.0
 */
class TwigPerversionTwigExtension extends \Twig_Extension
{
	// Public Methods
	// =========================================================================

	/**
	* Returns the name of the extension.
	*
	* @return string The extension name
	*/
	public function getName()
	{
		return 'TwigPerversion';
	}

	public function getTokenParsers()
	{
		return [
			new Break_TokenParser(),
			new Continue_TokenParser(),
			new Return_TokenParser(),
			new While_TokenParser(),
		];
	}

	public function getTests()
	{
		return [
			new \Twig_Test('numeric', null, ['node_class' => '\marionnewlevant\twigperversion\twigextensions\Numeric_Test']),
			new \Twig_Test('string', null, ['node_class' => '\marionnewlevant\twigperversion\twigextensions\String_Test']),
			new \Twig_Test('array', null, ['node_class' => '\marionnewlevant\twigperversion\twigextensions\Array_Test']),
		];
	}

	public function getFilters()
	{
		return [
			new \Twig_Filter('array_splice', function(array $input, int $offset, int $length = null, $replacement = null) {
				if (is_null($length))
				{
					$length = count($input);
				}
				if (is_null($replacement))
				{
					$replacement = [];
				}
				$extracted = array_splice($input, $offset, $length, $replacement);
				return $input;
			}),

			new \Twig_SimpleFilter('string', [$this, 'string']),
			new \Twig_SimpleFilter('float',  [$this, 'float']),
			new \Twig_SimpleFilter('int',    [$this, 'int']),
			new \Twig_SimpleFilter('bool',   [$this, 'bool']),
		];
	}

	public function getOperators()
	{
		return [
			[],
			[
				'===' => [
					'precedence' => 20,
					'class' => '\marionnewlevant\twigperversion\twigextensions\Expression_Binary_Equivalent',
					'associativity' => \Twig_ExpressionParser::OPERATOR_LEFT,
				],
				'!==' => [
					'precedence' => 20,
					'class' => '\marionnewlevant\twigperversion\twigextensions\Expression_Binary_NotEquivalent',
					'associativity' => \Twig_ExpressionParser::OPERATOR_LEFT,
				],
				'<=>' => [
					'precedence' => 20,
					'class' => '\marionnewlevant\twigperversion\twigextensions\Expression_Binary_Spaceship',
					'associativity' => \Twig_ExpressionParser::OPERATOR_LEFT,
				],
			],
		];
	}

	/**
	 * Cast value as a string.
	 *
	 * @param mixed $subject Value to be cast.
	 * @return string
	 */
	public function string($subject)
	{
		return (string) $subject;
	}

	/**
	 * Cast value as a float.
	 *
	 * @param mixed $subject Value to be cast.
	 * @return float
	 */
	public function float($subject)
	{
		return (float) $subject;
	}

	/**
	 * Cast value as a integer.
	 *
	 * @param mixed $subject Value to be cast.
	 * @return int
	 */
	public function int($subject)
	{
		return (int) $subject;
	}

	/**
	 * Cast value as a boolean.
	 *
	 * @param mixed $subject Value to be cast.
	 * @return bool
	 */
	public function bool($subject)
	{
		return (bool) $subject;
	}

}
