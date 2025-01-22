<?php
namespace marionnewlevant\twigperversion;

use Twig\Markup;

class Plugin extends \craft\base\Plugin
{
    /**
     * @var array Values being returned by macros via `{% return %}` tags.
     * @since 2.3.0
     */
    public static $returnValues = [];

    /**
     * Processes a macro response, searching for return markers left by `{% return %}` tags.
     *
     * If one is found, the value passed to the `{% return %}` tag will be returned instead.
     *
     * @param mixed $response
     * @return mixed
     * @since 2.3.0
     */
    public static function processMacroResponse(mixed $response): mixed
    {
        if ($response instanceof Markup) {
            $markup = (string)$response;
            $markerPos = strpos($markup, '[RETURN_MARKER:');
            if ($markerPos !== false) {
                $endPos = strpos($markup, ']', $markerPos);
                $marker = substr($markup, $markerPos, $endPos - $markerPos + 1);
                if (array_key_exists($marker, self::$returnValues)) {
                    return self::$returnValues[$marker];
                }
            }
        }
        return $response;
    }

    public function init()
    {
        parent::init();

        // Custom initialization code goes here...
        // Add in our Twig extensions
        \Craft::$app->view->registerTwigExtension(new \marionnewlevant\twigperversion\twigextensions\TwigPerversionTwigExtension());
    }
}
