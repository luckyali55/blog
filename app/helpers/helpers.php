<?php




function getModels(){
    $path = app_path() ;
    $out = [];
    $results = scandir($path);
    foreach ($results as $result) {
        if ($result === '.' or $result === '..') continue;
        $filename = $path . '/' . $result;
        if (!is_dir($filename)) {
            $model = substr($filename,0,-4);
            $model_exp = explode('/', $model);
            $out[end($model_exp)] = ['create', 'read', 'update', 'delete'];
        }
    }
    return $out;
}


function userCan($operation, $model ){
    if(Auth::check() && false === Auth::user()->can($operation, $model ))
    {
        abort(401);
    }

}

function isAdmin(){
    if(Auth::check() && Auth::user()->isAn('admin'))
        return true;
    else
        return false;

}


function isUser(){
    if(Auth::check() && Auth::user()->isAn('user'))
        return true;
    else
        return false;
}