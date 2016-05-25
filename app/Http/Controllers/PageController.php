<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Models\Person;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class PageController extends Controller
{
    //returns list of admin
    public function getDashboard()
    {
        $admins = Person::where('role','=','admin')->get();
        return view('admin.listadmin', compact('admins'));
    }
    //dashboard user management
    public function getDashboard1()
    {
        $users = Person::where('role','=','user')->get();
        return view('user.listuser', compact('users'));
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
    //check admin username
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
    //check admin email
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
    //saves admin parameters
    public function adminSaver(Person $admin, Request $request)
    {
            $admin_username=$request->input('username');
            $admin_name=$request->input('nama');
            $admin_email=$request->input('email');
      
            $admin_password=Hash::make($request->input('password'));
            $role="admin";
            
            if(PageController::adminEmailChecker($admin_email)||PageController::adminUnameChecker($admin_username)){
                return redirect()->route('createadmin')->withErrors('An admin with that email or username has already exists!');       
            }else{
                $admin->role=$role;
                $admin->email=$admin_email;
                $admin->nama=$admin_name;
                $admin->password=$admin_password;
                $admin->username=$admin_username;
                $admin->save();
                return redirect()->route('createadmin')->withErrors('An new admin has just been added!');     
            }         
    }
    //saves the new admin into the database including the parameters
    public function registerAdmin(Request $request)
    {
            $newadmin = new Person;
            return PageController::adminSaver($newadmin, $request);
    }
    //search admin with username like input
    public function personSearch(Request $request)
    {
        $username=$request->get('keyword');
        $roleQuery=$request->get('roleQuery');
        $admins = Person::where('username','like','%'.$username.'%')->where('role','=',$roleQuery)->get();
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
            if(PageController::adminEmailChecker($admin_email)&&!!$admin_username==Person::where('email','=',$request)->first()){   
                return redirect()->route('editadmin',array('id'=>$keyword))->withErrors('An admin with that email has already exists!');       
            }
            $oldadmin = Person::where('username','=',$keyword)->first();
            PageController::adminSaver($oldadmin,$request);
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
             if(!is_null($emailquery)&&!!$user_username==Person::where('email','=',$request)->first()){   
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
        
             $result= Person::where('username','=',$id)->first();
             return view('user.edituser', compact('result'));
         
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