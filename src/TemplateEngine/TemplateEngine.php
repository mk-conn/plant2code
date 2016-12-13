<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\TemplateEngine;


interface TemplateEngine
{
    /**
     * @param string $template
     * @param array  $data
     *
     * @return mixed
     */
    public function render(string $template, array $data): string;

    /**
     * @param string $extension
     *
     * @return mixed
     */
    public function setTemplateExtension(string $extension);

    /**
     * @param string $templateDir
     *
     * @return mixed
     */
    public function setTemplateDir(string $templateDir);

}