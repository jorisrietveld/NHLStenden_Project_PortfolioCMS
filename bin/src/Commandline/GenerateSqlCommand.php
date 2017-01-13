<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 14:08
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace JorisRietveld\Commandline;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSqlCommand extends Command
{
    protected $dsn = 'mysql:host=127.0.0.1;dbname=DigitalPortfolio;port=3306';
    protected $username = 'root';
    protected $password = 'toor';
    protected $schema = 'DigitalPortfolio';
    protected $outputFile = BIN_DIR . '..'. DIRECTORY_SEPARATOR . 'Install'.DIRECTORY_SEPARATOR.'phpSqlStatements.sql';

    /**
     * @var \PDO
     */
    protected $pdo;

    protected function configure()
    {
        $this->setName('generate:sql')
            ->setDescription('Generates insert, update, delete and select statements of the database.')
            ->setDefinition( [
                new InputOption( 'dsn', 'd', InputOption::VALUE_OPTIONAL, 'The data source name of the database.', $this->dsn ),
                new InputOption( 'schema', 's', InputOption::VALUE_OPTIONAL, 'The schema to dump from the database.', $this->schema ),
                new InputOption( 'username', 'u', InputOption::VALUE_OPTIONAL, 'The username of the database.', $this->username ),
                new InputOption( 'password', 'p', InputOption::VALUE_OPTIONAL, 'The password of the database.', $this->password ),
                new InputOption( 'outputfile', 'o', InputOption::VALUE_OPTIONAL, 'The output file to write the SQL to', $this->outputFile ),
            ])
            ->setHelp(<<<EOT
Generate sql SELECT, INSERT, DELETE AND UPDATE statements for an database.

Usage:

<info>php console.php written by Joris Rietveld</info>

You can specify a domain name string with the -d argument. 
<info>php console.php generate:sql -d mysql:host=127.0.0.1;dbname=DigitalPortfolio/info>

You can specify a username with the -u argument. 
<info>php console.php generate:sql -u root</info>

You can specify a password with the -p argument. 
<info>php console.php generate:sql -p toor</info>

You can specify a output file with the -o argument. 
<info>php console.php generate:sql -o statement.sql</info>
EOT
            );
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $header_style = new OutputFormatterStyle('green', 'black' );
        $output->getFormatter()->setStyle('header', $header_style);

        $this->dsn = $input->getOption( 'dsn');
        $this->username = $input->getOption( 'username' );
        $this->password =  $input->getOption( 'password' );
        $this->schema = $input->getOption( 'schema' );
        $this->outputFile = $input->getOption( 'outputfile');

        $database = new Database( $this->dsn, $this->schema, $this->username, $this->password, $this->outputFile );

        $database->generateSql();
        $output->writeln( sprintf( 'The SQL file was generated at: %s', $this->outputFile ) );
    }
}