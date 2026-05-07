<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['employee_id' => 'EMP001', 'first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'initials' => 'JC', 'email' => 'juan@company.com', 'password' => bcrypt('password123'), 'department' => 'HR', 'position' => 'HR Officer', 'hire_date' => '2020-01-15', 'status' => 'Active'],
            ['employee_id' => 'EMP002', 'first_name' => 'Maria', 'last_name' => 'Santos', 'initials' => 'MS', 'email' => 'maria@company.com', 'password' => bcrypt('password123'), 'department' => 'Sales', 'position' => 'Sales Manager', 'hire_date' => '2019-03-10', 'status' => 'Active'],
            ['employee_id' => 'EMP003', 'first_name' => 'David', 'last_name' => 'Lopez', 'initials' => 'DL', 'email' => 'david@company.com', 'password' => bcrypt('password123'), 'department' => 'IT', 'position' => 'IT Support', 'hire_date' => '2021-06-01', 'status' => 'Active'],
            ['employee_id' => 'EMP004', 'first_name' => 'Ana', 'last_name' => 'Garcia', 'initials' => 'AG', 'email' => 'ana@company.com', 'password' => bcrypt('password123'), 'department' => 'Marketing', 'position' => 'Marketing Associate', 'hire_date' => '2022-02-14', 'status' => 'Active'],
            ['employee_id' => 'EMP005', 'first_name' => 'Pedro', 'last_name' => 'Alvarez', 'initials' => 'PA', 'email' => 'pedro@company.com', 'password' => bcrypt('password123'), 'department' => 'Engineering', 'position' => 'Junior Developer', 'hire_date' => '2023-08-20', 'status' => 'Active'],
            ['employee_id' => 'EMP006', 'first_name' => 'Rosa', 'last_name' => 'Mendoza', 'initials' => 'RM', 'email' => 'rosa@company.com', 'password' => bcrypt('password123'), 'department' => 'Finance', 'position' => 'Accountant', 'hire_date' => '2018-11-05', 'status' => 'Inactive'],
        ];

        foreach ($employees as $emp) {
            Employee::create($emp);
        }
    }
}