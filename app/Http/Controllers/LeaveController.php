<?php

namespace App\Http\Controllers;

class LeaveController extends Controller
{
    public function index()
    {
        // 1. Leave Calendar Data
        $calendar = [
            ['name' => 'Maria Santos', 'type' => 'Vacation Leave', 'dates' => 'Apr 20-22', 'color' => 'border-[#22C55E]'],
            ['name' => 'Pedro Alvarez', 'type' => 'Vacation Leave', 'dates' => 'Apr 10-12', 'color' => 'border-[#22C55E]'],
            ['name' => 'Jose Reyes', 'type' => 'Sick Leave', 'dates' => 'Apr 16-17', 'color' => 'border-[#F59E0B]'],
            ['name' => 'Ana Garcia', 'type' => 'Emergency Leave', 'dates' => 'Apr 18', 'color' => 'border-[#EF4444]'],
        ];

        // 2. Pending Requests Data
        $requests = [
            [
                'initials' => 'MS', 'name' => 'Maria Santos', 'applied' => 'Apr 10, 2026', 
                'type' => 'Vacation Leave', 'type_class' => 'bg-[#DCFCE7] text-[#16A34A]',
                'dates' => 'Apr 20, 2026', 'to_dates' => 'to Apr 22, 2026', 'days' => 3, 
                'reason' => 'Family vacation', 'status' => 'Pending'
            ],
            [
                'initials' => 'JR', 'name' => 'Jose Reyes', 'applied' => 'Apr 12, 2026', 
                'type' => 'Sick Leave', 'type_class' => 'bg-[#FFEDD5] text-[#F97316]',
                'dates' => 'Apr 16, 2026', 'to_dates' => 'to Apr 17, 2026', 'days' => 2, 
                'reason' => 'Medical appointment', 'status' => 'Pending'
            ],
            [
                'initials' => 'AG', 'name' => 'Ana Garcia', 'applied' => 'Apr 13, 2026', 
                'type' => 'Emergency Leave', 'type_class' => 'bg-[#FEE2E2] text-[#DC2626]',
                'dates' => 'Apr 18, 2026', 'to_dates' => '', 'days' => 1, 
                'reason' => 'Family emergency', 'status' => 'Pending'
            ],
        ];

        // 3. Leave Balances Data
        $balances = [
            ['name' => 'Juan Dela Cruz', 'vacation' => '10 days', 'sick' => '7 days', 'emergency' => '3 days'],
            ['name' => 'Maria Santos', 'vacation' => '8 days', 'sick' => '10 days', 'emergency' => '3 days'],
            ['name' => 'Jose Reyes', 'vacation' => '12 days', 'sick' => '8 days', 'emergency' => '3 days'],
            ['name' => 'Ana Garcia', 'vacation' => '15 days', 'sick' => '12 days', 'emergency' => '3 days'],
        ];

        return view('leave.index', compact('calendar', 'requests', 'balances'));
    }
}