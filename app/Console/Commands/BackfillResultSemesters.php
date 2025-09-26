<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackfillResultSemesters extends Command
{
    protected $signature = 'results:backfill-semesters {--dry-run}';
    protected $description = 'Backfill results.semester_id from enrollments or courses';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $count = 0;
        $missing = DB::table('results')->whereNull('semester_id')->get();

        foreach ($missing as $row) {
            $semesterId = null;

            if (!empty($row->enrollment_id)) {
                $enrollment = DB::table('course_enrollments')->where('id', $row->enrollment_id)->first();
                if ($enrollment && !empty($enrollment->semester_id)) {
                    $semesterId = (int) $enrollment->semester_id;
                }
            }

            if (!$semesterId) {
                $course = DB::table('courses')->where('id', $row->course_id)->first();
                if ($course && !empty($course->semester_id)) {
                    $semesterId = (int) $course->semester_id;
                }
            }

            if ($semesterId) {
                $count++;
                if ($dryRun) {
                    $this->line("Would update result {$row->id} -> semester {$semesterId}");
                } else {
                    DB::table('results')->where('id', $row->id)->update(['semester_id' => $semesterId]);
                }
            }
        }

        if ($dryRun) {
            $this->info("Dry run complete. {$count} would be updated.");
        } else {
            $this->info("Backfill complete. {$count} rows updated.");
        }

        return self::SUCCESS;
    }
}


