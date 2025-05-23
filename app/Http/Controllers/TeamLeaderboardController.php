<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use App\Models\PuzzleAttempt;
use App\Models\Teams;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeamLeaderboardController extends Controller
{
    public function index() {
        $teamLeaderboard = $this->getTeamLeaderboard();

        return view('team-leaderboards', compact('teamLeaderboard'));
    }

    public function getTeamLeaderboard($puzzleNum = 'all') {
        $teams = Teams::where('id', '!=', 11)->select('id', 'team_name')->get();
        $puzzleQuery = Puzzle::whereNot('puzzle_num', 4);

        if($puzzleNum === 'all')
            $puzzles = $puzzleQuery->get();
        else
            $puzzles = $puzzleQuery->where('puzzle_num', $puzzleNum)->get();

        $leaderboard = [];

        foreach ($teams as $team) {
            $totalTimeDifference = 0;
            $totalAttempts = 0;
            $totalCompleted = 0;

            foreach ($puzzles as $puzzle) {
                $attemptsQuery = PuzzleAttempt::where('team_id', $team->id)
                                            ->where('puzzle_num', $puzzle->puzzle_num);

                $numberOfAttempts = $attemptsQuery->count();

                $latestCorrectAttempt = (clone $attemptsQuery)
                    ->where('is_correct', 1)
                    ->orderByDesc('created_at')
                    ->first();

                $isComplete = 0;
                $timeDifference = 0;

                if ($latestCorrectAttempt) {
                    $timeDifference = Carbon::parse($puzzle->date_unlocked)
                        ->diffInSeconds(Carbon::parse($latestCorrectAttempt->created_at));

                    if ($puzzle->puzzle_num === 2) {
                        $correctCount = (clone $attemptsQuery)->where('is_correct', 1)->count();
                        $isComplete = ($correctCount === config('constants.REQUIRED_WORDLE_WORD_COUNT')) ? 1 : 0;
                    } else {
                        $isComplete = 1;
                    }
                }

                $totalTimeDifference += $timeDifference;
                $totalAttempts += $numberOfAttempts;
                $totalCompleted += $isComplete;
            }

            $leaderboard[] = [
                'team_id' => $team->id,
                'team_name' => $team->team_name,
                'isComplete' => $totalCompleted,
                'timeDifference' => $totalTimeDifference,
                'attempts' => $totalAttempts,
                'timeDiffFormatted' => $this->formatHoursMinutesSeconds($totalTimeDifference),
            ];
        }

        // Sort according to your rules:
        $leaderboard = collect($leaderboard)->sort(function ($a, $b) {
            if ($a['isComplete'] !== $b['isComplete']) {
                return $b['isComplete'] <=> $a['isComplete'];
            }
            if ($a['timeDifference'] !== $b['timeDifference']) {
                return $a['timeDifference'] <=> $b['timeDifference'];
            }
            return $a['attempts'] <=> $b['attempts'];
        })->values();

        // Add ordinal rank
        $leaderboard = $leaderboard->map(function ($team, $index) {
            $rank = $index + 1;

            if (($rank % 100) >= 11 && ($rank % 100) <= 13) {
                $suffix = 'th';
            } else {
                switch ($rank % 10) {
                    case 1: $suffix = 'st'; break;
                    case 2: $suffix = 'nd'; break;
                    case 3: $suffix = 'rd'; break;
                    default: $suffix = 'th';
                }
            }

            $team['rankOrdinal'] = $rank . $suffix;
            return $team;
        });

        return $leaderboard->toArray();
    }


    private function formatHoursMinutesSeconds(int $totalSeconds): string {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        $hoursLabel = $hours === 1 ? 'hour' : 'hours';
        $minutesLabel = $minutes === 1 ? 'min' : 'mins';
        $secondsLabel = $seconds === 1 ? 'sec' : 'secs';

        $result = '';

        if ($hours > 0) {
            $result .= $hours . ' ' . $hoursLabel;
            if ($minutes > 0 || $seconds > 0) {
                $result .= ' ';
            }
        }

        if ($minutes > 0) {
            $result .= $minutes . $minutesLabel;
            if ($seconds > 0) {
                $result .= ' ';
            }
        }

        if ($seconds > 0) {
            $result .= $seconds . $secondsLabel;
        }

        if ($result === '') {
            $result = '0sec';
        }

        return $result;
    }

}
