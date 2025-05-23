<?php

namespace App\Http\Controllers;

use App\Traits\TraitsCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Puzzle;
use App\Models\PuzzleAttempt;
use App\Models\PuzzleGameState;
use Illuminate\Support\Facades\Auth;
use App\Lib\LibUtility;

use App\Http\Requests\ValidatePuzzleKeyRequest;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class PuzzlesController
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @author Johnvic Dela Cruz <delacruzjohnvic21@gmail.com>
 * @since Mar 30, 2025
 */
class PuzzleController extends BaseController
{

    /**
     * [Traits] TraitsCommon class
     * @var object
     */
    use TraitsCommon;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * [View] Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        $authTeamID = $this->getAuthTeamID();
        $modelPuzzles = Puzzle::select("puzzle_num", "date_unlocked");
        $modelPuzzlesList = [];
        $assignPuzzlesRound = [];
        $modelPuzzlesDateUnlocked = [];
        $puzzleAvailableIn = [];

        if ($modelPuzzles->count() > 0) {
            $modelPuzzlesAssign = $modelPuzzles->pluck("puzzle_num")->toArray();
            $modelPuzzlesDateUnlocked = $modelPuzzles->pluck("date_unlocked")->toArray();
            $modelPuzzlesList = array_values(array_unique(array_map('intval', $modelPuzzlesAssign)));
            $flagIsCorrect = 1;

            foreach ($modelPuzzlesAssign as $puzzleNum) {
                $modelCheck = PuzzleAttempt::where([
                    ["team_id", "=", $authTeamID],
                    ["puzzle_num", "=", $puzzleNum],
                    ["is_correct", "=", $flagIsCorrect]
                ]);

                if ($modelCheck->count() > 0) {
                    $assignData = $modelCheck->get()->toArray();
                    $assignPuzzlesRound[intval($puzzleNum)] = $assignData;
                }
            }
        }

        $REQUIRED_WORDLE_WORD_COUNT = config('constants.REQUIRED_WORDLE_WORD_COUNT');
        $isArray = [LibUtility::class, 'isArray'];

        $checkPuzzleState['2nd'] = $assignPuzzlesRound[1] ?? [];
        $checkPuzzleState['3rd'] = $assignPuzzlesRound[2] ?? [];
        $checkPuzzleState['4th'] = $assignPuzzlesRound[3] ?? [];

        $isPuzzleComplete['1st'] = $isArray($checkPuzzleState['2nd']);
        $isPuzzleComplete['2nd'] = $isArray($checkPuzzleState['3rd']) && count($checkPuzzleState['3rd']) === $REQUIRED_WORDLE_WORD_COUNT;
        $isPuzzleComplete['3rd'] = $isArray($checkPuzzleState['4th']);

        $puzzleAvailableIn['1st'] = max(round(now()->diffInSeconds(Carbon::parse($modelPuzzlesDateUnlocked[0]))), 0);
        $puzzleAvailableIn['2nd'] = max(round(now()->diffInSeconds(Carbon::parse($modelPuzzlesDateUnlocked[1]))), 0);
        $puzzleAvailableIn['3rd'] = max(round(now()->diffInSeconds(Carbon::parse($modelPuzzlesDateUnlocked[2]))), 0);
        $puzzleAvailableIn['4th'] = max(round(now()->diffInSeconds(Carbon::parse($modelPuzzlesDateUnlocked[3]))), 0);

