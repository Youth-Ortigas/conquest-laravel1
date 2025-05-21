<?php

namespace App\Http\Controllers;

use App\Models\PuzzleAttempt;
use App\Traits\TraitsCommon;
use Illuminate\Http\Request;
use App\Models\PuzzleGameState;

class PuzzleGameStateController extends Controller
{
    /**
     * [Traits] TraitsCommon class
     * @var object
     */
    use TraitsCommon;

    public function __construct()
    {

    }

    /**
     * Save the current game state to the database.
     */
    public function saveGameState(Request $request)
    {
        $request->validate([
            'puzzle_num' => 'required|numeric',
            'game_state' => 'required|json',
        ]);
        $team_id = $this->getAuthTeamID();

        if($request->puzzle_num == 2) {
            $gameStateData = $request->input('game_state');
            $gameStateArray = json_decode($gameStateData, true);
            $gameStateArray['answer'] = session('current_word');

            if (!isset($gameStateArray['guesses'])) {
                $gameStateArray['guesses'] = [];
            }

            if ($gameStateArray['attempts'] == 6 || $gameStateArray['isCorrect'] == 1) {
                PuzzleGameState::where('team_id', $team_id)
                    ->where('puzzle_num', $request->puzzle_num)
                    ->delete();

                return response()->json(['status' => 'success', 'message' => 'Game state removed because attempts reached 6 or the word was correct.']);
            }

            $existingGameState = PuzzleGameState::where('team_id', $team_id)
                                                ->where('puzzle_num', $request->puzzle_num)
                                                ->first();

            if ($existingGameState) {
                $existingGameState->game_state = json_encode($gameStateArray);
                $existingGameState->save();
            } else {
                PuzzleGameState::create([
                    'team_id' => $team_id,
                    'puzzle_num' => $request->puzzle_num,
                    'game_state' => json_encode($gameStateArray),
                ]);
            }
        } elseif(in_array($request->puzzle_num, [1,3])) {
            PuzzleGameState::updateOrCreate(
                [
                    'team_id'    => $team_id,
                    'puzzle_num' => $request->puzzle_num,
                ],
                ['game_state' => $request->game_state]
            );
        }

        return response()->json(['status' => 'success', 'message' => 'Game state saved successfully']);
    }

    /**
     * Retrieve the saved game state from the database.
     */
    public function getGameState($puzzleNum)
    {
        $teamId = $this->getAuthTeamID();

        $gameState = PuzzleGameState::where('team_id', $teamId)
                                    ->where('puzzle_num', $puzzleNum)
                                    ->first();

        if ($gameState) {
            $gameStateArray = json_decode($gameState->game_state, true);

            if(isset($gameStateArray['answer']))
                unset($gameStateArray['answer']);

            return response()->json([
                'status' => 'success',
                'game_state' => $gameStateArray,
            ]);
        }

        $puzzleAttempt = null;

        if ($puzzleNum != 2) {
            $puzzleAttempt = PuzzleAttempt::where('team_id', $teamId)
                                        ->where('puzzle_num', $puzzleNum)
                                        ->where('is_correct', 1)
                                        ->first();
        } else {
            $requiredCorrectAttempts = config('constants.REQUIRED_WORDLE_WORD_COUNT');

            $correctAttempts = PuzzleAttempt::where('puzzle_num', $puzzleNum)
                ->where('team_id', $teamId)
                ->where('is_correct', 1)
                ->get();

            if (count($correctAttempts) === $requiredCorrectAttempts) {
                $puzzleAttempt = $correctAttempts->first();
            }
        }

        if ($puzzleAttempt) {
            return response()->json([
                'status' => 'complete',
                'entered_key' => $puzzleAttempt->entered_key ?? null,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No game state found.',
        ]);
    }

}
