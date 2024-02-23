<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Winner;
use Illuminate\Http\Request;
use App\Jobs\GenerateQrCodeJob;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        GenerateQrCodeJob::dispatch($user);
        return $user;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Winner::where('user_id', $id)->delete();
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function incrementPoints($id)
    {
        $user = User::findOrFail($id);
        $user->points += 1;
        $user->save();

        return response()->json($user);
    }

    public function decrementPoints($id)
    {
        $user = User::findOrFail($id);
        if ($user->points > 0) {
            $user->points -= 1;
            $user->save();
        }

        return response()->json($user);
    }

    public function usersGroupedByScore()
    {
        $users = User::all();
        Log::info('All users');
        $groupedUsers = [];

        foreach ($users as $user) {
            $score = $user->points;
            $name = $user->name;
            $age = $user->age;

            if (!isset($groupedUsers[$score])) {
                $groupedUsers[$score] = [
                    'names' => [$name],
                    'average_age' => $age,
                    'count' => 1
                ];
            } else {
                $groupedUsers[$score]['names'][] = $name;
                $groupedUsers[$score]['average_age'] = ($groupedUsers[$score]['average_age'] * $groupedUsers[$score]['count'] + $age) / ($groupedUsers[$score]['count'] + 1);
                $groupedUsers[$score]['count']++;
            }
        }

        return response()->json($groupedUsers);
    }

}
