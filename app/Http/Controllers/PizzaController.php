<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{

  // public function __construct(){
  //   $this-> middleware('auth');
  // }


  public function index() {

    // $pizzas = Pizza::all();  
    // $pizzas = Pizza::orderBy('name', 'desc')->get();
    // $pizzas = Pizza::where('type', 'hawaiian')->get();
    $pizzas = Pizza::latest()->get();      

    return view('pizzas.index', [
      'pizzas' => $pizzas,
    ]);
  }
  public function show($id)
{
    $pizza = Pizza::findOrFail($id);

    // Check if pizza details are available in the session
    $pizzaDetails = session('pizzaDetails');

    return view('pizzas.show', [
        'pizza' => $pizza,
        'pizzaDetails' => $pizzaDetails,
    ]);
}


  public function create() {
    return view('pizzas.create');
  }

  // app/Http/Controllers/PizzaController.php

// app/Http/Controllers/PizzaController.php

public function store(Request $request)
{
    // Your existing code to fill in the pizza details
    $pizza = new Pizza;
    $pizza->name = $request->input('name');
    $pizza->type = $request->input('type');
    $pizza->base = $request->input('base');
    $pizza->toppings = $request->input('toppings');

    // Save the pizza details to the database
    $pizza->save();

    // Set pizza details in the session
    session()->put('pizzaDetails', [
        'name' => $pizza->name,
        'type' => $pizza->type,
        'base' => $pizza->base,
        'toppings' => $pizza->toppings,
    ]);

    // Redirect to the home route (you can adjust this to the welcome route)
    return redirect('/')->with('mssg', 'Thanks for your order');
}





 public function destroy($id) {
    $pizza = Pizza::findOrFail($id);
    $pizza->delete();
    return redirect('/pizzas');
  }


}