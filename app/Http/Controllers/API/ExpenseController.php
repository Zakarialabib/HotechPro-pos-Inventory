<?php

namespace App\Http\Controllers\API;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Expense;
use App\ExpenseCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function expenseErp()
    {
        $expenses = Expense::query()
            ->orderBy('id', 'desc')
            ->with('ExpenseCategory')
            ->get();

        return $this->response->formatResponse(200, $expenses);
    }

    public function addExpense(Request $request)
    {
        $user = $this->getUserByApiToken($request);
        $request['user_id'] = $user->id;

        $data = $this->validate($request, [
            'user_id' => 'required',
            'place_id' => 'required',
            'expense_category_id' => '',
            'reference_no' => 'required',
            "amount" => 'required',
            "note" => '', 
        ]);

            $expenses = new Expense();
            $expenses->fill($data)->save();
            return $this->response->formatResponse(200, [], "success");
       
    }


    public function addExpenseCategory(Request $request)
    {
        $user = $this->getUserByApiToken($request);
        $request['user_id'] = $user->id;

        $data = $this->validate($request, [
            'user_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            "is_active" => 'required',
        ]);

            $expensecat = new ExpenseCategory();
            $expensecat->fill($data)->save();
            return $this->response->formatResponse(200, [], "success");
       
    }


}