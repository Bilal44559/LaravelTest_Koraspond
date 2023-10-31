<?php

use App\Models\Product;

function apiResponse($status = '', $message = '', $code = '', $data = ''){
    return response(['status' => $status, 'message' => $message, 'product' => $data, 'code' => $code]);
}
