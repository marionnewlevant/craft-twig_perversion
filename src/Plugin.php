<?php
namespace marionnewlevant\twigperversion;

class Plugin extends \craft\base\Plugin
{
    public function init()
    {
        parent::init();

        // Custom initialization code goes here...
        // Add in our Twig extensions
        \Craft::$app->view->twig->addExtension(new \marionnewlevant\twigperversion\twigextensions\TwigPerversionTwigExtension());
    }
}