        return view('puzzles', compact(
            'modelPuzzlesList', 'puzzleAvailableIn', 'authTeamID', 'checkPuzzleState', 'isPuzzleComplete'
        ));
    }

    /**
     * [View] Details page
     * @param Request $request
     * @param $reference
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object|void
     */
    public function getDetails($reference)
    {
        $correctAttemptCount = auth()->user()->team->puzzleAttempts->where('is_correct', 1)->count();
        $remainingWordsToGuess = 0;
        $authUserID = $this->getAuthUserID();
        $authTeamID = $this->getAuthTeamID();

        $puzzleOrder = [
            '1st' => 1,
            '2nd' => 2,
            '3rd' => 3,
            '4th' => 4
        ];

        $puzzleNum = $puzzleOrder[$reference] ?? 1;

        $isPuzzleAvailable = $this->isPuzzleAvailebleOrUnlocked($puzzleNum, $authTeamID);
        if($isPuzzleAvailable) return $isPuzzleAvailable;

        if($reference == '2nd') {
            $totalCorrectWords = PuzzleAttempt::select('entered_key')
                                    ->where('team_id', $authTeamID)
                                    ->where('is_correct', 1)
                                    ->where('puzzle_num', 2)
                                    ->count();

            $remainingWordsToGuess = config('constants.REQUIRED_WORDLE_WORD_COUNT') - $totalCorrectWords;
        }

        $modelPuzzleAttempt = PuzzleAttempt::select('entered_key', 'created_at')
                                        ->where('team_id', $authTeamID)
                                        ->where('puzzle_num', $puzzleNum);

        $baseQuery = PuzzleAttempt::select('entered_key', 'created_at')
                                    ->where('team_id', $authTeamID)
                                    ->where('puzzle_num', $puzzleNum);

        $numberOfAttempt = $baseQuery->count();

        $correctAttempt = (clone $baseQuery)
                            ->where('is_correct', 1)
                            ->pluck('entered_key')
                            ->toArray();

        $latestAttempt = (clone $baseQuery)
                            ->where('is_correct', 1)
                            ->orderByDesc('created_at')
                            ->first();

        $dateTimeCompleted = $latestAttempt && $latestAttempt->created_at
            ? Carbon::parse($latestAttempt->created_at)->format('M j, Y h:i:s A')
            : '';

        if($remainingWordsToGuess > 0) {
            $dateTimeCompleted = '';
        }

        if (view()->exists("puzzles/puzzles-$reference")) {
            return view("puzzles/puzzles-$reference", compact('remainingWordsToGuess', 'correctAttempt', 'dateTimeCompleted', 'numberOfAttempt'));
        }

        abort(404);
    }

    /**
     * []
     * validatePuzzleKey
     *
     * @param  mixed $request
     * @return void
     */
    public function validatePuzzleKey(ValidatePuzzleKeyRequest $request)
    {
        if(!is_array($request->puzzle_key)) {
            $enteredKey = strtolower($request->puzzle_key);
        } else {
            $enteredKey = array_map('strtolower', $request->puzzle_key);
        }

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

        if ($puzzleNum == 1) {
            $isCorrect = $enteredKey === $puzzleKeys;
        } elseif ($puzzleNum == 2) {
            $isCorrect = is_array($puzzleKeys) && in_array($enteredKey, $puzzleKeys);
        } elseif ($puzzleNum == 3) {
            if (is_array($enteredKey) && is_array($puzzleKeys)) {
                $enteredKeyLower = array_map('strtolower', $enteredKey);
                $puzzleKeysLower = array_map('strtolower', $puzzleKeys);

                $isCorrect = $enteredKeyLower === $puzzleKeysLower;

                $enteredKey = implode(',', $enteredKeyLower);
            }
        }

        // Store attempt
        PuzzleAttempt::create([
            'team_id'     => $this->getAuthTeamID(),
            'user_id'     => $this->getAuthUserID(),
            'puzzle_num'  => $puzzleNum,
            'entered_key' => $enteredKey,
            'is_correct'  => $isCorrect,
        ]);

        if ($isCorrect) {
            PuzzleGameState::where('team_id', $this->getAuthTeamID())
                            ->where('puzzle_num', $puzzleNum)
                            ->delete();

            $dateTimeNow = now()->format('Y-m-d H:i:s');
            $nextPuzzle = Puzzle::where('date_unlocked', '<=', $dateTimeNow)
                                ->where('puzzle_num', $puzzleNum + 1)
                                ->exists();

            return response()->json([
                'status' => 'success',
                'message' => 'Puzzle unlocked!',
                'next_puzzle' => $nextPuzzle ? url("/puzzles/{$puzzle->unlock_puzzle}") : false
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => "Try again, brave soul!"
        ]);
    }

    /**
     * Fetch a random word from the puzzle's array and start the game.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWordleWord()
    {
        $puzzle = Puzzle::where('puzzle_num', 2)->first();
        $showHowToPlayGameAlert = true;

        if ($puzzle && isset($puzzle->puzzle_key) && is_array(json_decode($puzzle->puzzle_key))) {
            $gameState = PuzzleGameState::where('team_id', $this->getAuthTeamID())
                                    ->where('puzzle_num', 2)
                                    ->first();

            if ($gameState) {
                $gameState = json_decode($gameState->game_state, true);

                if(!session('current_word'))
                    Session::put('current_word', $gameState['answer']);
            } else {
                $puzzleKeys = json_decode($puzzle->puzzle_key, true);

                $attemptedWords = PuzzleAttempt::where('team_id', $this->getAuthTeamID())
                                                ->where('puzzle_num', 2)
                                                ->where('is_correct', 1)
                                                ->pluck('entered_key')
                                                ->toArray();

                $availableWords = array_filter($puzzleKeys, fn($word) => !in_array(strtolower($word), array_map('strtolower', $attemptedWords)));

                if (empty($availableWords) || count($attemptedWords) == config('constants.REQUIRED_WORDLE_WORD_COUNT')) {
                    $nextPuzzleUnlock = false;

                    if(!empty($attemptedWords)) {
                        $dateTimeNow = now()->format('Y-m-d H:i:s');
                        $nextPuzzle = Puzzle::where('date_unlocked', '<=', $dateTimeNow)
                                                ->where('puzzle_num', 3)
                                                ->exists();

                        if ($nextPuzzle) {
                            $nextPuzzleUnlock = '3rd';
                        }
                    }

                    return response()->json([
                        'status' => empty($attemptedWords) ? 'error' : 'complete',
                        'next_puzzle' => $nextPuzzleUnlock,
                        'message' => empty($attemptedWords) ? 'No words available.' : 'All Wordle words have been attempted.'
                    ]);
                }

                $randomWord = $availableWords[array_rand($availableWords)];

                Session::put('current_word', $randomWord);

                if(count($attemptedWords) > 0)
                    $showHowToPlayGameAlert = false;
            }

            return response()->json([
                'status' => 'success',
                'showHowToPlayGameAlert' => $showHowToPlayGameAlert,
            ]);
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
            'team_id' => $this->getAuthTeamID(),
            'user_id' => $this->getAuthUserID(),
            'puzzle_num' => 2,
            'entered_key' => $guess,
            'is_correct' => $isCorrect ? 1 : 0,
        ]);

        return response()->json([
            'feedback' => $feedback,
            'correct' => $isCorrect,
        ]);
    }

    /**
     * resetPuzzles
     *
     * @return void
     */
    public function resetPuzzles()
    {
        Session::forget('current_word');
        PuzzleGameState::where('team_id', $this->getAuthTeamID())->delete();
        PuzzleAttempt::where('team_id', $this->getAuthTeamID())->delete();
        return redirect()->route('puzzles.index')->with('message', 'Game reset successfully.');
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
        $length = strlen($word);

        $usedInWord = array_fill(0, $length, false);

        // First pass: mark correct letters
        for ($i = 0; $i < $length; $i++) {
            if ($guess[$i] === $word[$i]) {
                $feedback[$i] = 'correct';
                $usedInWord[$i] = true;
            } else {
                $feedback[$i] = 'pending';
            }
        }

        // Second pass: mark present (misplaced) letters
        for ($i = 0; $i < $length; $i++) {
            if ($feedback[$i] !== 'pending') {
                continue;
            }

            $found = false;
            for ($j = 0; $j < $length; $j++) {
                if (!$usedInWord[$j] && $guess[$i] === $word[$j]) {
                    $found = true;
                    $usedInWord[$j] = true;
                    break;
                }
            }

            $feedback[$i] = $found ? 'present' : 'absent';
        }

        // Safety check
        if (count($feedback) !== 5) {
            \Log::debug('Invalid feedback length: ', ['feedback_length' => count($feedback)]);
        }

        return $feedback;
    }

    private function isPuzzleAvailebleOrUnlocked($puzzleNum, $authTeamID) {
        $dateTime = now()->format('Y-m-d H:i:s');

        $isPuzzleAvailable = Puzzle::where('puzzle_num', $puzzleNum)
                                    ->where('date_unlocked', '<=', $dateTime)
                                    ->exists();

        if(!$isPuzzleAvailable)
            return redirect()->route('puzzles.index')->with('error', 'This challenge is not yet ready to be unveiled, brave soul. Await the herald’s announcement.');

        if($puzzleNum > 1) {
            $requiredCorrectAttempts = 1;
            $previousPuzzleNum = $puzzleNum - 1;

            if($previousPuzzleNum == 2) //Multiple answers are required for Puzzle 2 to unlock Puzzle 3.
                $requiredCorrectAttempts = config('constants.REQUIRED_WORDLE_WORD_COUNT');

            $numberOfCorrectAttempt = PuzzleAttempt::where('puzzle_num', $previousPuzzleNum)
                                                    ->where('team_id', $authTeamID)
                                                    ->where('is_correct', 1)
                                                    ->count();

            if($requiredCorrectAttempts !== $numberOfCorrectAttempt) {
                return redirect()->route('puzzles.index')->with('error', "Hold, valiant one! Conquer Puzzle $previousPuzzleNum before thy path is made clear.");
            }
        }

        return;
    }
}
