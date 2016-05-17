<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    //returns list of admin
    public function getDashboard()
    {
        if(Auth::user()->role=='user') {
            return view('master.adminpage');
        }else {
            $admins = Person::where('role','=','admin')->get();
            return view('admin.listadmin', compact('admins'));
        }
    }

    //returns edit adminpage with pre-filled parameters
    public function editAdmin($id)
    {
        if(Auth::user()->role=='admin')
        {
            $result= Person::where('username','=',$id)->first();
            return view('admin.editadmin', compact('result'));
        }
   
    }

    public function adminUnameChecker(String $request)
    {   
        $unamequery = Person::where('username','=',$request)->first();
        if(!is_null($unamequery))
        {
            return true;
        }
        else
        {
            return false;
        }
    
    }

    public function adminEmailChecker(String $request)
    {
        $emailquery = Person::where('email','=',$request)->first();
        if(!is_null($emailquery))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //returns add admin page
    public function createAdmin()
    {
        return view('admin.addadmin');
    }

    //delete a designated admin
    public function deleteAdmin($id)
    {
        $result= Person::where('username','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboard')->withErrors('An new admin has just been deleted!');
    }

    public function adminSaver(Person $admin, Request $request)
    {
            $admin_username=$request->input('username');
            $admin_name=$request->input('nama');
            $admin->nama=$admin_name;
            $role="admin";
            $admin->role=$role;
            $admin_email=$request->input('email');
            $admin->email=$admin_email;
            $admin_password=Hash::make($request->input('password'));
            $admin->password=$admin_password;
            $admin->username=$admin_username;
            $admin->save();
    }

    //saves the new admin into the database including the parameters
    public function registerAdmin(Request $request)
    {

            $newadmin = new Person;

            $unamecheck=$request->input('username');
            $emailcheck=$request->input('email');
            if(PageController::adminUnameChecker($unamecheck)||PageController::adminEmailChecker($emailcheck))
            {   
                return redirect()->route('createadmin')->withErrors('An admin with that username or email has already exists!');             
            }
            PageController::adminSaver($newadmin,$request);
            return redirect()->route('dashboard')->withErrors('An new admin has just been added!'); 
    }

    //search admin with username like input
    public function searchAdmin(Request $request)
    {
        $username=$request->get('keyword');
        $admins = Person::where('username','like','%'.$username.'%')->where('role','=','admin')->get();
        return view('admin.listadmin', compact('admins')); 
    }

    //for saving edited parameters of admin
    public function saveAdmin(Request $request)
    {
        $keyword=$request->input('olduname');
        $admin_username=$request->input('username');
        $admin_email=$request->input('email');
        if($keyword!=$admin_username){
            if(PageController::adminUnameChecker($admin_username)||PageController::adminEmailChecker($admin_email)){   
                return redirect()->route('editadmin',array('id'=>$keyword))->withErrors('An admin with that username or email has already exists!');             
            }
            $oldadmin = Person::where('username','=',$keyword)->first();
            $oldadmin->delete();
            $newadmin = new Person;
            PageController::adminSaver($newadmin,$request);
        
        }else if($keyword==$admin_username){
            if(PageController::adminEmailChecker($admin_email)){   
                return redirect()->route('editadmin',array('id'=>$keyword))->withErrors('An admin with that email has already exists!');             
            }
            $oldadmin = Person::where('username','=',$keyword)->first();
            PageController::adminSaver($oldadmin,$request);
        }
        return redirect()->route('dashboard')->withErrors('An admin profile has just been updated!');
    }
}
?>