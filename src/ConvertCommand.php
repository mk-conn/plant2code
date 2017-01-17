<?php

namespace Plant2Code;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */
class ConvertCommand extends Command
{

    /**
     *
     */
    protected function configure()
    {
        $this->setName('plant2code:convert')
             ->setDescription('Creates PHP classes based on PlantUML description')
             ->addArgument('input', InputArgument::REQUIRED, 'The plantuml file')
             ->addOption(
                 '--output',
                 '-o',
                 InputOption::VALUE_OPTIONAL,
                 'Output directory (defaults to the directory of the input file'
             )
             ->addOption('--lang', '-l', InputOption::VALUE_OPTIONAL, 'Output language (defaults to PHP)')
             ->addOption('root-ns', '-r', InputOption::VALUE_OPTIONAL, 'Root namespace, optional');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // generate xmi
        try {
            $puml = $input->getArgument('input');
            $runPath = run_path();
            $fileInfo = pathinfo($puml);

            $output->writeln('<info>Creating XMI file.</info>');

            $command = "java -jar $runPath/plantuml.jar $puml -xmi:star";
            system($command);
            $output->writeln('<info>Finished XMI creation.</info>');

            $input->setArgument('input', $fileInfo['dirname'] . '/' . $fileInfo['filename'] . '.xmi');

            $output->writeln('<info>Detecting classes and writing output...</info>');
            $converter = new PlantUmlConverter($input, $output);
            $converter->convertAndWrite();
        } catch (Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
        }
    }
}
