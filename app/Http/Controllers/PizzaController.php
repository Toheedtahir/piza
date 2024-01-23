<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
    public function index()
    {
        // Retrieve all pizzas, including soft-deleted
        $pizzas = Pizza::withTrashed()->latest()->get();

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

    public function create()
    {
        return view('pizzas.create');
    }

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

    public function destroy($id)
    {
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();
        return redirect('/pizzas');
    }

 public function restore($id)
    {
        $pizza = Pizza::withTrashed()->find($id);

        if (!$pizza) {
            return response()->json(['message' => 'Pizza not found'], 404);
        }

        $pizza->restore();

        return response()->json(['message' => 'Pizza restored successfully']);
    }
  }