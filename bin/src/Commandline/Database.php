<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 03-01-2017 14:59
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace JorisRietveld\Commandline;


use SebastianBergmann\CodeCoverage\RuntimeException;

class Database
{
    protected $dsn;
    protected $schema;
    protected $username;
    protected $password;

    /**
     * @var \PDO
     */
    protected $pdo;

    protected $tables;
    protected $outputFileName;

    public function __construct( string $dsn, string $schema, string $username, string $password, string $outputFile )
    {
        $this->dsn = $dsn;
        $this->schema = $schema;
        $this->username = $username;
        $this->password = $password;
        $this->outputFileName = $outputFile;
    }

    protected function connectToDatabase(  )
    {
        $this->pdo = new \PDO( $this->dsn, $this->username, $this->password );
    }

    protected function getAllTables(  )
    {
        $sql = '
          SELECT `TABLE_NAME` AS \'table\' FROM `INFORMATION_SCHEMA`.`TABLES`
          WHERE `TABLE_SCHEMA`=\'DigitalPortfolio\'
          ';

        $statement = $this->pdo->query( $sql, \PDO::FETCH_ASSOC );

        return $statement->fetchAll();

    }

    protected function getAllColumnNamesFromTable( string $tableName )
    {
        $sql = '
        SELECT `COLUMN_NAME` AS \'column\' FROM `INFORMATION_SCHEMA`.`COLUMNS` 
        WHERE `TABLE_SCHEMA`=\'DigitalPortfolio\' AND `TABLE_NAME`=\'' . $tableName . '\';
        ';

        $statement = $this->pdo->query( $sql, \PDO::FETCH_ASSOC );
        return $statement->fetchAll();
    }

    protected function generateSelectStatement( string $table, array $columns )
    {
        $sql = "\n/**\n * Select statement for {$table}\n*/";
        $sql .= "\nSELECT\n";

        $columnCount = count( $columns );
        $iterationCount = 1;

        foreach ( $columns as $column )
        {
            $sql .= ($iterationCount < $columnCount ) ? "\t`{$table}`.`{$column['column']}`,\n":"\t`{$table}`.`{$column['column']}`\n";
            $iterationCount++;
        }
        $sql = rtrim($sql,',\n');

        $sql .= "FROM `{$this->schema}`.`{$table}`\n";

        return $sql;
    }

    protected function generateSelectByIdStatement( string $table, array $columns )
    {
        return rtrim( $this->generateSelectStatement( $table, $columns ), ';') . "WHERE `{$table}`.`{$columns[0]['column']}` = :id;\n";
    }

    protected function generateInsertStatement( string $table, array $columns )
    {
        $sql = "\n/**\n * Insert statement for {$table}\n*/\n";
        $sql .= "INSERT INTO `{$this->schema}`.`{$table}`( \n";

        $values = ") VALUES ( \n";

        $columnCount = count($columns );
        $iterationCount = 1;

        foreach ( $columns as $column )
        {
            $sql .= ( $iterationCount < $columnCount ) ? "\t`{$column['column']}`,\n" : "\t`{$column['column']}`\n";
            $values .= ($iterationCount < $columnCount ) ? "\t:{$column['column']},\n" : "\t:{$column['column']}\n";
            $iterationCount++;
        }

        $sql .= $values . ');';

        return $sql;
    }

    protected function generateUpdateStatement( string $table, array $columns )
    {
        $sql = "\n/**\n * Update statement for {$table}\n*/\n";
        $sql .= "UPDATE {$table} SET \n";

        $columnCount = count($columns );
        $iterationCount = 1;

        foreach ( $columns as $column )
        {
            $sql .= ($iterationCount < $columnCount ) ? "\t`{$column['column']}` = :{$column['column']},\n" : "\t`{$column['column']}` = :{$column['column']}\n";
            $iterationCount++;
        }

        $sql .= "WHERE `{$table}`.`{$columns[0]['column']}` = :id;\n";

        return $sql;

    }

    protected function generateDeleteStatement( string $table, array $columns )
    {
        $sql = "\n/**\n * Delete statement for {$table}\n*/\n";
        $sql .= "DELETE FROM {$table} WHERE `{$table}`.`{$columns[0]['column']}` = :id;";

        return $sql;
    }

    public function generate(  )
    {

        //$output = "/**\n";
        //$output .= " * Automatic generated SQL insert, update, delete and select .\n";
        //$output .= " */\n\n";

        $output = '';
        foreach ( $this->getAllTables() as $table )
        {
            $output .= "/*****************************************************************************************\n";
            $output .= " * Insert, update, delete and select statements for the table {$table['table']}.\n";
            $output .= " ****************************************************************************************/\n";
            $output .= $this->generateSelectStatement( $table['table'], $this->getAllColumnNamesFromTable( $table['table'] ) ).";\n";
            $output .= $this->generateUpdateStatement( $table['table'], $this->getAllColumnNamesFromTable( $table['table'] ) )."\n";
            $output .= $this->generateDeleteStatement( $table['table'], $this->getAllColumnNamesFromTable( $table['table'] ) )."\n";
            $output .= $this->generateSelectByIdStatement( $table['table'], $this->getAllColumnNamesFromTable( $table['table'] ) )."\n";
            $output .= $this->generateInsertStatement( $table['table'], $this->getAllColumnNamesFromTable( $table['table'] ) )."\n\n";
        }

        return $output;
    }

    protected function writeToFile( string $data )
    {

        if ( $filePointer = fopen( $this->outputFileName, 'x' ) )
        {
            fwrite( $filePointer, $data );
            fclose( $filePointer );
            return;
        }
        else
        {
            throw new \RuntimeException( 'Couldn\'t write to the file: ' . $this->outputFileName );
        }
    }

    public function generateSql(  )
    {
        $this->connectToDatabase();
        $this->writeToFile( $this->generate() );
    }
}