<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF;


class ReportController extends Controller
{
    public function generateAdminReport()
    {
        $products = Product::with('user')->get();
        $pdf = PDF::loadView('admin.product.report', compact('products'));
        return $pdf->download('admin_product_report.pdf');
    }
    


    // Method for User to Generate PDF Report
    public function generateUserReport()
    {
        $user = auth()->user();
        $products = Product::with('user')->where('user_id', $user->id)->get();
        $pdf = PDF::loadView('user.product.report', compact('products'));
        return $pdf->download('user_product_report.pdf');
    }
    
    }
    
    


