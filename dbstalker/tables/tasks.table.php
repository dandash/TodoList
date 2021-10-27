<?php
class Tasks extends Stalker_Table
{
    public function schema()
    {
        return Stalker_Schema::build(function ($table) {
            $table->id("id")->primary();
            $table->text("taskname", 60);
            $table->varchar("priority", 20);
        });
    }
}
