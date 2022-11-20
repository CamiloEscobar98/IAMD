<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Repositories\Client\UserRepository;

class HomeController extends Controller
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
    }

    /**
     * @return View
     */
    public function home(): View
    {
        return view('client.pages.home');
    }

    /**
     * Get the Profile View
     * 
     * @return View
     */
    public function profile(): View|RedirectResponse
    {
        try {
            $item = current_user();

            return view('client.pages.profile', compact('item'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
