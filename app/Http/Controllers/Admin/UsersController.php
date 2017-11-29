<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\User;
use yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UsersController extends MainAdminController
{

    public function __construct(Request $request)
    {
        if(
            null !== $request->query('userlock')
            or null !== $request->query('userunlock')
            or null !== $request->query('useradmin')
            or null !== $request->query('userunadmin')
            or null !== $request->query('staff')
            or null !== $request->query('unstaff')
        ){

            $this->middleware('DemoAdmin', ['only' => ['users']]);
        }

        parent::__construct();

    }

    public function users(Request $request){

        if (Auth::user()->usertype != 'Admin') {
            return redirect('/admin');
        }
        
        if(null !== $request->query('userlock')){

            $post = User::findOrFail($request->query('userlock'));
            $post->usertype = 'banned';
            $post->save();
            \Session::flash('success.message', 'Banned');
            return redirect()->back();

        }elseif(null !== $request->query('userunlock')){

            $post = User::findOrFail($request->query('userunlock'));
            $post->usertype = null;
            $post->save();
            \Session::flash('success.message', 'Unlocked');
            return redirect()->back();

        }elseif(null !== $request->query('useradmin')){

            $post = User::findOrFail($request->query('useradmin'));
            $post->usertype = 'Admin';
            $post->save();
            \Session::flash('success.message', 'Success');
            return redirect()->back();

        }elseif(null !== $request->query('userunadmin')){

            $post = User::findOrFail($request->query('userunadmin'));
            $post->usertype = null;
            $post->save();
            \Session::flash('success.message', 'Now user is not admin!');
            return redirect()->back();

        }elseif(null !== $request->query('staff')){

            $post = User::findOrFail($request->query('staff'));
            $post->usertype = 'Staff';
            $post->save();
            \Session::flash('success.message', 'Success');
            return redirect()->back();

        }elseif(null !== $request->query('unstaff')){

            $post = User::findOrFail($request->query('unstaff'));
            $post->usertype = null;
            $post->save();
            \Session::flash('success.message', 'Success');
            return redirect()->back();

        }


        $typew = $request->query('only');

        return view('_admin.pages.users')->with(['type' =>$typew]);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getdata()
    {
        if (Auth::user()->usertype != 'Admin') {
            return redirect('/admin');
        }
        
        $type = \Request::query('only');

        $user = DB::table('users');
        $user->select('*');

        if($type=='admins'){
            $user->where('usertype', '=', 'Admin');
        }elseif($type=='staff'){
            $user->where('usertype', '=', 'Staff');
        }elseif($type=='banned'){
            $user->where('usertype','=', 'banned');
        }



        return Datatables::of($user)

            ->editColumn('icon', '<img src=" {{ makepreview($icon, \'s\', \'members/avatar\') }}" width="55" height="55">')

            ->editColumn('username', function ($user) {
                $type2="";$type3="";
                $type= '<a href="/profile/'.$user->username_slug.'"  target="_blank" > '.$user->username.'  </a><div class=clear></div>';

                if($user->facebookurl) {

                    $type2 = '<a href="'.$user->facebookurl.'" target=_blank class="btn btn-social-icon btn-facebook" style="height: 24px;width: 24px;margin-right:5px;margin-top:5px"><i class="fa fa-facebook" style="line-height: 24px;font-size: 1.2em;"></i></a>';

                }

                if($user->twitterurl) {

                    $type3 = '<a href="'.$user->twitterurl.'" target=_blank class="btn btn-social-icon btn-twitter" style="height: 24px;width: 24px;margin-top:5px;"><i class="fa fa-twitter" style="line-height: 24px;font-size: 1.2em;"></i></a>';

                }

                return $type.$type2.$type3;
            })

            ->editColumn('email', function ($user) {

                if (\Auth::user()->email == 'demo@admin.com') {

                    return "-YOU DO'NT HAVE PERMISSION TO SEE THAT-";
                }

                return $user->email;
            })



            ->addColumn('status', function ($user) {

                if($user->usertype=='Admin') {

                    return '<div class="label label-default">Admin</div>';

                }elseif($user->usertype=='Staff') {

                    return '<div class="label label-warning">Publisher</div>';

                }elseif($user->usertype=='banned') {

                    return '<div class="label label-danger">Banned</div>';

                 }elseif($user->usertype=='approve') {

                    return '<div class="label label-info">Member</div>';

                }else{
                    return '<div class="label label-info">Member</div>';

                }
            })


            ->addColumn('action', function ($user) {

                $adminbutton=""; $staffbutton=""; $memberbutton="";

               $editbutton=   '  <a href="/profile/'.$user->username_slug.'/settings"  target="_blank" class="btn btn-sm btn-success" role="button" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a>';

               if($user->usertype=='banned') {
                   $lockbutton=      ' <a class="btn btn-sm btn-default permanently" href="?userunlock='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Unlock User"><i class="fa fa-unlock"></i></a>';
               }else{
                   $lockbutton=      ' <a class="btn btn-sm btn-danger permanently" href="?userlock='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Lock User"><i class="fa fa-lock"></i></a>';

                   $memberbutton=   ' <a class="btn btn-sm btn-info " href="?unstaff='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Make Member"><i class="fa fa-user"></i></a>' ;

                   $staffbutton=  ' <a class="btn btn-sm btn-warning" href="?staff='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Make Publisher"><i class="fa fa-thumbs-up"></i></a>';

                   $adminbutton= ' <a class="btn btn-sm btn-default " href="?useradmin='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Make Admin"><i class="fa fa-male"></i></a>';
//                    if($user->usertype=='Admin') {
//                        $adminbutton=     ' <a class="btn btn-sm btn-default " href="?userunadmin='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Not Admin"><i class="fa fa-remove"></i></a>' ;
//                    }else{
//                        $adminbutton=  $lockbutton.   ' <a class="btn btn-sm btn-info " href="?useradmin='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Make Admin"><i class="fa fa-user-secret"></i></a>';
//
//                        if($user->usertype=='Staff') {
//                            $staffbutton=  ' <a class="btn btn-sm btn-default " href="?unstaff='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Not Editor/Staff"><i class="fa fa-remove"></i></a>' ;
//                        }else{
//                            $staffbutton=  ' <a class="btn btn-sm btn-warning" href="?staff='.$user->id.'" role="button" data-toggle="tooltip" data-original-title="Make Editor/Staff"><i class="fa fa-thumbs-up"></i></a>';
//                        }
//                    }

               }


                return $editbutton.$lockbutton.$memberbutton.$staffbutton.$adminbutton;
            })


            ->make(true);

    }
}
