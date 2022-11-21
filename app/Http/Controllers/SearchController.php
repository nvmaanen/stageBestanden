<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function articleSearch(Article $articles, Request $request)
    {
        $articles = Article::where('title', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.articles.articleSearch')->with('articles', $articles);
    }
    public function projectSearch(Project $projects, Request $request)
    {
        $projects = Project::where('title', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.projects.projectSearch')->with('projects', $projects);
    }
    public function productSearch(Product $products, Request $request)
    {
        $products = Product::where('name', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.products.productSearch')->with('products', $products);
    }
    public function orderSearch(Order $orders, Request $request)
    {
        $orders = Order::where('id', 'LIKE', "%" . $request->search . "%")->orWhere('total_price', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.orders.orderSearch')->with('orders', $orders);
    }
    public function openProductSearch(Product $products, Request $request)
    {
        $products = Product::where('name', 'LIKE', "%" . $request->search . "%")->get();
        return view('welcomeSearch')->with('products', $products);
    }
    public function userSearch(User $users, Request $request)
    {
        $users = User::where('name', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.users.userSearch')->with('users', $users);
    }
    public function companySearch(Company $companies, Request $request)
    {
        $companies = Company::where('name', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.companies.companySearch')->with('companies', $companies);
    }
    public function employeeSearch(Employee $employees, Request $request)
    {
        $employees = Employee::where('name', 'LIKE', "%" . $request->search . "%")->get();
        return view('admin.employees.employeeSearch')->with('employees', $employees);
    }
}
