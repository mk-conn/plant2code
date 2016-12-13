<?php

namespace Plant2Code;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
             ->addArgument('output', InputArgument::REQUIRED, 'The output directory')
             ->addArgument('language', InputArgument::OPTIONAL, 'The output language (defaults to PHP)');

    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // generate xmi
        try {
            $puml = $input->getArgument('input');
            $fileInfo = pathinfo($puml);

            $output->writeln('<info>Creating XMI file.</info>');
            $command = "java -jar plantuml.jar $puml -xmi:star";
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