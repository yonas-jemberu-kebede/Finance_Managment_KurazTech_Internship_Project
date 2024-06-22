<?php

namespace App\Http\Controllers;
use App\Models\TransactionCategory;
use Illuminate\Http\Request;

class TransactionCategoryController extends Controller
{

    public function index()
    {
        $transactioncategories=TransactionCategory::all();
        return  response()->json([
'all transaction categories'=>$transactioncategories
        ]);
    }

    public function store(Request $request)
    {
    
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'type' => 'required|string|max:255|in:income,expense,other',
                'color' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);

            TransactionCategory::create($validated);

            return response()->json(['message' => 'category stored successfully'], 200);
        
    }

    public function show(TransactionCategory $category)
    {
        return response()->json([
            'category'=>$category
        ]);
    }

    public function edit(TransactionCategory $category)
    {
        return response()->json([
            'category'=>$category
        ]);
    }

    public function update(Request $request, TransactionCategory $category)
    {
        
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'type' => ['required', 'string', 'max:255'],
                'color' => [
                    'required',
                    'string',
                    'max:255'
                ],
            ]);

           
            $category->update($validated);

            return response()->json(
                [
                    'message' => 'category updated successfully'
                ], 200);
        
    }

    public function delete(Request $request, TransactionCategory $category)
    {
    
            $category->delete();

            return response()->json(['message' => 'category deleted successfully'], 200);

        
    }
}
