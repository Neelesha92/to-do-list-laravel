<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
      @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tasks = Task::all(); // Retrieve all tasks from the database
        return view('tasks.index', compact('tasks')); // Pass tasks to the view
    }

    /**
     * Show the form for creating a new resource.
     *
      @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'completed' => false, // Default value
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
      @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);  // Retrieve the task by id
        return view('tasks.edit', compact('task'));  // Pass the task data to the view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
      @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $task = Task::findOrFail($id);  // Retrieve the task by id
    $task->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    // Redirect to the task list with a success message
    return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
      @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);  // Retrieve the task by id
    $task->delete();  // Delete the task

    // Redirect back to the task list with a success message
    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function complete($id)
        {
            $task = Task::findOrFail($id);  // Retrieve the task by id
            $task->update(['completed' => true]);  // Mark it as completed

            return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
        }
    
    // Mark the specified task as incomplete
    public function incomplete($id)
    {
        $task = Task::findOrFail($id);  // Retrieve the task by id
        $task->update(['completed' => false]);  // Mark it as incomplete

        return redirect()->route('tasks.index')->with('success', 'Task marked as incomplete!');
    }

}
