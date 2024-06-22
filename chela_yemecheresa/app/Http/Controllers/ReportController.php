<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeTransaction;
use App\Models\IncomeTransactionCategory;
use App\Models\ExpenseTransactionCategory;
use App\Models\ExpenseTransaction;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\CompanyAccount;
use App\Models\Vendor;
use App\Models\PaymentMethod;

class ReportController extends Controller
{
    public function incomereportgenerate(Request $request)
    {
        $query = IncomeTransaction::query();

        // Date range filter
        if ($request->has('start_date') && $request->has('end_date')) {
            $startdate = Carbon::parse($request->input('start_date'));
            $enddate = Carbon::parse($request->input('end_date'));
            $query->whereBetween('created_at', [$startdate, $enddate]);
        }

        // Customer name filter
        if ($request->has('customer_name')) {
            $customer = Customer::where('name', $request->input('customer_name'))->first();
            if (!$customer) {
                return response()->json(['error' => 'Customer name not found'], 404);
            }
            $query->where('customer_id', $customer->id);
        }

        // Account number filter
        if ($request->has('company_account_number')) {
            $account = CompanyAccount::where('account_number', $request->input('company_account_number'))->first();
            if (!$account) {
                return response()->json(['error' => 'Account does not exist'], 404);
            }
            $query->where('company_account_id', $account->id);
        }

        // Transaction category name filter
        if ($request->has('income_transaction_category_name')) {
            $category = IncomeTransactionCategory::where('name', $request->input('income_transaction_category_name'))->first();
            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }
            $query->where('income_transaction_category_id', $category->id);
        }

        // Execute the query and get results,it wil find the  sum of thier intersection 
        $income = $query->get();

        $monthlyIncomeSummary = $income->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); // grouping by year-month
        })->map(function($row) {
            return $row->sum('amount');
        });

     

        // Return the results as JSON response
        return response()->json([
            'message' => 'Income report generated',
       
            'total_amount' => $income->sum('amount'),
            'monthly income summary'=>$monthlyIncomeSummary

        ]);
    }


    public function expensereportgenerate(Request $request)
    {
        $query = ExpenseTransaction::query();

        // Date range filter
        if ($request->has('start_date') && $request->has('end_date')) {
            $startdate = Carbon::parse($request->input('start_date'));
            $enddate = Carbon::parse($request->input('end_date'));
            $query->whereBetween('created_at', [$startdate, $enddate]);
        }

        // vendor name filter
        if ($request->has('vendor_name')) {

            $vendor = Vendor::where('name', $request->input('vendor_name'))->first();
            if (!$vendor) {
                return response()->json(['error' => 'vendor name not found'], 404);
            }
            $query->where('vendor_id', $vendor->id);
        }

        // Account number filter
        if ($request->has('company_account_number')) {
            $account = CompanyAccount::where('account_number', $request->input('company_account_number'))->first();
            if (!$account) {
                return response()->json(['error' => 'Account does not exist'], 404);
            }
            $query->where('company_account_id', $account->id);
        }

        // Transaction category name filter
        if ($request->has('expense_transaction_category_name')) {
            $category = ExpenseTransactionCategory::where('name', $request->input('expense_transaction_category_name'))->first();
            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }
            $query->where('expense_transaction_category_id', $category->id);
        }

        if($request->has('payment_method_name')){

            $payment_method=PaymentMethod::where('name',$request->input('payment_method_name'))->first();
            if(!$payment_method){
                return response()->json([
                    'error'=>'payment method not found'
                ],404);

                
            }
            $query->where('payment_method_id',$payment_method->id);
        }

        // Execute the query and get results,it will find the intersection of all the above if they are choosen
        $expense = $query->get();
        $monthlyExpenseSummary = $expense->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m'); // grouping by year-month
        })->map(function($row) {
            return $row->sum('amount');
        });
        $totalAmount = $expense->sum('amount');

        // Return the results as JSON response
        return response()->json([
            'message' => 'expense report generated',
            'total_amount' => $totalAmount,
          'mothly expense summary'=>$monthlyExpenseSummary
        ]);
    }
    public function incomeVsExpenseReportGenerate(Request $request)
{
    $incomeQuery = IncomeTransaction::query();
    $expenseQuery = ExpenseTransaction::query();

    // Date range filter
    if ($request->has('start_date') && $request->has('end_date')) {
        $startdate = Carbon::parse($request->input('start_date'));
        $enddate = Carbon::parse($request->input('end_date'));
        $incomeQuery->whereBetween('created_at', [$startdate, $enddate]);
        $expenseQuery->whereBetween('created_at', [$startdate, $enddate]);
    }

    // Customer name filter
    if ($request->has('customer_name')) {
        $customer = Customer::where('name', $request->input('customer_name'))->first();
        if (!$customer) {
            return response()->json(['error' => 'Customer name not found'], 404);
        }
        $incomeQuery->where('customer_id', $customer->id); 
    }
    
    // Vendor name filter
    if ($request->has('vendor_name')) {
        $vendor = Vendor::where('name', $request->input('vendor_name'))->first();
        if (!$vendor) {
            return response()->json(['error' => 'Vendor name not found'], 404);
        }
        $expenseQuery->where('vendor_id', $vendor->id);
    }

    // Account number filter
    if ($request->has('company_account_number')) {
        $account = CompanyAccount::where('account_number', $request->input('company_account_number'))->first();
        if (!$account) {
            return response()->json(['error' => 'Account does not exist'], 404);
        }
        $incomeQuery->where('company_account_id', $account->id);
        $expenseQuery->where('company_account_id', $account->id);
    }

    // Transaction category name filter
    if ($request->has('income_category_name')) {
        $incomeCategory = IncomeTransactionCategory::where('name', $request->input('income_category_name'))->first();
        if (!$incomeCategory) {
            return response()->json(['error' => 'Income category not found'], 404);
        }
        $incomeQuery->where('income_transaction_category_id', $incomeCategory->id);
    }

    // Transaction category name filter for expense
    if ($request->has('expense_category_name')) {
        $expenseCategory = ExpenseTransactionCategory::where('name', $request->input('expense_category_name'))->first();
        if (!$expenseCategory) {
            return response()->json(['error' => 'Expense category not found'], 404);
        }
        $expenseQuery->where('expense_transaction_category_id', $expenseCategory->id);
    }

    // Execute the queries and get results
    $income = $incomeQuery->get();
    $expense = $expenseQuery->get();

    // Group income by month and calculate total amount for each month
    $monthlyIncomeSummary = $income->groupBy(function($item) {
        return Carbon::parse($item->created_at)->format('Y-m'); // or $item->date if applicable
    })->map(function($rows) {
        return $rows->sum('amount');
    });
    
    // Group expense by month and calculate total amount for each month
    $monthlyExpenseSummary = $expense->groupBy(function($item) {
        return Carbon::parse($item->created_at)->format('Y-m'); // or $item->date if applicable
    })->map(function($rows) {
        return $rows->sum('amount');
    });
    // Combine income and expense summaries
    $monthlySummary = collect();
    foreach ($monthlyIncomeSummary as $month => $income) {
        $monthlySummary[$month]['income'] = $income;
        $monthlySummary[$month]['expense'] = $monthlyExpenseSummary->get($month, 0);
    }
    foreach ($monthlyExpenseSummary as $month => $expense) {
        if (!isset($monthlySummary[$month])) {
            $monthlySummary[$month]['income'] = 0;
        }
        $monthlySummary[$month]['expense'] = $expense;
    }

    // Return the results as JSON response
    return response()->json([
        'message' => 'Income vs Expense report generated',
        'monthly_summary' => $monthlySummary
    ]);
}

