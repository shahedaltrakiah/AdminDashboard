<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Messages;
use App\Models\User;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Task;

class AdminController extends Controller
{
    // View login Page
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Login
    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function dashboard()
    {
        // Existing data
        $data = [
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),
            'totalRecipes' => Recipe::count(),
            'totalOrders' => Order::count(),
            'recentRecipes' => Recipe::latest()->take(5)->get(),
        ];

        // Retrieve tasks
        $tasks = Task::all();

        // Return the view with the data
        return view('admin.dashboard', [
            'data' => $data,
            'tasks' => $tasks,
        ]);
    }


    // Create New Task
    public function storeTask(Request $request)
    {
        // Validate inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->created_at = now();
        $task->save();

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    // Update task status
    public function updateStatus($id, Request $request)
    {
        $task = Task::findOrFail($id);
        $task->completed = $request->completed;
        $task->save();

        return redirect()->back()->with('success' , 'Task status updated successfully!');
    }

    // Delete a task
    public function destroyTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

    public function updateTask(Request $request , $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->updated_at = now();
        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // View Admin Profile
    public function adminProfile()
    {
        $admin = Auth::user();
        return view('admin.admin-profile', compact('admin'));
    }

    // Update Admin Profile
    public function updateAdminProfile(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'current_password' => 'required_with:new_password|min:6',
            'new_password' => 'nullable|confirmed',
        ]);

        // Update password (if new password is provided)
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->current_password, $admin->password)) {
                $admin->password = Hash::make($request->new_password);
            } else {
                return withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }

        $admin->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    // -------------- Mange User ------------------

    // Display all users
    public function manageUser()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    // Store a new user
    public function storeUser(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User();
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'User added successfully!');
    }

    // Update user details
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->full_name = $request->full_name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    // Delete a user
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    // -------------- Mange categories ------------------

    // Display all categories
    public function manageCategory()
    {
        $categories = Category::all();
        return view('admin.manage-categories', compact('categories'));
    }

    // Store a new category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category_image' => 'nullable|image|max:1024',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->type = $request->type;

        if ($request->hasFile('category_image')) {
            $fileName =  Str::slug($category->name) . '.' . $request->file('category_image')->getClientOriginalExtension();
            $path = $request->file('category_image')->storeAs('categories', $fileName, 'public');
            $category->image = $path;
        }

        $category->save();
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    // Update category details
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category_image' => 'nullable|image|max:1024',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->type = $request->type;

        if ($request->hasFile('category_image')) {
            $fileName =  Str::slug($category->name) . '.' . $request->file('category_image')->getClientOriginalExtension();
            $path = $request->file('category_image')->storeAs('categories', $fileName, 'public');
            $category->image = $path;
        }


        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    // Delete a category
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    // Mange View category from the user page
    public function toggleStatus(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Update the is_active status
        $category->is_active = $request->is_active;
        $category->save();

        return response()->json(['success' => true]);
    }

    // -------------- Mange Recipes ------------------

    // Display all recipes
    public function manageRecipes()
    {
        $recipes = Recipe::with(['category', 'user'])->get();
        $categories = Category::all();
        return view('admin.manage-recipes', compact('recipes' , 'categories'));

    }

    // View Recipe details
    public function viewRecipe($id)
    {
        $recipe = Recipe::with(['category', 'user'])->findOrFail($id);

        return view('admin.view-recipes', compact('recipe'));
    }

    // Store a new recipe
    public function storeRecipe(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:recipes|max:255',
            'description' => 'required',
            'type' => 'required|exists:categories,id',
            'time' => 'required',
            'recipe_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe = new Recipe();
        $recipe->user_id = auth()->user()->id;
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->category_id = $request->type;
        $recipe->time = $request->time;

        if ($request->hasFile('recipe_image')) {
            $fileName = Str::slug($recipe->title) . '.' . $request->file('recipe_image')->getClientOriginalExtension();
            $path = $request->file('recipe_image')->storeAs('recipes', $fileName, 'public');
            $recipe->image = $path;
        }

        $recipe->save();

        return redirect()->back()->with('success', 'Recipe created successfully.');
    }

    // Update recipe details
    public function updateRecipe(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:recipes,title,' . $id . '|max:255',
            'description' => 'required',
            'type' => 'required|exists:categories,id',
            'time' => 'required',
            'recipe_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->category_id = $request->type;
        $recipe->time = $request->time;

        if ($request->hasFile('recipe_image')) {
            $fileName = Str::slug($recipe->title) . '.' . $request->file('recipe_image')->getClientOriginalExtension();
            $path = $request->file('recipe_image')->storeAs('recipes', $fileName, 'public');
            $recipe->image = $path;
        }

        $recipe->save();

        return redirect()->back()->with('success', 'Recipe updated successfully.');
    }

    // Delete a recipe
    public function destroyRecipe($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return redirect()->back()->with('success', 'Recipe deleted successfully.');
    }

    // Mange View Recipe from the user page
    public function toggleRecipeStatus(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        $recipe->is_active = $request->is_active;
        $recipe->save();

        return response()->json(['success' => true]);
    }

    // -------------- Mange Orders ------------------

    // Display all orders
    public function manageOrders(Request $request)
    {
        $search_status = $request->query('status', '');

        $orders = Order::when($search_status, function ($query, $status) {
            return $query->where('order_status', $status);
        })->with('user')->get();

        return view('admin.manage-orders', compact('orders', 'search_status'));
    }

    // Update status for the order
    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    // -------------- Mange Recipes ------------------

    // Display all comments
    public function manageComments(Request $request)
    {
        $search_status = $request->query('status', '');

        $comments = Comment::when($search_status, function ($query, $status) {
            return $query->where('comment_status', $status);
        })->get();

        return view('admin.manage-comments', compact('comments', 'search_status'));
    }

    // Update status for the comments
    public function updateComments(Request $request, $id)
    {
        $comments = Comment::findOrFail($id);

        $comments->comment_status = $request->input('status');
        $comments->save();

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    // -------------- Mange Messages ------------------

    // Display all messages
    public function manageMessages(Request $request)
    {
        $search_status = $request->query('status', '');

        $messages = Messages::when($search_status, function ($query, $status) {
            return $query->where('is_read', $status === 'read' ? 1 : 0);
        })
            ->get();

        return view('admin.manage-messages', compact('messages', 'search_status'));
    }

    // Update status for the messages
    public function messagesStatus(Request $request, $id)
    {
        $message = Messages::findOrFail($id);
        $message->is_read = $request->is_read;
        $message->save();

        return response()->json(['success' => true]);
    }

    // Replay for the messages
    public function replyMessage(Request $request)
    {
        $validatedData = $request->validate([
            'message_id' => 'required|exists:messages,id',
            'reply_content' => 'required|string|max:255',
        ]);

        $message = Messages::findOrFail($validatedData['message_id']);

        $message->reply_content = $validatedData['reply_content'];
        $message->save();

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

}

