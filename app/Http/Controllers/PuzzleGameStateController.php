<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuzzleGameState;

class PuzzleGameStateController extends Controller
{
    /**
     * Save the current game state to the database.
     */
    public function saveGameState(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'puzzle_num' => 'required|numeric',
            'game_state' => 'required|json',
        ]);

        $gameStateData = $request->input('game_state');
        $gameStateArray = json_decode($gameStateData, true);
        $gameStateArray['answer'] = session('current_word');

        if (!isset($gameStateArray['guesses'])) {
            $gameStateArray['guesses'] = [];
        }

        if ($gameStateArray['attempts'] == 6 || $gameStateArray['isCorrect'] == 1) {
            PuzzleGameState::where('user_id', $request->user_id)
                ->where('puzzle_num', $request->puzzle_num)
                ->delete();

            return response()->json(['status' => 'success', 'message' => 'Game state removed because attempts reached 6 or the word was correct.']);
        }

        $existingGameState = PuzzleGameState::where('user_id', $request->user_id)
                                            ->where('puzzle_num', $request->puzzle_num)
                                            ->first();

        if ($existingGameState) {
            $existingGameState->game_state = json_encode($gameStateArray);
            $existingGameState->save();
        } else {
            PuzzleGameState::create([
                'user_id' => $request->user_id,
                'puzzle_num' => $request->puzzle_num,
                'game_state' => json_encode($gameStateArray),
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Game state saved successfully']);
    }

    /**
     * Retrieve the saved game state from the database.
     */
    public function getGameState($userId, $puzzleNum)
    {
        $gameState = PuzzleGameState::where('user_id', $userId)
                                    ->where('puzzle_num', $puzzleNum)
                                    ->first();

        if ($gameState) {
             $gameStateArray = json_decode($gameState->game_state, true);

            unset($gameStateArray['answer']);

            return response()->json([
                'status' => 'success',
                'game_state' => $gameStateArray, // Return the game state as an array
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'No game state found.']);
    }

}
