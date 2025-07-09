<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a page by slug
     */
    public function show($slug)
    {
        $page = Page::published()->bySlug($slug)->first();
        
        if (!$page) {
            abort(404);
        }

        // Use custom template if specified, otherwise use default
        $template = $page->template ? "pages.templates.{$page->template}" : 'pages.show';
        
        // Check if custom template exists, fallback to default if not
        if ($page->template && !view()->exists($template)) {
            $template = 'pages.show';
        }

        return view($template, compact('page'));
    }

    /**
     * Display all published pages (for admin)
     */
    public function index()
    {
        $pages = Page::published()->orderBy('sort_order')->orderBy('title')->get();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created page
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required|string',
            'template' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'sort_order' => 'integer|min:0',
        ]);

        Page::create($validated);

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Show the form for editing a page
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified page
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'required|string',
            'template' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'sort_order' => 'integer|min:0',
        ]);

        $page->update($validated);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified page
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
