<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Resources\ExpenseResource;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  return Expense::all();
        return ExpenseResource::collection(Expense::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'amount' => 'required',
        'user_id' => 'required'
    ]);
        // return Expense::create($request->all());
        return new ExpenseResource(Expense::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $expense = Expense::with('tags')->findOrFail($id);

        // return response()->json([
        //     'expense' => $expense
         return new ExpenseResource($expense->load('tags'));
    
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        $expense->update($request->all());
        // return $expense;
        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return Expense::destroy($id);
        return Expense::findOrFail($id)->delete();
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  str  $id
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        // return Expense::where('title', 'like', '%'.$name.'%')->get();
        return ExpenseResource::collection(Expense::where('title', 'like', '%'.$name.'%')->get());
    }

    public function addTags(Request $request, $id)
{
    $expense = Expense::findOrFail($id);

    $validated = $request->validate([
        'tags' => 'required|array',
        'tags.*' => 'exists:tags,id',
    ]);

    $expense->tags()->syncWithoutDetaching($validated['tags']);

    // return response()->json(['message' => 'Tags associés avec succès !', 'expense' => $expense->load('tags')]);
    return new ExpenseResource($expense->load('tags'));
}

}
