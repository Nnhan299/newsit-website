<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'user_id', 'created_at'
    ];
    public function index()
{
    // Truy vấn các hoạt động gần đây
    $recentActivities = Activity::latest()->take(5)->get(); // lấy 5 hoạt động gần đây

    // Trả về view và truyền dữ liệu $recentActivities
    return view('admin.index', compact('recentActivities'));
    
}
}