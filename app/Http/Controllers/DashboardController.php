<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Exibe a visão geral do usuário com métricas e dados resumidos.
     */
    public function index(): View
    {
        $userId = auth()->id();

        $totalProducts = Product::where('user_id', $userId)->count();
        $activeProducts = Product::where('user_id', $userId)->where('status', true)->count();
        $totalCategories = Category::where('user_id', $userId)->count();
        $stockUnits = Product::where('user_id', $userId)->sum('stock');
        $inventoryValue = Product::where('user_id', $userId)
            ->selectRaw('COALESCE(SUM(price * stock), 0) as total')
            ->value('total') ?? 0;
        $totalImages = Archive::whereHas('products', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $activeRate = $totalProducts > 0 ? round(($activeProducts / $totalProducts) * 100) : 0;

        $topCategories = Category::where('user_id', $userId)
            ->withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get();

        $recentProducts = Product::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->limit(6)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'activeProducts',
            'activeRate',
            'totalCategories',
            'stockUnits',
            'inventoryValue',
            'totalImages',
            'topCategories',
            'recentProducts'
        ));
    }
}
