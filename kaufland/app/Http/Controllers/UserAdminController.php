<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Admin;
use App\Cliente;
use App\Mesure;
use App\Galerie;
use App\Rendezvous;
use App\Commande;
use App\Locations;
use App\LigneCommande;
use App\LigneLocation;
use App\LigneRecette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
    public function acceuil()
    {
         if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
        
        return view('acceuil');


    }
}

        public function Ajoutadmin()
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
         
        return view('Ajouter_admin');
    }

    }

            public function Modifieradmin(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id=$request->id;

               if($id=="")
               {
                $session=Session::get('id');
               }
               else
               {
                session()->forget('id');
                Session()->put('id', $id);
                $session=Session::get('id');      
               }
               $admins=Admin::where('id' , '=', $session)->first();
               //dd($admins);
        return view('Modifier_admin',compact('admins'));
    }

    }


     public function Adminview(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id=$request->id;

               if($id=="")
               {
                $session=Session::get('id');
               }
               else
               {
                session()->forget('id');
                Session()->put('id', $id);
                $session=Session::get('id');      
               }
               $admins=Admin::where('id' , '=', $session)->first();
               //dd($admins);
        return view('View_admin',compact('admins'));
    }

    }
   public function AdminModifier(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $this->validate($request, [
               'name' => ['required', 'string', 'max:255'],
               ]);
            $id=$request->id;

               if($id=="")
               {
                $session=Session::get('id');
               }
               else
               {
                session()->forget('id');
                Session()->put('id', $id);
                $session=Session::get('id');      
               }

                $adminphoto=Admin::where('id','=', $session)->first();
                 $email=$adminphoto->email;

                if ($request->email == $email )
                 {

                 }
                 else
                 {
                $this->validate($request, [
               
               'email' => [ 'max:255', 'unique:admins'],
              
               ]);
                 }

               if ($request->file('photo') != null )
               {
               if($photo=$request->file('photo'))
               {
                $file=time()."1.".$photo->getClientOriginalExtension();
                $photo->move("images/",$file);
               $inputs['photo']=$file;
               }  
               }
               else{
                 $adminphoto=Admin::where('id','=', $session)->first();
                 $file=$adminphoto->photo;
               }

                if(empty($request->password))
               {
                  Admin::where('id','=', $session)
            ->update([
                  'name'=>$request->name,
                   'email'=>$request->email,
                   'photo'=>$file,
                   'role'=>$request->role,
              ]);
               }
               else{
                 $this->validate($request, [
               'name' => ['required', 'string', 'max:255'],
             
               'password' => ['required', 'string', 'min:8', 'confirmed'],
               ]);
                  Admin::where('id','=', $session)
            ->update([
                  'name'=>$request->name,
                   'email'=>$request->email,
                   'photo'=>$file,
                   'role'=>$request->role,
                    'password' => Hash::make($request['password']),
                    'motdepass' => $request['password'],
              ]);

               }

              
                          return redirect()->route('listadmin')
    ->with('success','les informations ont été modifiées avec succès.');
    }

    }


     protected function createadmin(Request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
             $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if ($request->file('photo') != null )
            {
            if($photo=$request->file('photo'))
            {
             $file=time()."1.".$photo->getClientOriginalExtension();
             $photo->move("images/",$file);
            $inputs['photo']=$file;
            }  
         }

              $Admin= Admin::create([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'photo' => $file,
                        'password' => Hash::make($request['password']),
                        'motdepass' => $request['password'],
                            'role' => $request['role'],
                    
                         ]);

                  return redirect()->route('listadmin')
    ->with('success','Les informations ont été ajoutées avec succès.');

    }
}
         

             public function listadmin()
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
         
        $admintotal= DB::table('admins')->count();
         $admins=DB::table('admins')->get();
        return view('listeadmin',compact('admins','admintotal'));
    }

    }
       public function destroyAdmin( Request $request)
    { 
        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
              $id=$request->id;
               if($id=="")
               {
                $session=Session::get('id');
               }
               else
               {
                session()->forget('id');
                Session()->put('id', $id);
                $session=Session::get('id');      
               }
               Admin::where('id', $session)
               ->delete();
    return redirect()->route('listadmin')->with('success','Votre admin a été supprimé avec succès');
          }
    }

    


}