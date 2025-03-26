<?php

namespace App\Http\Controllers;

use App\Models\ExpenseGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseGroups = ExpenseGroup::where('user_id', Auth::id())->get();
        return response()->json([
            'status' => 'success',
            'data' => $expenseGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $expenseGroup = new ExpenseGroup();
        $expenseGroup->name = $request->name;
        $expenseGroup->description = $request->description;
        $expenseGroup->budget = $request->budget;
        $expenseGroup->user_id = Auth::id();
        $expenseGroup->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Expense group created successfully',
            'data' => $expenseGroup
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenseGroup = ExpenseGroup::where('user_id', Auth::id())->find($id);
        
        if (!$expenseGroup) {
            return response()->json([
                'status' => 'error',
                'message' => 'Expense group not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $expenseGroup
        ]);
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
        $expenseGroup = ExpenseGroup::where('user_id', Auth::id())->find($id);
        
        if (!$expenseGroup) {
            return response()->json([
                'status' => 'error',
                'message' => 'Expense group not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $expenseGroup->name = $request->name;
        $expenseGroup->description = $request->description;
        $expenseGroup->budget = $request->budget;
        $expenseGroup->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Expense group updated successfully',
            'data' => $expenseGroup
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenseGroup = ExpenseGroup::where('user_id', Auth::id())->find($id);
        
        if (!$expenseGroup) {
            return response()->json([
                'status' => 'error',
                'message' => 'Expense group not found'
            ], 404);
        }

        $expenseGroup->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Expense group deleted successfully'
        ]);
    }
}
