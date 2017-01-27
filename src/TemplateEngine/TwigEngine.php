<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\TemplateEngine;


/**
 * Class TwigEngine
 *
 * @package Plant2Code\TemplateEngine
 */
class TwigEngine extends Engine
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;
    /**
     * @var
     */
    protected $templateDir;

    /**
     * TwigEngine constructor.
     *
     * @param array $options
     */
    public function __construct($options)
    {
        parent::__construct($options);

        $loader = new \Twig_Loader_Filesystem($this->templateDir);
        $this->twig = new \Twig_Environment($loader, ['debug' => true]);
        $this->twig->addExtension(new \Twig_Extension_Debug);
    }


    /**
     * @param string $template
     * @param array  $data
     *
     * @return string
     */
    public function render(string $template, array $data): string
    {

        $template = $this->adjustTemplateName($template);

        return $this->twig->render($template, $data);
    }

}