<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User as UserMod;
use App\Model\Shop as ShopMod ;
use App\Model\Product as ProductMod ;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mods = UserMod::orderBy('id','desc')->paginate(15);
        return view('admin.user.lists', compact('mods') );

        //$mods = UserMod::where('active', 1 ) 
           // ->where('city', 'bangkok')
           // ->orderBy('name', 'desc')
           // ->get();

       // $mods = UserMod::find([1, 2, 3, 5]);


     // $mods = UserMod::all();
        
        // Using alias name
        //$mods = UserMod::all();

      //  foreach ($mods as $item) {
       //     echo $item->name. " .".$item->surname." ".$item->email. "<br />";
       // }
  /*

        $item = [
            'item1' => 'My Value1',
            'item2' => 'My Value2'
        ];

        $results = [
            'data' => $data,
            'item' => $item
        ];

        return view('test', $results);*/
      /*  $data = [
           'name' => 'My Name',
           'surname' => 'My SurName',
           'email' => 'myemail@gmail.com'
       ];

       /* $user = UserMod::find(1);
        $mods = UserMod::all();

        return view('test', compact('data', 'user', 'mods')); */


        return view('template');
         //->with('name','My name') 
        // ->with('email','minmy@gmail.com');*/



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request); exit;
        request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'address' => 'required|min:2|max:50',
            'city' => 'required|min:2|max:50',

        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);



        $mod = new UserMod;
        $mod->email    = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        $mod->mobile   = $request->mobile;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/user')
            ->with('success', 'User ['.$request->name.'] created successfully.');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = ProductMod::find($id);
        echo "products Name is :".$products->name;
        echo "<br />";
        echo "Shop owner is :".$products->shop->name;
           /* foreach ($products as $product) {
                echo $product->name."<br />";
            }*/
      //
}

      /*  $mod = UserMod::find($id);
        echo $mod->name. " .".$mod->surname." => is owner shop :" .$mod->shop->name;*/

       
      //  $mod = ShopMod::find($id);
         //   echo $mod->name.
         //    "<br />";

          //  echo $mod->user->name;    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public  function edit($id)
    {
        $item = UserMod::find($id);
       return view('admin.user.edit',compact('item'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|min:2|max:50',
            'surname' => 'required|min:2|max:50',
            'mobile' => 'required|numeric',
            'password' => 'required|min:6',
            'age' => 'required|numeric',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'address' => 'required|min:2|max:50',
            'city' => 'required|min:2|max:50',

        ], [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name should not be greater than 50 characters.',
        ]);

        $mod = UserMod::find($id);
        $mod->name     = $request->name;
        $mod->surname  = $request->surname;
        //$mod->email    = $request->email;
        $mod->password = bcrypt($request->password);
        $mod->mobile   = $request->mobile;
        $mod->surname  = $request->surname;
        $mod->age      = $request->age;
        $mod->address  = $request->address;
        $mod->city     = $request->city;
        $mod->save();

        return redirect('admin/user')
                    ->with('success', 'User ['.$request->name.'] updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $mod = UserMod::find($id);
            $mod->delete();
         return redirect('admin/user');

    }
}
