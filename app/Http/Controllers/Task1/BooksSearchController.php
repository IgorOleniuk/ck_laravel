<?php

namespace App\Http\Controllers\Task1;

use App\Http\Controllers\Controller;
use App\Models\Task1\Book;
use App\Models\Task1\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BooksSearchController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('task1.index', compact('categories'));
    }

    public function getBooksData(Request $request)
    {
        $books = Book::with('category')
            ->when($request->search, function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function($q) use ($request) {
                $q->where('category_id', $request->category);
            })
            ->when($request->in_stock !== 'false', function($q) use ($request) {
                $q->where('in_stock', true);
            })
            ->get();

        return DataTables::collection($books)
            ->editColumn('category', function ($data) {
                return $data['category']['name'];
            })
            ->rawColumns(['id', 'title', 'category', 'in_stock'])
            ->make(true);
    }
}
