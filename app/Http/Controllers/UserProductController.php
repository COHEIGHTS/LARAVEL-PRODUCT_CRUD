<?Php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();

        $query = $request->get('search');
        $productsQuery = Product::where('user_id', $user_id);

        if (!empty($query)) {
            // Search for products by title or category
            $productsQuery->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%$query%")
                             ->orWhere('category', 'LIKE', "%$query%");
            });
        }
        $products = $productsQuery->orderBy('id', 'desc')->paginate(4);
        $total = $products->total();

        return view('user.product.home', compact('products', 'total'));
    }

    public function create()
    {
        return view('user.product.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
        ]);
        $user_id = auth()->user()->id;
        $validation['user_id'] = $user_id;
        $data = Product::create($validation);
        

        if ($data) {
            session()->flash('success', 'Product added successfully');
            return redirect()->route('/products');
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect()->route('products/create');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('user.product.update', compact('product'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id)->delete();

        if ($product) {
            session()->flash('success', 'Product deleted successfully');
            return redirect()->route('/products');
        } else {
            session()->flash('error', 'Product not deleted successfully');
            return redirect()->route('/products/delete');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->title = $request->title;
        $product->category = $request->category;
        $product->price = $request->price;

        $data = $product->save();

        if ($data) {
            session()->flash('success', 'Product updated successfully');
            return redirect()->route('/products');
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect()->route('/products/edit', ['id' => $id]);
        }
    }
}
