<?php
namespace Arcturial\FormBuilder;

class FormBuilder
{
    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;

        $twig->getLoader()->addPath(__DIR__ . '/templates/');
    }

    public function add($type, array $attrs = array())
    {
        $this->elements[] = new Element($type, $attrs);
    }

    public function build($templatePath)
    {
        $body = '';

        foreach ($this->elements as $element) {
            $body = $this->twig->render($templatePath . '/' . $element->getType() . '.html.twig', $element->getAttrs());
        }

        return $body;
    }
}