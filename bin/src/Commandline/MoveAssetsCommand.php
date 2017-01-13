<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 05-01-2017 20:45
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace bin\src\Commandline;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MoveAssetsCommand extends Command
{
    protected $assetManager;

    protected function configure()
    {
        $this->setName('install:assets')
            ->setDescription('Installs all assets from the Themes directory to the public web directory.');
    }

    protected function execute( InputInterface $input, OutputInterface $output)
    {
        $header_style = new OutputFormatterStyle('green', 'black' );
        $output->getFormatter()->setStyle('header', $header_style);

        $this->assetManager = new AssetManager();

    }
}