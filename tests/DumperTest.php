<?php

declare(strict_types=1);

namespace Fi1a\Unit\VarDumper;

use Fi1a\DI\Builder;
use Fi1a\VarDumper\Dumper;
use Fi1a\VarDumper\DumperInterface;
use Fi1a\VarDumper\Handlers\HtmlHandler;
use Fi1a\VarDumper\Nodes\Options;
use PHPUnit\Framework\TestCase;

/**
 * Выводит и оформляет информацию о переменной
 *
 * @runInSeparateProcess
 */
class DumperTest extends TestCase
{
    /**
     * Выводит и оформляет информацию о переменной
     */
    public function testDump(): void
    {
        $dumper = $this->getMockBuilder(Dumper::class)
            ->onlyMethods(['handle'])
            ->getMock();

        $dumper->pushHandler(new HtmlHandler());
        $dumper->pushHandler(new HtmlHandler());

        $dumper->expects($this->exactly(2))->method('handle');

        $dumper->dump('string', new Options());
    }

    /**
     * Устанавливает максимальную вложенность
     */
    public function testSetMaxNestedLevel(): void
    {
        $dumper = $this->getMockBuilder(Dumper::class)
            ->onlyMethods(['handle'])
            ->getMock();

        $dumper->pushHandler(new HtmlHandler());

        $dumper->expects($this->once())->method('handle');

        $dumper->dump([0 => [0 => [0 => [0 => [0 => [0 => [0 => [0 => [0 => []]]]]]]]]], new Options());
    }

    /**
     * Обработчики
     */
    public function testHandlers(): void
    {
        $dumper = $this->getMockBuilder(Dumper::class)
            ->onlyMethods(['handle'])
            ->getMock();

        $dumper->pushHandler(new HtmlHandler());
        $dumper->pushHandler(new HtmlHandler());

        $dumper->expects($this->exactly(2))->method('handle');

        $dumper->dump('string', new Options());
        $dumper->clearHandlers();
        $dumper->dump('string', new Options());
    }

    /**
     * Обработчики
     */
    public function testCallPlace(): void
    {
        $dumper = $this->getMockBuilder(Dumper::class)
            ->onlyMethods(['handle'])
            ->getMock();

        $dumper->pushHandler(new HtmlHandler());

        $dumper->expects($this->once())->method('handle');

        di()->config()->addDefinition(
            Builder::build(DumperInterface::class)
                ->defineObject($dumper)
            ->getDefinition()
        );

        dump(null);
    }
}
