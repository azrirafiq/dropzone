<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class CheckProductOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product_id = $request->product;
        
        $product = Product::find($product_id);

        if ($product) {
            $product_owner = $product->user_id;

            $current_user_id = auth()->id();

            if ($current_user_id!=$product_owner) {
                alert()->warning('you other user.','DANGER')->persistent('close');

                return redirect()->route('my_products');
            }
        }

        return $next($request);
    }
}
