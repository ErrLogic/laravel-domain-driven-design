<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Models\JournalLine as BaseJournalLine;

class JournalLineModel extends BaseJournalLine
{
    protected $table = 'journal_lines';
}
