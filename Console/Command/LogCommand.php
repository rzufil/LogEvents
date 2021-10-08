<?php

namespace Rzufil\LogEvents\Console\Command;

use Magento\Framework\Event\Config\Reader;
use Magento\Framework\Stdlib\ArrayUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LogCommand extends Command
{
    protected Reader $configReader;
    
    public function __construct(Reader $configReader, ArrayUtils $arrayUtils)
    {
        parent::__construct(null);
        $this->configReader = $configReader;
        $this->arrayUtils = $arrayUtils;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('rzufil:events:log');
        $this->setDescription('Log Magento observer events.');
        $options = [
            new InputOption(
                'scope',
                '-s',
                InputOption::VALUE_OPTIONAL,
                'Scope'
            ),
            new InputOption(
                'options',
                '-o',
                InputOption::VALUE_NONE,
                'Scope options'
            ),
        ];
        $this->setDefinition($options);
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $areas = [
            'global',
            'adminhtml',
            'crontab',
            'frontend',
            'graphql',
            'webapi_rest',
            'webapi_soap'
        ];
        if ($input->getOption('options')) {
            $output->writeln('Scope Options:');
            $output->writeln(implode(PHP_EOL, $areas));
            return;
        }
        $scope = $input->getOption('scope');
        if (in_array($scope, $areas)) {
            $areas = [$scope];
        }
        $events = [];
        foreach ($areas as $area) {
            $events[] = array_keys($this->configReader->read($area));
        }
        $output->writeln(implode(PHP_EOL, $this->arrayUtils->flatten($events)));
    }
}