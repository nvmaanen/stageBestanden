<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\Product;

class LandingController extends Controller
{


    public function landingArticles()
    {
        $location = now();

        $articles = Article::where([
            [
                'date',
                '<=',
                $location
            ],
            [
                'ExpDate',
                '>',
                $location
            ]
        ])->orderBy('date', 'DESC')
            ->paginate(12);

        return view('welcomeArticles', compact('articles'));
    }


    public function landingProjects()
    {
        $location = now();

        $projects = Project::where([
            [
                'StartDate',
                '<=',
                $location
            ],
            [
                'EndDate',
                '>',
                $location
            ]
        ])->orderBy('StartDate', 'DESC')
            ->paginate(12);

        return view('welcomeProjects', compact('projects'));
    }
    public function landingProducts()
    {
        $products = Product::paginate(12);



        return view('welcomeProducts', compact('products'));
    }

    public function singleProduct(Product $product)
    {
        $products = Product::paginate(3);

        return view('welcomeSingleProduct', compact('product', 'products'));
    }
}
