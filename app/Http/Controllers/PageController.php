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

    //saves the new admin into the database including the parameters
    public function registerAdmin(Request $request)
    {

        	$newadmin = new Person;
        	$admin_name=$request->input('nama');
        	$newadmin->nama=$admin_name;
        	$role="admin";
        	$newadmin->role=$role;
        	$admin_email=$request->input('email');
        	$newadmin->email=$admin_email;
        	$admin_password=Hash::make($request->input('password'));
        	$newadmin->password=$admin_password;
        	$admin_username=$request->input('username');
        	$newadmin->username=$admin_username;

            $unamecheck=$request->input('username');
            $emailcheck=$request->input('email');
            $unamequery = Person::where('username','=',$unamecheck)->first();
            $emailquery = Person::where('email','=',$emailcheck)->first();
            if(!is_null($unamequery)||!is_null($emailquery))
            {   
                return redirect()->route('createadmin')->withErrors('An admin with that username or email has already exists!');             
            }
             $newadmin->save();
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
        if($keyword!=$admin_username){
            $unamecheck=$request->input('username');
            $emailcheck=$request->input('email');
            $unamequery = Person::where('username','=',$unamecheck)->first();
            $emailquery = Person::where('email','=',$emailcheck)->first();
            if(!is_null($unamequery)||!is_null($emailquery))
            {   
                return redirect()->route('editadmin',array('id'=>$keyword))->withErrors('An admin with that username or email has already exists!');             
            }
       		$oldadmin = Person::where('username','=',$keyword)->first();
        	$oldadmin->delete();
        	$newadmin = new Person;
        	$admin_name=$request->input('nama');
        	$newadmin->nama=$admin_name;
        	$role="admin";
        	$newadmin->role=$role;
        	$admin_email=$request->input('email');
        	$newadmin->email=$admin_email;
        	$admin_password=Hash::make($request->input('password'));
        	$newadmin->password=$admin_password;
        	$newadmin->username=$admin_username;
        	$newadmin->save();
       	} else if($keyword==$admin_username){
            $emailcheck=$request->input('email');
            $emailquery = Person::where('email','=',$emailcheck)->first();
            if(!is_null($emailquery)){   
                return redirect()->route('editadmin',array('id'=>$keyword))->withErrors('An admin with that email has already exists!');             
            }
    		$oldadmin = Person::where('username','=',$keyword)->first();
        	$admin_name=$request->input('nama');
        	$oldadmin->nama=$admin_name;
        	$admin_email=$request->input('email');
        	$oldadmin->email=$admin_email;
        	$admin_password=Hash::make($request->input('password'));
        	$oldadmin->password=$admin_password;
        	$oldadmin->username=$admin_username;
            $oldadmin->save();
      	}
        return redirect()->route('dashboard')->withErrors('An admin profile has just been updated!');
    }
}
?>