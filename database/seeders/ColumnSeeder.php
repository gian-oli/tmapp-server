<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Column;

class ColumnSeeder extends Seeder
{
    protected $swimlaneId;

    public function __construct($swimlaneId)
    {
        $this->swimlaneId = $swimlaneId;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedColumns($this->swimlaneId);
    }

    protected function seedColumns($swimlaneId)
    {
        $columns = ['Backlog', 'Ready', 'Work in Progress', 'Done'];

        foreach ($columns as $columnName) {
            Column::create([
                'column_name' => $columnName,
                'swimlane_id' => $swimlaneId,
            ]);
        }
    }
}
