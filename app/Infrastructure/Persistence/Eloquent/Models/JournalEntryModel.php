<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Models\JournalEntry as BaseJournalEntry;

class JournalEntryModel extends BaseJournalEntry
{
    protected $table = 'journal_entries';
}
