<?php

namespace App\Pipes;

use Cycle\Annotated\Embeddings;
use Cycle\Annotated\Entities;
use Cycle\Annotated\MergeColumns;
use Cycle\Annotated\MergeIndexes;
use Cycle\Annotated\TableInheritance;
use Cycle\Database;
use Cycle\Database\Config;
use Cycle\Database\DatabaseManager;
use Cycle\ORM\EntityManager;
use Cycle\ORM\Factory;
use Cycle\ORM\ORM;
use Cycle\ORM\Schema;
use Cycle\Schema\Compiler;
use Cycle\Schema\Generator\GenerateModifiers;
use Cycle\Schema\Generator\GenerateRelations;
use Cycle\Schema\Generator\GenerateTypecast;
use Cycle\Schema\Generator\RenderModifiers;
use Cycle\Schema\Generator\RenderRelations;
use Cycle\Schema\Generator\RenderTables;
use Cycle\Schema\Generator\ResetTables;
use Cycle\Schema\Generator\SyncTables;
use Cycle\Schema\Generator\ValidateEntities;
use Cycle\Schema\Registry;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Invoke\Container\Container;
use Invoke\Pipe;
use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Finder\Finder;

class CycleOrmPipe implements Pipe
{
    public function pass(mixed $value): mixed
    {
        $dbal = new Database\DatabaseManager(
            new Config\DatabaseConfig($value)
        );

        $finder = (new Finder())->files()->in([dirname(__DIR__, 1) . "/Models"]);
        $classLocator = new ClassLocator($finder);

        AnnotationRegistry::registerLoader("class_exists");

        $schema = (new Compiler())->compile(new Registry($dbal), [
            new ResetTables(),
            new Embeddings($classLocator),
            new Entities($classLocator),
            new TableInheritance(),
            new MergeColumns(),
            new GenerateRelations(),
            new GenerateModifiers(),
            new ValidateEntities(),
            new RenderTables(),
            new RenderRelations(),
            new RenderModifiers(),
            new MergeIndexes(),
            new SyncTables(),
            new GenerateTypecast(),
        ]);

        $orm = new ORM(new Factory($dbal), new Schema($schema));

        $container = Container::getInstance();

        $container->singleton(DatabaseManager::class, $dbal);
        $container->singleton(ORM::class, $orm);

        $container->factory(EntityManager::class, function (ORM $orm) {
            return new EntityManager($orm);
        });

        return $value;
    }
}