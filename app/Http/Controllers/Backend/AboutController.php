<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\About;
use App\Models\AboutTranslation;
use App\Models\WhyGefen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    public function index()
    {
        checkPermission('about index');
        $abouts = About::all();
        return view('backend.about.index', get_defined_vars());
    }

    public function create()
    {
        checkPermission('about create');
        return view('backend.about.create');
    }

    public function store(Request $request)
    {
        checkPermission('about create');
        try {
            $about = new About();
            if ($request->hasFile('photo')) {
                $about->photo = uploadImage('about', $request->file('photo'));
            }
            $about->save();
            foreach (getActiveLanguages() as $lang) {
                $translation = new AboutTranslation();
                $translation->locale = $lang->code;
                $translation->about_id = $about->id;
                $translation->title = $request->title[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.about.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.about.index'));
        }
    }

    public function edit($id)
    {
        checkPermission('about edit');
        $about = About::find($id);
        return view('backend.about.edit', get_defined_vars());
    }

    public function update(Request $request, About $about)
    {
        checkPermission('about edit');
        try {
            DB::transaction(function () use ($request, $about) {
                if ($request->hasFile('photo')) {
                    if (file_exists($about->photo)) {
                        unlink(public_path($about->photo));
                    }
                    $about->photo = uploadImage('about', $request->file('photo'));
                }
                foreach (getActiveLanguages() as $lang) {
                    $about->translate($lang->code)->title = $request->title[$lang->code];
                    $about->translate($lang->code)->description = $request->description[$lang->code];
                }
                $about->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.about.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.about.index'));
        }
    }

    public function delete($id)
    {
        checkPermission('about delete');
        return CRUDHelper::remove_item('\App\Models\About', $id);
    }

    public function status($id)
    {
        checkPermission('about edit');
        return CRUDHelper::status('\App\Models\About', $id);
    }
}