public function incomebycategory(){

$incometransactioncategories=IncomeTransactionCategory::all();
$results=[];

foreach($incometransactioncategories as $category){
    $query=IncomeTransaction::query();
    $query->where('income_transaction_category_id',$category->id);
    $income=$query->get();

    $sum=$income->sum('amount');
    $results[$category->name]=$sum;
}

return response()->json($results);
   

}
public function incomebycustomer(Request $request){
    $query = IncomeTransaction::query();

    // Filter by customer name
    if ($request->has('customer_name')) {
        $customer = Customer::where('name', $request->input('customer_name'))->first();
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        $query->where('customer_id', $customer->id);
    }

    // Filter by account number
    if ($request->has('account_number')) {
        $account = CompanyAccount::where('account_number', $request->input('account_number'))->first();
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }
        $query->where('account_id', $account->id);
    }

    // Execute the query and get results
    $income = $query->get();

    // Group income by month and calculate total amount for each month
    $monthlyIncomeSummary = $income->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y-m'); // grouping by year-month
    })->map(function($row) {
        return $row->sum('amount');
    });

    // Return the results as JSON response
    return response()->json([
        'message' => 'Income summary report generated',
        'monthly_income_summary' => $monthlyIncomeSummary
    ]);
}
public function expensebycategory(){
    $expensecategories=ExpenseTransactionCategory::all();
    $results=[];
    foreach($expensecategories as $category){
        $query=ExpenseTransaction::query();
        $query->where('expense_transaction_category_id',$category->id);
        $expense=$query->get();

        $sum=$expense->sum('amount');

        $results[$category->name]=$sum;

}

return response()->json($results);
}

public function expensebyvendor(Request $request){
    $query = ExpenseTransaction::query();

    // Filter by customer name
    if ($request->has('vendor_name')) {
        $vendor = Vendor::where('name', $request->input('vendor_name'))->first();
        if (!$vendor) {
            return response()->json(['error' => 'Vendor not found'], 404);
        }
        $query->where('vendor_id', $vendor->id);
    }

    // Filter by account number
    if ($request->has('account_number')) {
        $account = CompanyAccount::where('account_number', $request->input('account_number'))->first();
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }
        $query->where('account_id', $account->id);
    }

    // Execute the query and get results
    $expense= $query->get();

    // Group income by month and calculate total amount for each month
    $monthlyIncomeSummary = $expense->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y-m'); // grouping by year-month
    })->map(function($row) {
        return $row->sum('amount');
    });

    // Return the results as JSON response
    return response()->json([
        'message' => 'expense summary report generated',
        'monthly_income_summary' => $monthlyIncomeSummary
    ]);
}
public function latestincome(){
    $income=IncomeTransaction::orderBy('created_at','desc')->take(5)->get();
    return response()->json([
        'latest incomes'=>$income
    ]);
}

public function latestexpense(){
    $expense=ExpenseTransaction::orderBy('created_at','desc')->take(2)->get();

    return response()->json([
        'latestexepense'=>$expense
    ]);
}
public function visitaccount(){
    $companyaccount=CompanyAccount::all();
    return response()->json([
'company account'=>$companyaccount
    ]
        
    );
}
}
