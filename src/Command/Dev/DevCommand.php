<?php

namespace App\Command\Dev;

use App\DateTime\DateTimeFactory;
use App\TimeTableBuilder\Cell\CellList;
use App\TimeTableBuilder\TimeTable;

class DevCommand extends Command
{
    public function __construct(
        DateTimeFactory $dateTimeFactory
    ) {
        parent::__construct();
        $this->dateTimeFactory = $dateTimeFactory;
    }

    protected function configure()
    {
        $this
            ->setName('dev:test')
            ->setDescription('dev command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        tstart('full');
        $indents = [];
        $indents[] = '4IZ238';
        $indents[] = '4IZ278';
        $indents[] = '4ST201';
        $indents[] = '4IT101';
        $indents[] = '4EK112';
        $indents[] = '5EN101';
        $indents[] = '2AJ112';

        dump($indents);
        $subjects = $this->subjectFacade->getByIndents($indents);
        dump(count($subjects));
        $tables = $this->timeTableBuilder->getTimeTablesMulti($subjects);
        dump(count($tables));

        /** @var TimeTable $table */
        foreach ($tables as $table) {
            dump($table->calculateIndex());
        }
        tend('full');
        die;
        dump(count($subjects));
        $items = $this->timeTableItemFacade->getBySubjects($subjects);
        dump(count($items));

        $cellList = CellList::constructFromTimeTableItems($items);
        dump(count($cellList->getCells()));
    }
}