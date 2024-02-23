<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Seeder
        $user = User::create([
            'name' => 'mohamed tarek', 
            'email' => 'donia.a5ra2019@gmail.com',
            'password' => bcrypt('123456789'),
            'Role'=> ['Admin'],
        ]);
      
        $role = Role::create(['name' => 'Admin']);
       
        $permissions = Permission::pluck('id','id')->all();
     
        $role->syncPermissions($permissions);
       
        $user->assignRole([$role->id]);
    }
}