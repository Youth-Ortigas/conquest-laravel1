<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Puzzle;
class PuzzleAttempt extends Model
{
    use HasFactory;

    protected $table = 'puzzle_attempts';

    protected $fillable = ['user_id', 'puzzle_num', 'entered_key', 'is_correct'];

    /**
     * getNextPuzzle
     *
     * @return void
     */
    public function getNextPuzzle()
    {
        $user = auth()->user();
        $correctAttempts = $user->puzzleAttempts()->where('is_correct', 1)->get();

        // Get the number of correct attempts for the current puzzle stage.
        $correctAttemptCount = $correctAttempts->count();

        // Find out the current puzzle the user is at
        $currentPuzzle = $this->determineCurrentPuzzleStage($correctAttemptCount);

        // Now determine the next puzzle based on the current puzzle stage
        switch ($currentPuzzle) {
            case 1:
                $nextPuzzle = '2nd-stage-1';
                break;

            case '2nd-stage-1':
                if ($correctAttemptCount >= Puzzle::REQUIRED_WORDLE_WORD_COUNT) {
                    $nextPuzzle = '2nd-stage-2';
                } else {
                    $nextPuzzle = '2nd-stage-1';
                }
                break;

            case '2nd-stage-2':
                $nextPuzzle = '2nd-stage-3';
                break;

            case '2nd-stage-3':
                $nextPuzzle = '3rd';
                break;

            default:
                $nextPuzzle = 'completed';
                break;
        }

        return response()->json([
            'next_puzzle' => $nextPuzzle,
            'correct_attempts' => $correctAttemptCount
        ]);
    }

    /**
     * Helper function to determine which puzzle stage the user is at.
     */
    private function determineCurrentPuzzleStage($correctAttemptCount)
    {
        if ($correctAttemptCount == 0) {
            return 1;
        } elseif ($correctAttemptCount == 1) {
            return '2nd-stage-1';
        } elseif ($correctAttemptCount == 4) {
            return '2nd-stage-2';
        } elseif ($correctAttemptCount == 5) {
            return '2nd-stage-3';
        } elseif ($correctAttemptCount >= 6) {
            return '3rd';
        }

        return 1; // Default return value if no matching stage is found
    }
}
