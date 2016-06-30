<?php
namespace App;

use Silex\Application as BaseApplication;
use Silex\Application\TwigTrait;

class Application extends BaseApplication
{
    use TwigTrait;

    public function success($message)
    {
        $messages = $this['session']->get('messsages') || [];
        $messages[] = new Message('success', $message);
        $this['session']->set('messages', $message);
    }
}

class Message
{
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getMessage()
    {
        return $this->message;
    }
}