<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index(Request $request):array{
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $users = User::query()->select('id', 'name', 'email', 'role_id', 'profile_photo')->with('role');

        if($request->has('search')){
            $users = $users->where('name', 'like', '%'.$request->get('search').'%');
        }
        
        return $users->paginate($limit, ['*'], 'page', $page)->toArray();
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return array
     */
    public function createUser(array $data):array{
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pin' => $data['pin'],
            'role_id' => $data['role_id'],
            'profile_photo' => $data['profile_photo_path'] ?? null
        ]);

        if(!$user){
            return [
                'data' => null,
                'code' => 500,
                'message' => 'Failed to create user'
            ];
        }
        
        return [
            'data' => $user,
            'code' => 201,
            'message' => 'User created successfully'
        ];
    }

    public function getUser($id):array{
        $user = User::findOrFail($id);

        if(!$user){
            return [
                'data' => null,
                'code' => 404,
                'message' => 'User not found'
            ];
        }
        
        return [
            'data' => $user,
            'code' => 200,
            'message' => 'User found'
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  array  $data
     * @return array
     */
    public function update($id, array $data):array{
        $user = User::findOrFail($id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pin' => $data['pin'],
            'role_id' => $data['role_id'],
            'profile_photo' => $data['profile_photo_path'] ?? null
        ]);

        if(!$user){
            return [
                'data' => null,
                'code' => 404,
                'message' => 'User not found'
            ];
        }

        if(!$user->save()){
            return [
                'data' => null,
                'code' => 500,
                'message' => 'Failed to update user'
            ];
        }
        
        return [
            'data' => $user,
            'code' => 200,
            'message' => 'User updated successfully'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function delete($id):array{
        $user = User::findOrFail($id);
        $user->delete();

        if(!$user){
            return [
                'data' => null,
                'code' => 404,
                'message' => 'User not found'
            ];
        }
        
        return [
            'data' => null,
            'code' => 200,
            'message' => 'User deleted successfully'
        ];
    }
}
