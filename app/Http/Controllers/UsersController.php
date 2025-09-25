<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Auth;

class UsersController extends Controller
{
    private $moduleCode = 'users';
    //
    public function index()
    {
        $this->authorize('view', $this->moduleCode);
        $roles = \App\Model\Roles::pluck('name', 'id');
        $opds = \App\Opd::pluck('name', 'id');
        return view('settings.users.index', [
            'roles' => $roles,
            'opds' => $opds,
            'moduleCode' => $this->moduleCode
        ]);
    }

    public function fetch(Request $request)
    {
        $user = Auth::user();
        $data = User::select(['users.id', 'users.name', 'users.email', 'roles.name AS role_name', 'users.job_title'])
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($user) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i class="fa fa-eye"></i></a> ';
                if ($user->can('edit', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i class="fa fa-pencil"></i></a> ';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="User" class="btn btn-xs btn-icon btn-circle btn-info btn-action-login"><i class="fa fa-sign-in"></i></a> ';
                }
                if ($user->can('delete', $this->moduleCode) == 1) {
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i class="fa fa-trash"></i></a>';
                }
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('users.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                            ->orWhere('users.email', 'LIKE', "%" . Str::lower($search['value']) . "%")
                            ->orWhere('roles.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                    });
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request, User $user)
    {
        $this->authorize('create', $this->moduleCode);
        
        
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'job_title' => $request->job_title,
            'opd_id' => $request->opd_id,
            'password' => Hash::make($request->password),
            'status' => 1,
            'avatar' => 'avatar.png',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if ($data->id) {
            return response()->json([
                'success' => true,
                'message' => 'Add user success'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Add user failure'
            ]);
        }
    }

    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $this->moduleCode);
        User::where('id', $request->id)->delete();
        return response()->json(['success' => true]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('edit', $this->moduleCode);
        $field = [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
        ];

        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'job_title' => $request->job_title,
            'opd_id' => $request->opd_id,
        ];

        if ($request->password || $request->password_confirmation) {
            $field['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $field['password_confirmation'] = ['required', 'string', 'min:8', 'same:password'];
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $validator = \Validator::make($request->all(), $field);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        User::where('id', $request->id)->update($dataUpdate);
        return response()->json([
            'success' => true,
            'message' => 'Update user success'
        ]);
    }

    public function edit($id)
    {
        $this->authorize('edit', $this->moduleCode);
        $Users = User::find($id);
        return response()->json($Users);
    }

    public function show($id)
    {
        $Users = User::find($id);
        return response()->json($Users);
    }

    public function profile()
    {
        return view('settings.users.profile');
    }

    public function biodata(Request $request)
    {
        $dataUpdate = [
            $request->name => $request->value
        ];
        $user = Auth::user();
        User::where('id', $user->id)->update($dataUpdate);
        return response()->json([
            'success' => true,
            'message' => 'Update user success'
        ]);
    }

    public function editpass(Request $request)
    {
        $user = auth()->user();
        $fieldValidate['password'] = ['required', function ($attribute, $value, $fail) use ($user) {
            if (!Hash::check($value, $user->password)) {
                $fail('Your password was not updated, since the provided current password does not match.');
            }
        }];
        $fieldValidate['password_new'] = ['required', 'string', 'min:8', 'different:password'];
        $fieldValidate['password_confirm'] = ['required', 'string', 'min:8', 'same:password_new'];
        $validator = \Validator::make($request->all(), $fieldValidate);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        } else {
            if ($request->password && $request->password_new) {
                $user->fill([
                    'password' => Hash::make($request->password_new)
                ])->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Update password success'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->toArray()
                ], 422);
            }
        }
    }
    public function avatar(Request $request)
    {
        $fieldValidate['file'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512';
        $validator = \Validator::make($request->all(), $fieldValidate);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        } else {
            $user = Auth::user();
            $employee = User::find($user->id);
            $file = $request->file;
            if ($request->hasFile('file')) {
                $filenameWithExt = $request->file('file')->getClientOriginalName();
                $extension = $request->file('file')->getClientOriginalExtension();
                $filenameSimpan = $user->id . '_' . time() . '.' . $extension;

                if ($request->file('file')->storeAs('/profile/', $filenameSimpan, ['disk' => 'profile_uploads'])) {
                    $employee->update(['avatar' => $filenameSimpan]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Update success'
                    ]);
                }
            }
        }
    }
    public function login(Request $request)
    {
        if (Auth::loginUsingId($request->id)) {
            return response()->json([
                'success' => true,
                'message' => 'Success'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised'
            ], 403);
        }
    }
}
