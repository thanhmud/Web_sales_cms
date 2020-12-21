<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Media;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use App\Models\TagLink;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Company;
use Auth;
use Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('Admin/right-col-edit',function($view){
            $data['category'] = Category::all();
            $data['category_add'] = Category::all();
            $data['media']  = Media::where('type',1)->get();
           $view->with($data);
        });
        view()->composer('layouts/topbar',function($view){
            if('users.avatar' != null){
                $data['profile'] = Media::join('users','users.avatar','=','media.id')->where('users.id',Auth::user()->id)->select('media.url')->first();
                $view->with($data);
            }
        });
        view()->composer('layouts/sidebar',function($view){
           $data['profile'] = Media::join('users','users.avatar','=','media.id')->where('users.id',Auth::user()->id)->select('media.url')->first();
           $view->with($data);
        });
        // validate price
        Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
          $min_field = $parameters[0];
          $data = $validator->getData();
          $min_value = $data[$min_field];
          return $value < $min_value;
        });   

        Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
          return str_replace(':field', $parameters[0], $message);
        });

        //view menu client
        view()->composer('Client/Layouts/menu',function($view){
            $data['menu'] = Menu::all();
            $view->with($data);
        });
        //list tag
        view()->composer('Client/Blog/sidebar-blog',function($view){
           $data['lists_tag'] = Tag::where('type',1)->limit(10)
                    ->get();
           //post recent         
           $data['post_laster'] = Post::where('type',0)->orderBy('id','desc')->limit(3)->get();
            $view->with($data);
        });
        view()->composer('Client/Shop/sidebar-shop',function($view){
           $data['lists_category'] = Category::where('type',2)->limit(10)->get();
           //post recent 
           $data['post_laster'] = Post::where('type',0)->orderBy('id','desc')->limit(3)->get();
            $view->with($data);
        });
        view()->composer('Client/Layouts/header',function($view){
           $data['company'] = Company::all();
            $view->with($data);
        });
    }
}
