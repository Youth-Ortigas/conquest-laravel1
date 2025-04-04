<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Puzzle;
use App\Models\PuzzleAttempt;
use App\Models\PuzzleGameState;

use App\Http\Requests\ValidatePuzzleKeyRequest;

/**
 * Class PuzzlesController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Mar 30, 2025
 */
class PuzzleController extends Controller
{
    /**
     * [View] Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        return view('puzzles');
    }

    /**
     * [View] Details page
     * @param Request $request
     * @param $reference
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object|void
     */
    public function getDetails(Request $request, $reference)
    {
        if(view()->exists("puzzles/puzzles-$reference")) {
            return view("puzzles/puzzles-$reference");
        }

        abort(404);
    }

    /**
     * validatePuzzleKey
     *
     * @param  mixed $request
     * @return void
     */
    public function validatePuzzleKey(ValidatePuzzleKeyRequest $request)
    {
        $enteredKey = strtolower($request->puzzle_key);
        $puzzleNum = $request->puzzle_num;

        $puzzle = Puzzle::where('puzzle_num', $puzzleNum)->first();

        if (!$puzzle) {
            return response()->json([
                'status' => 'error',
                'message' => 'Puzzle not found.'
            ], 404);
        }

        $puzzleKeys = json_decode($puzzle->puzzle_key, true);
        $isCorrect = false;

        if (is_array($puzzleKeys) && in_array($enteredKey, $puzzleKeys)) {
            $isCorrect = true;
        } elseif ($enteredKey === $puzzleKeys) {
            $isCorrect = true;
        }

        // Store attempt
        PuzzleAttempt::create([
            'user_id' => 1, //test only; Replace with auth()->id()
            'puzzle_num' => $puzzleNum,
            'entered_key' => $enteredKey,
            'is_correct' => $isCorrect,
        ]);

        if ($isCorrect) {
            return response()->json([
                'status' => 'success',
                'message' => 'Puzzle unlocked!',
                'next_puzzle' => url("/puzzles/{$puzzle->unlock_puzzle}")
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => "You're almost there! Try again."
        ], 400);
    }

    /**
     * Fetch a random word from the puzzle's array and start the game.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWordleWord()
    {
        $puzzle = Puzzle::where('puzzle_num', 2.1)->first();

        if ($puzzle && isset($puzzle->puzzle_key) && is_array(json_decode($puzzle->puzzle_key))) {
            $gameState = PuzzleGameState::where('user_id', 1)
                                    ->where('puzzle_num', 2.1)
                                    ->first();

            if ($gameState) {
                $gameState = json_decode($gameState->game_state, true);

                if(!session('current_word'))
                    Session::put('current_word', $gameState['answer']);
            } else {
                $puzzleKeys = json_decode($puzzle->puzzle_key, true);

                $attemptedWords = PuzzleAttempt::where('user_id', 1)
                                            ->where('puzzle_num', 2.1)
                                            ->where('is_correct', 1)
                                            ->pluck('entered_key')
                                            ->toArray();

                $availableWords = array_filter($puzzleKeys, fn($word) => !in_array(strtolower($word), array_map('strtolower', $attemptedWords)));

                if (empty($availableWords) || count($attemptedWords) == 3) {
                    return response()->json([
                        'status' => empty($attemptedWords) ? 'error' : 'complete',
                        'message' => empty($attemptedWords) ? 'No words available.' : 'All Wordle words have been attempted.'
                    ]);
                }

                $randomWord = $availableWords[array_rand($availableWords)];

                Session::put('current_word', $randomWord);
            }

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Puzzle not found or invalid puzzle_key format.']);
    }


    /**
     * Check the user's guess against the correct word.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkWordleGuess(Request $request)
    {
        $word = Session::get('current_word');
        $guess = strtoupper($request->input('guess'));

        if (!$word) {
            return response()->json(['status' => 'error', 'message' => 'Game not started.']);
        }

        $word = strtoupper($word);

        $feedback = $this->getGuessFeedback($word, $guess);

        $isCorrect = ($guess === $word);

        if ($isCorrect) {
            Session::forget('current_word');
        }

        if (!is_array($feedback) || count($feedback) !== 5) {
            return response()->json(['status' => 'error', 'message' => 'Invalid feedback received.']);
        }

        PuzzleAttempt::create([
            'user_id' => 1,
            'puzzle_num' => 2.1,
            'entered_key' => $guess,
            'is_correct' => $isCorrect ? 1 : 0,
        ]);

        return response()->json([
            'feedback' => $feedback,
            'correct' => $isCorrect,
        ]);
    }

    /**
     * Compare the user's guess with the correct word and generate feedback.
     *
     * @param  string  $word
     * @param  string  $guess
     * @return array
     */
    private function getGuessFeedback($word, $guess)
    {
        $feedback = [];

        for ($i = 0; $i < strlen($word); $i++) {
            if ($guess[$i] === $word[$i]) {
                $feedback[] = 'correct';
            } elseif (strpos($word, $guess[$i]) !== false) {
                $feedback[] = 'present';
            } else {
                $feedback[] = 'absent';
            }
        }

        if (count($feedback) !== 5) {
            \Log::debug('Invalid feedback length: ', ['feedback_length' => count($feedback)]);
        }

        return $feedback;
    }
}
