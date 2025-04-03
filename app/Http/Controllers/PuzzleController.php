<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;
use App\Models\PuzzleAttempt;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\ValidatePuzzleKeyRequest;

/**
 * Class PuzzlesController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
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

        // Fetch puzzle from DB
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
            $unlockPuzzle = ordinal($puzzle->unlock_puzzle);
            return response()->json([
                'status' => 'success',
                'message' => 'Puzzle unlocked!',
                'next_puzzle' => url("/puzzles/{$unlockPuzzle}")
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
    public function getWordleWord(Request $request)
    {
        // Fetch the puzzle where puzzle_num is 2
        $puzzle = Puzzle::where('puzzle_num', 2)->first();

        if ($puzzle && isset($puzzle->puzzle_key) && is_array(json_decode($puzzle->puzzle_key))) {
            // Decode the JSON string into an array
            $puzzleKeys = json_decode($puzzle->puzzle_key, true);

            // Get already guessed words from the database (e.g., PuzzleAttempt table)
            $attemptedWords = PuzzleAttempt::where('user_id', auth()->id())
                                        ->where('puzzle_num', 2)
                                        ->pluck('entered_key')
                                        ->toArray();

            // Remove attempted words from the available puzzle keys
            $availableWords = array_diff($puzzleKeys, $attemptedWords);

            // If there are no more words left, return an error
            if (empty($availableWords)) {
                return response()->json(['status' => 'error', 'message' => 'No new words available for this round.']);
            }

            // Select a random word from the remaining available words
            $randomWord = $availableWords[array_rand($availableWords)];

            // Store the word in the session to be used later for validation
            Session::put('current_word', $randomWord);

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

    /**
     * logPuzzleAttempt
     *
     * @param  mixed $request
     * @return void
     */
    public function logPuzzleAttempt(Request $request)
    {
        $validated = $request->validate([
            'guess' => 'required|string',
            'is_correct' => 'required|boolean',
        ]);

        \Log::info($request);

        PuzzleAttempt::create([
            'user_id' => 1,
            'puzzle_num' => 2,  // Set the correct puzzle number
            'entered_key' => $validated['guess'],
            'is_correct' => $validated['is_correct'],
        ]);

        return response()->json(['status' => 'success']);
    }
}
