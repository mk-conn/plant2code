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
use Symfony\Component\Console\Style\SymfonyStyle;

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
    public function __construct(InputInterface $input, OutputInterface $output, SymfonyStyle $io)
    {
        $this->output = $output;
        $this->io = $io;
        $srcFile = $input->getArgument('input');
        $this->outputDir = $input->getOption('output');
        $this->language = $input->getOption('lang') ?: $this->language;
        $rootNS = $input->getOption('root-ns');

        if (!is_file($srcFile)) {
            throw new FileNotFoundException("PlantUml file $srcFile could not be found.");
        }

        $this->parser = new Parser(file_get_contents($srcFile), $this->language, $rootNS);

        $this->initRenderer();

        if (!is_dir($this->outputDir)) {
            throw new FileNotFoundException("Output directory {$this->outputDir} does not exists.");
        }
    }

    /**
     * @return PlantUmlConverter
     */
    protected function initRenderer(): PlantUmlConverter
    {
        $templateEngine = new TwigEngine(
            [
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
     * Convert and write classes
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

        $this->classes = $this->classes->map(
            function (&$item) {
                $item['rendered'] = $this->renderer->setClass($item['class'])
                                                   ->render();
                $item['meta']['folder'] = $this->outputDir . '/' . $item['meta']['folder'];

                return $item;
            });

        return $this;
    }


    /**
     * @return PlantUmlConverter
     */
    public function write(): PlantUmlConverter
    {
        $io = $this->io;
        $this->io->progressStart(count($this->classes));
        $written = [];

        $this->classes->each(
            function ($item, $key) use ($io, &$written) {

                $filename = $item['meta']['folder'] . '/' . $item['meta']['filename'];
                if (!is_dir($item['meta']['folder'])) {
                    mkdir($item['meta']['folder'], $mode = 0777, $recursive = true);
                }

                file_put_contents($filename, $item['rendered']);
                $io->progressAdvance();
                $written[] = $item['meta']['folder'] . '/' . $item['meta']['filename'];
            });

        $this->io->newLine(2);
        $this->io->section('Written classes:');
        $this->io->listing($written);

        return $this;
    }


}
