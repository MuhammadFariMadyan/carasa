<?php
namespace App\Http\Controllers;
use App\Models\Dummy;
use App\Models\DummyProduct;
use App\Http\Controllers\Controller;
use Validator;
use Mail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Mail\MailServiceProvider;

class ApiController extends Controller
{
	 const STATUS_OK = 200;
   const STATUS_ERROR = 422;
   const STATUS_NOT_FOUND = 404;

   	  public function login(Request $request){
       //messages
       $sm = "Login Succeed!"; 
       $fm = "Wrong username or password!";
       //response codes
       $success = self::STATUS_OK;
       $fail = self::STATUS_ERROR;
       //input requests
       $username=$request->get('username');
       if(is_null($username)){
           $notif="Please fill in your username!";
           return response()->json(['message' => $notif], $fail);
       }
       $password=$request->get('password');
       if(is_null($password)){
           $notif="Please fill in your password!";
           return response()->json(['message' => $notif], $fail);
       }
        //processing
       $validator = Validator::make($request->all(), [
           'username' => 'required',
           'password'  => 'required|min:6'
       ]);
        //processing
       if ($validator->fails()){
           return response()->json(['message' => $fm], $fail);
       }

       else
       {  
            $user  = Dummy::where('username', '=', $username)->where('password', '=', $password)->first(); 
            if(!is_null($user)){
               return response()->json(['message' => $sm], $success);
            }
            else{
               return response()->json(['message' => $fm], $fail);
            }
       }
   }
   public function retrieveAdmin()
   {
        //response codes
      $success = self::STATUS_OK;
      $admin = Dummy::where('role','=','admin')->get(array('username','nama','email'));
      return response()->json($admin, $success);
   }

   public function retrieveProduct()
   {
      $success = self::STATUS_OK;
      $fail = self::STATUS_NOT_FOUND;
      $product = DummyProduct::all();
      $sm = "Product Retrieval Success!"; 
      $fm = "Product Retrieval Failed!"; 

      if(!is_null($product)){
          return response()->json(['message' => $sm], $success);
      }
      else{
          return response()->json(['message' => $fm], $fail);
      }
   }
   public function searchAdmin(Request $request)
   {
        //response codes
      $success = self::STATUS_OK;
      $fail = self::STATUS_NOT_FOUND;
      $username=$request->get('username');
      $admins = Dummy::where('username','like','%'.$username.'%')->get(array('username', 'nama','email'));
      $message="Searching failed. No admin were found.";
      //the get method can only use these methods to check if an array has contents or not : ->isEmpty(), count(), first() (combined withisnull)
      if($admins->count()==0){
              return response()->json(['message' => $message],$fail);
      }
      return response()->json($admins, $success);
   }
   public function eraseAdmin(Request $request){
      $success = self::STATUS_OK;
      $fail = self::STATUS_NOT_FOUND;
      $sm = "Delete Admin Success!";
      $fm = "Delete Admin Failed! Admin with that username is not found!";
      $username=$request->get('username');
      $admin = Dummy::where('username','=',$username)->where('role','=','admin')->first();
      if(!is_null($admin))
      {
             $admin->delete();
             return response()->json(['message' => $sm], $success);
      }
      return response()->json(['message' => $fm], $fail);
   }
   public function registerAdmin(Request $request)
   {
      $success = self::STATUS_OK;
      $fail = self::STATUS_ERROR;
      $sm = "Create Admin Success!";
      $name=$request->get('name');
      $password=$request->get('password');
      $email=$request->get('email');
      $username = $request->get('username');
      $address = $request->get('address');
      $mobile = $request->get('mobile');
      $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password'  => 'required|min:6',
                'email' => 'required|email|unique:dummyperson',
                'username' => 'required|unique:dummyperson'
      ]);
      if ($validator->fails()) 
      {
          return response()->json($validator->messages(), $fail);
      }
      else 
      {
        $newadmin= new Dummy;
        $newadmin->username=$username;
        $newadmin->nama = $name;
        $newadmin->password = $password;
        $newadmin->email = $email;
        $newadmin->role = 'admin';
        $newadmin->alamat = $address;
        $newadmin->hp = $mobile;
        $newadmin->save();
        return response()->json(['message' => $sm], $success);
      }
       
   }
   public function editAdmin(Request $request)
   {
      $success = self::STATUS_OK;
      $fail = self::STATUS_ERROR;
      $notfound= self::STATUS_NOT_FOUND;
      $sm = "Edit Admin Success!";
      $special = "Edit admin success with nothing changed!";
      $id=$request->get('id');
      $admin = Dummy::where('username','=',$id)->where('role','=','admin')->first();
      $message="No admin with that username found.";
      if(is_null($admin))
      {
            return response()->json(['message' => $message],$notfound);
      }
      else
      {
           $name=$request->get('name');
           $password=$request->get('password');
           $email=$request->get('email');
           $username = $request->get('username');
           $address = $request->get('address');
           $mobile = $request->get('mobile');
           $validator = Validator::make($request->all(), [
                'password'  => 'min:6',
                'email' => 'email|unique:dummyperson',
                'username' => 'unique:dummyperson'
          ]);
              if ($validator->fails()) {
                  return response()->json($validator->messages(), $fail);
              }else{
                  if(!is_null($name)){
                     $admin->nama = $name;
                     $admin->save();
                    return response()->json(['message' => $sm], $success);
                  }
                  if(!is_null($password)){
                     $admin->password = $password;
                     $admin->save();
                     return response()->json(['message' => $sm], $success);
                  }
                  if(!is_null($email)){
                     $admin->email = $email;
                     $admin->save();
                     return response()->json(['message' => $sm], $success);
                  }
                  if(!is_null($address)){
                     $admin->alamat = $address;
                     $admin->save();
                     return response()->json(['message' => $sm], $success);
                  }
                  if(!is_null($mobile)){
                     $admin->hp = $mobile;
                     $admin->save();
                     return response()->json(['message' => $sm], $success);
                  }
                  if(!is_null($username)){
                     $admin->username=$username;
                     $admin->save();
                     return response()->json(['message' => $sm], $success);
                  }
                  return response()->json(['message' => $special], $success);
              }
      }
   }
}
?>