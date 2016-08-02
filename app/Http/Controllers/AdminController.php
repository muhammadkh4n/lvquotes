<?php
/**
 * Created by PhpStorm.
 * User: muhammadkh4n
 * Date: 8/2/16
 * Time: 3:18 PM
 */

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function getLogin() {
        return view('admin.login');
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('index');
    }

    public function getDashboard() {
        $authors = Author::all();
        return view('admin.dashboard', ['authors' => $authors]);
    }

    public function postLogin(Request $req) {
        $this->validate($req, [
            'name' => 'required',
            'password' => 'required'
        ]);

        $name = $req['name'];
        $password = $req['password'];
        if (!Auth::attempt(['name' => $name, 'password' => $password])) {
            return redirect()->back()->with(['fail' => 'You are not authenticated!']);
        }

        return redirect()->route('dashboard');
    }
}