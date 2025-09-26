<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackfillStudentSemester extends Command
{
    protected $signature = 'students:backfill-semester {--dry-run}';
    protected $description = 'Backfill students.semester from latest approved course_enrollments';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $students = DB::table('students')->get(['id','semester']);
        $updated = 0;

        foreach ($students as $s) {
            $latest = DB::table('course_enrollments')
                ->where('student_id', $s->id)
                ->where('status', 'Approved')
                ->orderByDesc('id')
                ->first();

            if ($latest && !empty($latest->semester_id)) {
                if ((int)($s->semester ?? 0) !== (int)$latest->semester_id) {
                    $updated++;
                    if ($dryRun) {
                        $this->line("Would update student {$s->id} semester -> {$latest->semester_id}");
                    } else {
                        DB::table('students')->where('id', $s->id)->update(['semester' => $latest->semester_id]);
                    }
                }
            }
        }

        if ($dryRun) {
            $this->info("Dry run complete. {$updated} would be updated.");
        } else {
            $this->info("Backfill complete. {$updated} students updated.");
        }

        return self::SUCCESS;
    }
}
