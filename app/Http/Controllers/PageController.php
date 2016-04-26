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
	public function getDashboard()
    {
        if(Auth::user()->role=='user')
        {
           
            return view('master.adminPage', compact('users'));
        }
        else
        {
        	$admins = Person::where('role','=','admin')->get();
        	return view('admin.listAdmin', compact('admins'));
        }
    }

    public function getDashboard1()
    {
        $users = Person::where('role','=','user')->get();
        return view('user.listuser', compact('users'));
    }
    public function editAdmin($id)
    {
        if(Auth::user()->role=='admin')
         {
            $result= Person::where('username','=',$id)->first();
            return view('admin.editadmin', compact('result'));
        }
    }
    public function createAdmin()
    {
        return view('admin.addadmin');
    }
    public function deleteAdmin($id)
    {
        $result= Person::where('username','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboard')->withErrors('An new admin has just been deleted!');
    }
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
    

    public function searchAdmin(Request $request)
     {
         $username=$request->get('keyword');
         $admins = Person::where('username','like','%'.$username.'%')->where('role','=','admin')->get();
         return view('admin.listadmin', compact('admins')); 
     }

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


        public function saveUser(Request $request)
{
        $keyword=$request->input('olduname');
        $user_username=$request->input('username');
       if($keyword!=$user_username){
             $unamecheck=$request->input('username');
             $emailcheck=$request->input('email');
             $unamequery = Person::where('username','=',$unamecheck)->first();
             $emailquery = Person::where('email','=',$emailcheck)->first();
             if(!is_null($unamequery)||!is_null($emailquery))
             {   
                 return redirect()->route('edituser',array('id'=>$keyword))->withErrors('An user with that username or email has already exists!');             
            }
            $olduser = Person::where('username','=',$keyword)->first();
            $olduser->delete();
            $newuser = new Person;
            $user_name=$request->input('nama');
            $newuser->nama=$user_name;
            $role="user";
            $newuser->role=$role;
            $user_email=$request->input('email');
            $newuser->email=$user_email;
            $user_password=Hash::make($request->input('password'));
            $newuser->password=$user_password;
            
            $newuser->username=$user_username;
            $newuser->save();
        }
         else if($keyword==$user_username){
             $emailcheck=$request->input('email');
             $emailquery = Person::where('email','=',$emailcheck)->first();
             if(!is_null($emailquery)){   
                 return redirect()->route('edituser',array('id'=>$keyword))->withErrors('An user with that email has already exists!');             
             }
            $olduser = Person::where('username','=',$keyword)->first();
            $user_name=$request->input('nama');
            $olduser->nama=$user_name;
            $user_email=$request->input('email');
            $olduser->email=$user_email;
            $user_password=Hash::make($request->input('password'));
            $olduser->password=$user_password;
            $olduser->username=$user_username;
            $olduser->save();
        }
        return redirect()->route('dashboard')->withErrors('An user profile has just been updated!');
    }

     public function editUser($id)
    {
        if(Auth::user()->role=='admin')
         {
             $result= Person::where('username','=',$id)->first();
             return view('user.edituser', compact('result'));
         }
    }
    public function createUser()
    {
        return view('user.adduser');
    }
    public function deleteuser($id)
    {
        $result= Person::where('username','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboard')->withErrors('An new user has just been deleted!');
}

public function searchUser(Request $request)
     {
         $username=$request->get('keyword');
         $users = Person::where('username','like','%'.$username.'%')->where('role','=','user')->get();
         return view('user.listuser', compact('users')); 
     }
    public function registerUser(Request $request)
    {
            $newuser = new Person;
            $user_name=$request->input('nama');
            $newuser->nama=$user_name;
            $role="user";
            $newuser->role=$role;
            $user_email=$request->input('email');
            $newuser->email=$user_email;
            $user_password=Hash::make($request->input('password'));
            $newuser->password=$user_password;
            
            $user_username=$request->input('username');
            $newuser->username=$user_username;
            $unamecheck=$request->input('username');
             $emailcheck=$request->input('email');
             $unamequery = Person::where('username','=',$unamecheck)->first();
             $emailquery = Person::where('email','=',$emailcheck)->first();
             if(!is_null($unamequery)||!is_null($emailquery))
             {   
                 return redirect()->route('createuser')->withErrors('An admin with that username or email has already exists!');             
             }
              $newadmin->save();
              return redirect()->route('dashboard')->withErrors('An new User has just been added!'); 
    }
}
?>