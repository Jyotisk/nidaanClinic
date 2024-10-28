<?php

namespace App\Http\Controllers;

use App\Models\ExceptionHandler;
use App\Models\MenuItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MenuItemController extends Controller
{
    public function GetMenuSubItems()
    {
        $menu_item = MenuItem::where('parent_id', null)->get();
        return view('admin.AddMenuSubItem', compact('menu_item'));
    }
    public function AddMenuItem(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'url' => 'required',
                'title' => Rule::unique('pgsql.menu_items')->where(function ($query) use ($request) {
                    return $query->where('title', $request->title);
                }),
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $menuItem=new MenuItem();
                $menuItem->title=$request->title;
                $menuItem->url=$request->url;
                $menuItem->status=true;
                $menuItem->save();
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Menu Item Added Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "MenuItemController.AddMenuItem";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function AddMenuSubItem(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'sub_item_name.*' => 'required',
                'url.*' => 'required',
                'category_id' => 'required',
                // 'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the validation rules as needed
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $details = [];
                for ($i = 0; $i < count($request->sub_item_name); $i++) {

                    // $path = $request->image[$i]->store('public/menu');
                    $details[] = [
                        'title' => $request->sub_item_name[$i],
                        'url' => $request->url[$i],
                        'parent_id' => $request->category_id,
                        // 'image' => $path,
                        'status' => true,
                    ];
                }

                $details = collect($details);
                $chunks = $details->chunk(500);

                foreach ($chunks as $chunk) {
                    MenuItem::insert($chunk->toArray());
                }
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Sub Menu Item Added Successfully',
                ]);
            } catch (Exception $e) {
                // foreach ($details as $data) {
                //     Storage::delete($data['image']);
                // }
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "MenuItemController.AddMenuSubItem";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }

    public function GetMenuISubtemList()
    {
        $menu_item = MenuItem::where('parent_id', null)->get();
        return view('admin.getMenuItem', compact('menu_item'));
    }
    public function getMeuSubItmDetail(Request $request)
    {
        $menuDetail = MenuItem::where('id', $request->menu_id)->where('status',true)->select('id', 'title','url','image')->first();
        return response()->json([
            'response' => 'success',
            'menuDetail' => $menuDetail
        ]);
    }

    public function EditMenuItem(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'url' => 'required',
                'menu_id' => 'required',
                'title' => Rule::unique('pgsql.menu_items')->where(function ($query) use ($request) {
                    return $query->where('title', $request->title);
                }),
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Adjust the validation rules as needed
            ],

        );
        if ($validator->fails()) {

            return response()->json([
                'response' => 'validationFails',
                'error' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $MenuItem=MenuItem::where('id',$request->menu_id)->first();
                // Storage::delete($MenuItem->image);
                $MenuItem->title=$request->title;
                $MenuItem->url=$request->url;
                // $path = $request->image->store('public/menu');
                // $MenuItem->image=$path;
                $MenuItem->save();
                DB::commit();
                return response()->json([
                    'response' => 'success',
                    'message' => 'Sub Menu Item Save Successfully',
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                $exception = new ExceptionHandler();
                $exception->controller_function = "MenuItemController.EditMenuItem";
                $exception->error = $e;
                $exception->date = date('Y-m-d');
                $exception->user_id = Auth::user()->id;
                $exception->save();
                return response()->json([
                    'response' => 'fails',
                    'message' => 'Something went wrong',
                ]);
            }
        }
    }
    public function getDropdownData(Request $request)
    {
        $parent_id = $request->input('parent_id');
        $subcategories = MenuItem::where('parent_id', $parent_id)->select('id', 'title')->get();
        return response()->json(['subcategories' => $subcategories]);
    }
}
