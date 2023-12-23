<?php

namespace App\Http\Controllers\API;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
        try {
            $validated = $request->validate([
                'todo' => 'required|max:255',
                'user_id' => 'required|exists:users,id',
                'category_id' => [
                    'required',
                    Rule::exists('categories', 'id')->where(function ($query) use ($request) {
                        $query->where('id', $request->category_id)->where('user_id', $request->user_id);
                    }),
                ],
            ]);
            
            $todo = Todo::create($validated);

            return response()->json(['message' => 'Todo created successfully', 'data' => $todo], 201);
        }
        
        catch (ValidationException $e) {
            // Custom error message for validation failure
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        } catch (\Exception $e) {
            // Custom error message for other failures
            return response()->json(['error' => 'Failed to create Todo'], 500);
        }
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
