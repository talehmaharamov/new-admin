<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\GeneralPhotos;
use App\Models\GeneralTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\General;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function index()
    {
        checkPermission('general index');
        $generals = General::with('photos')->get();
        return view('backend.general.index', get_defined_vars());
    }

    public function create()
    {
        checkPermission('general create');
        return view('backend.general.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        checkPermission('general create');
        try {
            $general = new General();
            $general->photo = uploadImage('general', $request->file('photo'));
            $general->save();
            foreach (getActiveLanguages() as $lang) {
                $translation = new GeneralTranslation();
                $translation->locale = $lang->code;
                $translation->general_id = $general->id;
                $translation->name = $request->name[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->save();
            }
            foreach (uploadMultipleImages('general',$request->file('photos')) as $photo)
            {
                $generalPhoto = new GeneralPhotos();
                $generalPhoto->photo = $photo;
                $general->photos()->save(generalPhoto);
            };
            alert()->success(__('messages.success'));
            return redirect(route('backend.general.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.general.index'));
        }
    }

    public function edit(string $id)
    {
        checkPermission('general edit');
        $general = General::where('id', $id)->with('photos')->first();
        return view('backend.general.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        checkPermission('general edit');
        try {
            $general = General::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $general) {
                if($request->hasFile('photo')){
                if(file_exists($general->photo)){
                unlink(public_path($general->photo));
                }
                $general->photo = uploadImage('general',$request->file('photo'));
                }
                if ($request->hasFile('photos')) {
                   foreach (uploadMultipleImages('general', $request->file('photos')) as $photo) {
                   $generalPhoto = new GeneralPhotos();
                   $generalPhoto->photo = $photo;
                   $general->photos()->save($generalPhoto);
                   }
                }
                foreach (getActiveLanguages() as $lang) {
                   $general->translate($lang->code)->name = $request->name[$lang->code];
                   $general->translate($lang->code)->description = $request->description[$lang->code];
                }
                $general->save();
            });
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect()->back();
        }
    }

    public function status(string $id)
    {
        checkPermission('general edit');
        return CRUDHelper::status('\App\Models\General', $id);
    }

    public function delete(string $id)
    {
        checkPermission('general delete');
        return CRUDHelper::remove_item('\App\Models\General', $id);
    }
}
