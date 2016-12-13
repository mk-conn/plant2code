<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Collection;
use Plant2Code\TemplateEngine\TwigEngine;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PlantUmlParser
 *
 * @package Plant2Code
 */
class PlantUmlConverter
{
    /**
     * @var string
     */
    protected $outputDir;
    /**
     * @var
     */
    protected $language = 'php';

    /**
     * @var Renderer
     */
    protected $renderer;
    /**
     * @var Collection
     */
    protected $classes;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * PlantUmlParser constructor.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws FileNotFoundException
     */
    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $srcFile = $input->getArgument('input');
        $this->outputDir = $input->getArgument('output');
        $this->language = $input->getArgument('language') ?: $this->language;

        if (!is_file($srcFile)) {
            throw new FileNotFoundException("PlantUml file $srcFile could not be found.");
        }

        $this->parser = new Parser(file_get_contents($srcFile), $this->language);

        if (!is_dir($this->outputDir)) {
            throw new FileNotFoundException("Output directory {$this->outputDir} does not exists.");
        }

        $this->sanitizeOutputDir()
             ->initRenderer();
    }

    /**
     * @return PlantUmlConverter
     */
    protected function sanitizeOutputDir(): PlantUmlConverter
    {
        if (!starts_with($this->outputDir, '/')) {
            // relative path given - find out, where we are...
            $runDir = run_path();
            $this->outputDir = $runDir . '/' . $this->outputDir;
        }

        return $this;
    }


    /**
     * @return PlantUmlConverter
     */
    protected function initRenderer(): PlantUmlConverter
    {
        $templateEngine = new TwigEngine([
            'templateDir'       => __DIR__ . '/templates/twig/' . $this->language,
            'templateExtension' => 'twig'
        ]);

        $this->renderer = new Renderer(
            __DIR__ . '/templates',
            $templateEngine
        );

        return $this;
    }


    /**
     *
     */
    public function convertAndWrite()
    {
        $this->convert()
             ->write();
    }

    /**
     * @return PlantUmlConverter
     */
    public function convert(): PlantUmlConverter
    {
        $this->classes = $this->parser->parse();

        $this->classes = $this->classes->map(function (&$item, $key) {
            $item['rendered'] = $this->renderer->setClass($item['class'])
                                               ->render();
            $item['meta']['folder'] = $this->outputDir . '/' . $item['meta']['folder'];

            return $item;
        });

        return $this;
    }


    /**
     * @return $this
     */
    public function write()
    {
        $this->classes->each(function ($item, $key) {

            $filename = $item['meta']['folder'] . '/' . $item['meta']['filename'];
            if (!is_dir($item['meta']['folder'])) {
                mkdir($item['meta']['folder']);
            }

            file_put_contents($filename, $item['rendered']);

            $this->output->writeln('<info>' . $item['meta']['folder'] . '/' . $item['meta']['filename'] . ' written.</info>');
        });

        return $this;
    }


}
