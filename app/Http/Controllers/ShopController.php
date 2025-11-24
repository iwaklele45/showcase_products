<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index($username)
    {
        // Redirect to categories index to keep listing logic in CategoryController
        return redirect()->route('seller.categories.index', $username);
    }
}
