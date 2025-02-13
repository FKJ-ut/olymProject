<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function index()
    {
        // Retrieve live, draft, and closed polls from the database
        $livePolls = Poll::where('state', 'live')->get();
        $draftPolls = Poll::where('state', 'draft')->get();
        $closedPolls = Poll::where('state', 'closed')->get();

        // Pass the polls data to the view
        return view('voting.index', compact('livePolls', 'draftPolls', 'closedPolls'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'end_time' => 'required|integer|min:1',
            'state' => 'required|in:live,draft,closed',
            'options' => 'required|array', // Ensure options is an array
            'options.*' => 'required|string|max:255', // Ensure each option is a string
        ]);

        // Create the new poll
        $poll = Poll::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => Auth::id(),
            'end_time' => now()->addMinutes($validatedData['end_time']), // Calculate end time based on current time and provided minutes
            'state' => $validatedData['state'],
        ]);

        // Create and associate options with the new poll
        foreach ($validatedData['options'] as $optionName) {
            Option::create([
                'name' => $optionName,
                'poll_id' => $poll->id,
            ]);
        }

        // Redirect to the desired page after successful creation
        return redirect()->route('voting.index')->with('success', 'Poll created successfully.');
    }

    public function delete(Poll $poll)
    {
        // Perform any necessary authorization checks here

        // Delete options associated with the poll
        $poll->options()->delete();

        // Delete the poll
        $poll->delete();

        return redirect()->route('voting.index')->with('success', 'Poll(' . $poll->title . ') deleted successfully.');
    }

    public function create()
    {
        return view('voting.create');
    }
    public function manage(Poll $poll)
    {
        // Retrieve the poll data along with its associated options
        $poll->load('options');

        //dd($poll);

        // Pass the poll data to the view
        return view('voting.manage', compact('poll'));
    }

    public function show(Poll $poll)
    {
        //dd($poll);
        $poll->load('options'); // Eager load options with their votes

        $poll->load('options.votes'); // Eager load options with their votes
        return view('voting.show', compact('poll'));
    }

    public function vote($optionId)
    {
        $option = Option::find($optionId);

        if ($option) {
            $userId = Auth::id();
            $voterIds = explode(',', $option->voter_id);

            if (!in_array($userId, $voterIds)) {
                $voterIds[] = $userId;
                $option->voter_id = implode(',', $voterIds);
                $option->save();

                return redirect()->back()->with('success', 'Your vote has been recorded!');
            } else {
                return redirect()->back()->with('error', 'You have already voted!');
            }
        }

        return redirect()->back()->with('error', 'Option not found!');
    }

    public function unvote($optionId)
    {
        $option = Option::find($optionId);

        if ($option) {
            $userId = Auth::id();
            $voterIds = explode(',', $option->voter_id);

            if (in_array($userId, $voterIds)) {
                $voterIds = array_diff($voterIds, [$userId]);
                $option->voter_id = implode(',', $voterIds);
                $option->save();

                return redirect()->back()->with('success', 'Your vote has been removed!');
            } else {
                return redirect()->back()->with('error', 'You have not voted yet!');
            }
        }

        return redirect()->back()->with('error', 'Option not found!');
    }
}
