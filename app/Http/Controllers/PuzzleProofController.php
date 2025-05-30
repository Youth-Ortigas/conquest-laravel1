<?php

namespace App\Http\Controllers;

use App\Traits\TraitsCommon;
use Illuminate\Http\Request;
use App\Models\PuzzleProof;
use App\Models\PuzzleProofReaction;

class PuzzleProofController extends Controller
{
    /**
     * [Traits] TraitsCommon class
     * @var object
     */
    use TraitsCommon;

    public function __construct()
    {
    }

    public function uploadProof(Request $request)
    {
        $request->validate([
            'puzzle_id' => 'required|exists:puzzles,id',
            'photo_proof' => 'required|string',
            'photo' => 'required|image|max:5120',
        ]);

        $teamId = $this->getAuthTeamID();
        $userId = $this->getAuthUserID();
        $puzzleId = $request->puzzle_id;

        $existingProof = PuzzleProof::where('puzzle_id', $puzzleId)
            ->where('team_id', $teamId)
            ->first();

        if ($existingProof) {
            return back()->withErrors(['photo' => 'Your team has already submitted proof for this puzzle.']);
        }

        $path = $request->file('photo')->store('puzzle_proofs', 'public');

        PuzzleProof::create([
            'puzzle_id' => $puzzleId,
            'user_id' => $userId,
            'team_id' => $teamId,
            'photo_path' => $path,
            'description' => $request->photo_proof,
        ]);

        return back()->with('success', 'Photo proof submitted successfully!');
    }

    public function getReactions(PuzzleProof $proof)
    {
        // Group by emoji with usernames
        $grouped = $proof->reactions()->with('user:id,name')->get()
            ->groupBy('emoji')
            ->map(function ($reactions) {
                return [
                    'count' => $reactions->count(),
                    'users' => $reactions->pluck('user.name')->toArray(),
                    'auth_user_reaction' => $reactions->firstWhere('user_id', auth()->id()) ? $reactions->firstWhere('user_id', auth()->id())->emoji : null,
                ];
            });

        return response()->json($grouped);
    }

    public function toggleReaction(Request $request, PuzzleProof $proof)
    {
        $user = $request->user();
        $emoji = $request->input('emoji');

        // One reaction per user per proof
        $reaction = PuzzleProofReaction::where('puzzle_proof_id', $proof->id)
            ->where('user_id', $user->id)
            ->first();

        if ($reaction) {
            if ($reaction->emoji === $emoji) {
                $reaction->delete();
                return response()->json(['message' => 'Reaction removed']);
            } else {
                $reaction->emoji = $emoji;
                $reaction->save();
                return response()->json(['message' => 'Reaction updated']);
            }
        } else {
            PuzzleProofReaction::create([
                'puzzle_proof_id' => $proof->id,
                'user_id' => $user->id,
                'emoji' => $emoji,
            ]);
            return response()->json(['message' => 'Reaction added']);
        }
    }

    public function getReactors($proofId, Request $request)
    {
        $reactors = PuzzleProofReaction::where('puzzle_proof_id', $proofId)
                    ->with('user:id,name') // eager load user with only id and name
                    ->get()
                    ->groupBy('emoji')
                    ->map(function ($group) {
                        return $group->pluck('user.name')->unique()->values();
                    });

        return response()->json(['reactions' => $reactors]);
    }


}
