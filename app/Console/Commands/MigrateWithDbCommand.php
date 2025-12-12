<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use Symfony\Component\Console\Command\Command as CommandAlias;

class MigrateWithDbCommand extends Command
{
    protected $signature = 'migrate:with-db {--seed : Run database seeders after migration}';

    protected $description = 'Create main database if missing, then run migrations (optional: seed)';

    public function handle(): int
    {
        $connectionName = 'pgsql';
        $config = config("database.connections.$connectionName");

        $database = $config['database'];

        $this->info("Checking database '$database'...");

        $tempConfig = $config;
        $tempConfig['database'] = 'postgres';

        $pdo = $this->createTemporaryPdo($tempConfig);

        $exists = $pdo->query("SELECT 1 FROM pg_database WHERE datname = '$database'")->fetch();

        if (! $exists) {
            $this->warn("Database '$database' does not exist. Creating...");
            $pdo->exec("CREATE DATABASE \"$database\"");
            $this->info("Database '$database' successfully created!");
        } else {
            $this->info("Database '$database' already exists - OK");
        }

        $this->info('Running migrations...');
        $this->call('migrate');

        if ($this->option('seed')) {
            $this->info('Running seeders...');
            $this->call('db:seed');
        }

        $this->info('Done!');

        return CommandAlias::SUCCESS;
    }

    protected function createTemporaryPdo(array $config): PDO
    {
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}";

        return new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
}
