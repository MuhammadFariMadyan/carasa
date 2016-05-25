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
        return redirect()->route('dashboard')->withErrors('An admin has just been deleted!');
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
            
           if (PageController::adminEmailChecker($admin_email)||PageController::adminUnameChecker($admin_username)){
                return redirect()->route('createadmin')->withErrors('An admin with that email or username has already exists!');       
            } else{
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
        
        } else if($keyword==$admin_username) {
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
        if ($keyword!=$user_username)
        {
             $unamecheck=$request->input('username');
             $emailcheck=$request->input('email');
             $unamequery = Person::where('username','=',$unamecheck)->first();
             $emailquery = Person::where('email','=',$emailcheck)->first();
            if (!is_null($unamequery)||!is_null($emailquery))
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
        else if ($keyword==$user_username)
        {
            $emailcheck=$request->input('email');
            $emailquery = Person::where('email','=',$emailcheck)->first();
            
            if(!is_null($emailquery)&&!!$user_username==Person::where('email','=',$request)->first())
            {   
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
    
    public function deleteUser($id)
    {
        $result= Person::where('username','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboard')->withErrors('A new user has just been deleted!');
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
        return redirect()->route('dashboard')->withErrors('A new User has just been added!'); 
    }

    public function saveKategori(Request $request)
    {
        $keyword=$request->input('olduname');
        $keyword2=$request->input('oldid');
        $user_username=$request->input('nama');
        if($keyword!=$user_username)
        {
            $unamecheck=$request->input('nama');
             
            $unamequery = Kategori::where('nama','=',$unamecheck)->first();
            
            if(!is_null($unamequery))
            {   
                return redirect()->route('editkategori',array('nama'=>$keyword))->withErrors('An user with that username or email has already exists!');             
            }

            $olduser = Kategori::where('nama','=',$keyword)->first();
            $olduser->delete();
            $newuser = new Kategori;
            $user_name=$request->input('nama');
            $newuser->nama=$user_name;
            $newuser->id_kategori=$keyword2;
            $newuser->save();
        }
        else if($keyword==$user_username)
        {          
            $olduser = Kategori::where('nama','=',$keyword)->first();
            $user_name=$request->input('nama');
            $olduser->nama=$user_name;
           
            $olduser->save();
        }
        return redirect()->route('dashboard')->withErrors('An user profile has just been updated!');
    }

    public function editKategori($id)
    {
        $result= Kategori::where('id_kategori','=',$id)->first();
        return view('kategori.editkategori', compact('result'));    
    }
    
    public function createKategori()
    {
        return view('kategori.addkategori');
    }
    
    public function deleteKategori($id)
    {
        $result= Kategori::where('id_kategori','=',$id)->first();
        $result->delete();
        return redirect()->route('dashboardkategori')->withErrors('A category has just been deleted!');
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
            return redirect()->route('createkategori')->withErrors('A category with that name has already exists!');             
        }
        
        $newkategori->save();
        return redirect()->route('dashboardkategori')->withErrors('A new category has just been added!'); 
    }
    
    public function saveProduct(Request $request)
    {
        $keyword=$request->input('olduname');
        $keyword3=$request->input('oldid');
        $user_username=$request->input('nama');

        if($keyword!=$user_username)
        {
            $unamecheck=$request->input('nama');
             
            $unamequery = Kategori::where('nama','=',$unamecheck)->first();
            
            if(!is_null($unamequery))
            {   
                 return redirect()->route('editproduct',array('nama'=>$keyword))->withErrors('A product with that username or email has already exists!');             
            }
         
            $olduser = Product::where('nama','=',$keyword);
            $olduser->delete();
            $newuser = new Product;
            $user_name=$request->input('nama');
            $harga_product=$request->input('harga');
            $kategori_product=$request->input('kategori');
            $foto_product=$request->input('foto');
            $newuser->nama=$user_name;
            $newuser->harga=$harga_product;
            $newuser->foto=$foto_product;
            $newuser->id_kategori=$kategori_product;
            $newuser->product_id=$keyword3;
    
            $newuser->save();
        }
        
        else if($keyword==$user_username)
        { 
            $olduser = Person::where('nama','=',$keyword)->first();
            $user_name=$request->input('nama');
            $olduser->nama=$user_name;
           
            $olduser->save();
        }
        return redirect()->route('dashboardproduct')->withErrors('An user profile has just been updated!');
    }

    public function editProduct($id)
    {
        $result= Product::where('product_id','=',$id)->first();
        return view('product.editproduct', compact('result'));
    }

    public function createProduct()
    {
        return view('product.addproduct');
    }

    public function deleteProduct($id)
    {
        $result= Product::where('product_id','=',$id);
        $result->delete();
        return redirect()->route('dashboardproduct')->withErrors('A new product has just been deleted!');
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
        $kategori_product=$request->input('kategori');
        $gambar_product=$request->input('foto');


        $newproduct->nama=$nama_product;
        $newproduct->harga=$harga_product;
        $newproduct->id_kategori=$kategori_product;
        $newproduct->foto=$gambar_product;

        $productcheck=$request->input('nama');
        $unamequery = Product::where('nama','=',$productcheck)->first();

        if(!is_null($unamequery))
        {   
            return redirect()->route('createproduct')->withErrors('A product with that name has already exists!');             
        }
        $newproduct->save();
        return redirect()->route('dashboard')->withErrors('A new product has just been added!'); 
    }

}