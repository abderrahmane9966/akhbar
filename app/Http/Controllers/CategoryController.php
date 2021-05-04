<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.category.index')->with([
            'categories' => $categories,
            'showLinks' => true,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_categories' => 'required',
        ]);
        $searchTerm = $request->input('search_categories');

        $categories = Category::where(
            'title',
            'LIKE',
            '%' . $searchTerm . '%'
        )->get();

        if (count($categories) > 0) {
            return view('admin.category.index')->with([
                'categories' => $categories,
                'showLinks' => false,
            ]);
        }
        return redirect()->route('categories.index')->with('succes', 'Nothing Found !!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'image' => 'required'
        ]);

        //$categoryName = $request->input('title');

        // if (!$this->categoryNameExiste($categoryName)) {
        //   return redirect()->route('admin.category.create')->with('succes', 'this Category Name Already Existe');
        // }

        $category = new Category;

        $category->title = $request->input('title');

        if ($request->hasFile('image')) {
            $category->image = $request->image->store('image');
        }

        $category->save();

        return redirect()->route('categories.index')->with('succes', 'Category added succesfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show')->with([
            'categories' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit')->with([
            'categories' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

        $category->title = $request->input('title');

        if ($request->hasFile('image')) {
            $category->image = $request->image->store('image');
        }

        $category->update($request->all());
        return redirect()->route('categories.index')->with('succes', 'Category updated succesfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted succesfuly');
    }

    private function categoryNameExiste($categoryName)
    {

        $category = Category::where([
            'name',
            '=',
            $categoryName
        ])->first();
        if ($category) {
            return false;
        }
        return true;
    }
}
