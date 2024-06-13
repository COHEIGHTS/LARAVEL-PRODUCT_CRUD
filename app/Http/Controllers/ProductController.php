<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;


 
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        
        $query = $request->get('search');
        
        

    if (!empty($query)) {
        // Search for products by title or other attributes
        $products = Product::where('title', 'LIKE', "%$query%")
                           ->orWhere('category', 'LIKE', "%$query%")
                           ->orderBy('id', 'desc')
                           ->paginate();
    } else {
        
        $products = Product::leftJoin('users as u','u.id','=','products.user_id')
            ->select('products.*','u.name as customer_name')
             ->orderBy('id', 'desc')->paginate(3);
    }

        $total = Product::count();
        
        return view('admin.product.home', compact(['products', 'total']));
    }
    
    public function userProducts($userId)
    {
        // $Query the products table to get products owned by the user
    
        $products = DB::table('products')
                      ->where('user_id', $userId)
                      ->paginate(4);

        // Return the 'user_products' view with the products data
        return view('admin.product.home', compact('products'))->with('isUserView', true);
    }

 
    public function create()
    {
    

    

        return view('admin.product.create');
    }
 
    public function save(Request $request)

    {
        
        
        $validation = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'price' => 'required',
    
            
        
        ]);
        
        
        $data = Product::create($validation);
        if ($data) {
            session()->flash('success', 'Product Add Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Some problem occured');
            return redirect(route('admin.products/create'));
        }
    }
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        
        
        return view('admin.product.update', compact('products'));
    }
 
    public function delete($id)
    {
        
        $products = Product::findOrFail($id)->delete();
        if ($products) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('admin/products'));
        }
        
    }
 
    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
    
        $title = $request->title;
        $category = $request->category;
        $price = $request->price;
 
        $products->title = $title;
        $products->category = $category;
        $products->price = $price;
        $data = $products->save();
        if ($data) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('admin/products'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/products/update'));
        }
    }

    
}
