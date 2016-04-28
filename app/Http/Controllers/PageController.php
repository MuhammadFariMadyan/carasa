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
<<<<<<< HEAD
            $users = Person::where('role','=','user')->get();
            return view('master.adminpage', compact('users'));
        }
        else
        {
            $admins = Person::where('role','=','admin')->get();
            return view('admin.listadmin', compact('admins'));
=======
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
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
        }
    
    }

<<<<<<< HEAD
    public function getDashboard1()
    {
        $users = Person::where('role','=','user')->get();
        return view('user.listuser', compact('users'));
    }

    public function editAdmin($id)
=======
    public function adminEmailChecker(String $request)
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
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

<<<<<<< HEAD
=======
    //returns add admin page
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
    public function createAdmin()
    {
        return view('admin.addadmin');
    }

<<<<<<< HEAD
=======
    //delete a designated admin
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
    public function deleteAdmin($id)
    {
        $result= Person::where('username','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboard')->withErrors('An new admin has just been deleted!');
    }

<<<<<<< HEAD
    public function registerAdmin(Request $request)
=======
    public function adminSaver(Person $admin, Request $request)
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
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

<<<<<<< HEAD
    public function searchAdmin(Request $request)
    {
        $username=$request->get('keyword');
        $admins = Person::where('username','like','%'.$username.'%')->where('role','=','admin')->get();
        return view('admin.listadmin', compact('admins')); 
    }

    public function saveAdmin(Request $request)
=======
    //saves the new admin into the database including the parameters
    public function registerAdmin(Request $request)
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
    {

        	$newadmin = new Person;

<<<<<<< HEAD
    public function saveUser(Request $request)
    {
        $keyword=$request->input('olduname');
        $user_username=$request->input('username');
        
        if($keyword!=$user_username)
        {
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
            $newuser->save();
            $newuser->username=$user_username;
            $newuser->save();
        }
        else if($keyword==$user_username)
        {
            $olduser = Person::where('username','=',$keyword)->first();
            $user_name=$request->input('nama');
            $olduser->nama=$user_name;
            $user_email=$request->input('email');
            $olduser->email=$user_email;
            $user_password=Hash::make($request->input('password'));
            $olduser->password=$user_password;
            $olduser->save();
            $olduser->username=$user_username;
            $olduser->save();
        }
        return redirect()->route('dashboard')->withErrors('An user profile has just been updated!');
    }

    public function editUser($id)
=======
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
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
    {
        $username=$request->get('keyword');
        $admins = Person::where('username','like','%'.$username.'%')->where('role','=','admin')->get();
        return view('admin.listadmin', compact('admins')); 
    }
<<<<<<< HEAD
    
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
=======

    //for saving edited parameters of admin
    public function saveAdmin(Request $request)
>>>>>>> 896ab26a48d0b5d9c3e9bbce89aee7fcaea4ef53
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