<?php

namespace Andaniel05\LaravelFlows\PHPUnitExtension;

use PHPUnit\Event\Application\Started;
use PHPUnit\Event\Application\StartedSubscriber;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class ApplicationStartedSubscriber implements StartedSubscriber
{
    public static array $flowClasses = [];

    public static array $verifiedFlowClasses = [];

    public function notify(Started $event): void
    {
        // Discover flow classes in app directory
        //

        $flowsDir = __DIR__ . '/../../../../../app';
        $fileNameList = [];

        $flowFileNames = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($flowsDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $filename = $file->getFilename();

            if (str_ends_with(haystack: $filename, needle: 'Flow.php')) {
                $flowFileNames[] = $file->getPathname();
            }
        }

        $declaredClassesBefore = get_declared_classes();

        foreach ($flowFileNames as $flowFileName) {
            require_once $flowFileName;
        }

        $declaredClassesAfter = get_declared_classes();
        $newClasses = array_diff($declaredClassesAfter, $declaredClassesBefore);

        $flowClasses = array_filter($newClasses, function (string $class): bool {
            if (! str_starts_with(haystack: $class, needle: 'App')) {
                return false;
            }

            return str_ends_with(haystack: $class, needle: 'Flow');
        });

        self::$flowClasses = $flowClasses;
    }
}
