<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\ProductPhotos;
use App\Models\ProductTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        checkPermission('product index');
        $products = Product::with('photos')->get();
        return view('backend.product.index', get_defined_vars());
    }

    public function create()
    {
        checkPermission('product create');
        return view('backend.product.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        checkPermission('product create');
        try {
            $product = new Product();
            $product->photo = uploadImage('product', $request->file('photo'));
            $product->save();
            foreach (getActiveLanguages() as $lang) {
                $translation = new ProductTranslation();
                $translation->locale = $lang->code;
                $translation->product_id = $product->id;
                $translation->name = $request->name[$lang->code];
                $translation->description = $request->description[$lang->code];
                $translation->save();
            }
            foreach (uploadMultipleImages('product', $request->file('photos')) as $photo) {
                $productPhoto = new ProductPhotos();
                $productPhoto->photo = $photo;
                $product->photos()->save($productPhoto);
            };
            alert()->success(__('messages.success'));
            return redirect(route('backend.product.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.product.index'));
        }
    }

    public function edit(string $id)
    {
        checkPermission('product edit');
        $product = Product::where('id', $id)->with('photos')->first();
        return view('backend.product.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        checkPermission('product edit');
        try {
            $product = Product::where('id', $id)->with('photos')->first();
            DB::transaction(function () use ($request, $product) {
                if ($request->hasFile('photo')) {
                    if (file_exists($product->photo)) {
                        unlink(public_path($product->photo));
                    }
                    $product->photo = uploadImage('product', $request->file('photo'));
                }
                if ($request->hasFile('photos')) {
                    foreach (uploadMultipleImages('product', $request->file('photos')) as $photo) {
                        $productPhoto = new ProductPhotos();
                        $productPhoto->photo = $photo;
                        $product->photos()->save($productPhoto);
                    }
                }
                foreach (getActiveLanguages() as $lang) {
                    $product->translate($lang->code)->name = $request->name[$lang->code];
                    $product->translate($lang->code)->description = $request->description[$lang->code];
                }
                $product->save();
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
        checkPermission('product edit');
        return CRUDHelper::status('\App\Models\Product', $id);
    }

    public function delete(string $id)
    {
        checkPermission('product delete');
        return CRUDHelper::remove_item('\App\Models\Product', $id);
    }
}
