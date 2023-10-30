<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{

    public function index()
    {
        $page = Page::all();
        return view('admin.pages.pages', compact('page'));
    }

    public function create()
    {
        $action = '/admin/pages';
        $method = 'POST';
        return view('admin.pages.pages-edit',compact('action','method'));
    }

    public function store(Request $request)
    {

        $page = new Page();
        //Ru
        $page->page_name_ru = $request->page_name_ru;
        $page->page_content_ru = $request->page_content_ru;
        //Kz
        $page->page_name_kz = (!empty($request->page_name_kz)) ? $request->page_name_kz : $request->page_name_ru;
        $page->page_content_kz = (!empty($request->page_content_kz)) ? $request->page_content_kz : $request->page_content_ru;
        $page->save();

        return redirect('/admin/pages');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $action = '/admin/pages/'.$id;
        $method = 'PUT';
        $page = Page::find($id);

        return view('admin.pages.pages-edit', compact('page','action','method'));
    }

    public function update(Request $request, $id)
    {

        Page::where('id', $id)
            ->update([
                'page_name_ru' => $request->page_name_ru,
                'page_name_kz' => $request->page_name_kz,
                'page_content_ru' => $request->page_content_ru,
                'page_content_kz' => $request->page_content_kz
            ]);

        return redirect("/admin/pages");
    }
    public function destroy($id)
    {
        Page::find($id)->delete();
    }
}
