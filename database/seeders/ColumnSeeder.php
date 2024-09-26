<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Column;

class ColumnSeeder extends Seeder
{
    protected $swimlaneId;
    protected $columns;

    public function __construct($swimlaneId, $columns)
    {
        $this->swimlaneId = $swimlaneId;
        $this->columns = $columns;
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
        // $columns = ['Backlog', 'Ready', 'Work in Progress', 'Done'];

        foreach ($this->columns as $columnName) {
            Column::create([
                'column_name' => $columnName,
                'swimlane_id' => $swimlaneId,
            ]);
        }
    }
}
