<?php

namespace App\Http\Controllers\API;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Todo::query()
            ->when(request('with'), function (Builder $query, $with) {
                $query->with(explode(',', $with));
            })
            ->when(request('search'), function (Builder $query, $search) {
                return $query->where('todo', 'like', '%' . $search);
            });

        return $query->simplePaginate();
    }

    public function getUserTodos(Request $request)
    {
        $user = $request->user();
        $todos = Todo::where('user_id', $user->id)->get();

        return response()->json(['todos' => $todos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'todo' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validated['category_id']) {
            $category = Category::find($validated['category_id']);
            if (!$category || $category->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized. Category does not belong to the authenticated user.'], 403);
            }
        }

        return Todo::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {

        return $todo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'todo' => 'nullable|max:255',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $todo->update($validated);

        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return $todo;
    }
}
