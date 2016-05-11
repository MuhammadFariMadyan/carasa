<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Models\Person;
use App\Models\Kategori;
use App\Models\Product;
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
	
	public function getDashboard2()
    {
        $kategories = Kategori::where('id_kategori','>',0)->get();
        return view('kategori.listkategori', compact('kategories'));
    }
	
	public function getDashboard3()
    {
        $products = Product::where('product_id','>',0)->get();
        return view('product.listproduct', compact('products'));
    }
    public function editAdmin($id)
    {
        
            $result= Person::where('username','=',$id)->first();
            return view('admin.editadmin', compact('result'));
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
              $newuser->save();
              return redirect()->route('dashboard')->withErrors('An new User has just been added!'); 
    }
	
	public function saveKategori(Request $request)
{
        $keyword=$request->input('olduname');
		$keyword2=$request->input('oldid');
        $user_username=$request->input('nama');
       if($keyword!=$user_username){
             $unamecheck=$request->input('nama');
             
             $unamequery = Kategori::where('nama','=',$unamecheck)->first();
            
             if(!is_null($unamequery))
             {   
                 return redirect()->route('editkategori',array('id'=>$keyword))->withErrors('An user with that username or email has already exists!');             
            }
            $olduser = Kategori::where('nama','=',$keyword)->first();
            $olduser->delete();
            $newuser = new Kategori;
            $user_name=$request->input('nama');
            $newuser->nama=$user_name;
			$newuser->id_kategori=$keyword2;
            $newuser->save();
        }
         else if($keyword==$user_username){
             
            
            $olduser = Kategori::where('nama','=',$keyword)->first();
            $user_name=$request->input('nama');
            $olduser->nama=$user_name;
            
           
            $olduser->save();
        }
        return redirect()->route('dashboard')->withErrors('An user profile has just been updated!');
    }

     public function editKategori($id)
    {
        
             $result= Kategori::where('nama','=',$id)->first();
             return view('kategori.editkategori', compact('result'));
         
    }
    public function createKategori()
    {
        return view('kategori.addkategori');
    }
    public function deletekategori($id)
    {
        $result= Kategori::where('nama','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboardkategori')->withErrors('An new user has just been deleted!');
}

public function searchKategori(Request $request)
     {
         $username=$request->get('keyword');
         $kategories = Kategori::where('nama','like','%'.$username.'%')->get();
         return view('kategori.listkategori', compact('kategories')); 
     }
    public function registerKategori(Request $request)
    {
            $newkategori = new Kategori;
            $nama_kategori=$request->input('nama');
            $newkategori->nama=$nama_kategori;
            
            
            
            
           
             $kategoricheck=$request->input('nama');
             $unamequery = Kategori::where('nama','=',$kategoricheck)->first();
             
             if(!is_null($unamequery))
             {   
                 return redirect()->route('createkategori')->withErrors('An kategori with that name has already exists!');             
             }
              $newkategori->save();
              return redirect()->route('dashboardkategori')->withErrors('An new kategoi has just been added!'); 
    }
	
	public function saveProduct(Request $request)
{
        $keyword=$request->input('olduname');
		$keyword2=$request->input('oldstock');
        $user_username=$request->input('nama');
       if($keyword!=$user_username){
             $unamecheck=$request->input('nama');
             
             $unamequery = Kategori::where('nama','=',$unamecheck)->first();
            
             if(!is_null($unamequery))
             {   
                 return redirect()->route('editProduct',array('id'=>$keyword))->withErrors('An product with that username or email has already exists!');             
            }
            $olduser = Product::where('nama','=',$keyword)->first();
            $olduser->delete();
            $newuser = new Product;
            $user_name=$request->input('nama');
			$harga_product=$request->input('harga');
			$stock_product=$request->input('stock');
			$kategori_product=$request->input('kategori');
            $newuser->nama=$user_name;
			$newuser->harga=$harga_product;
			$newuser->stock=$stok_product;
			$newuser->kategori=$kategori_product;
			
            $newuser->save();
        }
         else if($keyword==$user_username){
             
            
            $olduser = Person::where('nama','=',$keyword)->first();
            $user_name=$request->input('nama');
            $olduser->nama=$user_name;
            
           
            $olduser->save();
        }
        return redirect()->route('dashboardProduct')->withErrors('An user profile has just been updated!');
    }

     public function editProduct($id)
    {
        
             $result= Product::where('nama','=',$id)->first();
             return view('product.editproduct', compact('result'));
         
    }
    public function createProduct()
    {
        return view('product.addproduct');
    }
    public function deleteProduct($id)
    {
        $result= Product::where('nama','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboardproduct')->withErrors('An new product has just been deleted!');
}

public function searchProduct(Request $request)
     {
         $username=$request->get('keyword');
         $products = Product::where('nama','like','%'.$username.'%')->get();
         return view('product.listproduct', compact('products')); 
     }
    public function registerProduct(Request $request)
    {
            $newproduct = new Product;
            $nama_product=$request->input('nama');
			
			$harga_product=$request->input('harga');
			//$kategori_product=$request->input('kategori');
			$stock_product=$request->input('stock');
			$gambar_product=$request->input('foto');
			
			
            $newproduct->nama=$nama_product;
			$newproduct->harga=$harga_product;
			//$newproduct->id_kategori=$kategori_product;
			$newproduct->stock=$stock_product;
            $newproduct->foto=$gambar_product;
            
            
            
           
             $productcheck=$request->input('nama');
             $unamequery = Product::where('nama','=',$productcheck)->first();
             
             if(!is_null($unamequery))
             {   
                 return redirect()->route('createproduct')->withErrors('An product with that name has already exists!');             
             }
              $newproduct->save();
              return redirect()->route('dashboard')->withErrors('An new kategoi has just been added!'); 
    }
	
	
}
	
	

?>