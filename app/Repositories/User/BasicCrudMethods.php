<?php

namespace App\Repositories\User;

trait BasicCrudMethods
{
    public static function users($role)
    {
        try {
            return self::where('role',$role)->get();
        } catch (\Exception $e) {

            $result = [
                'exception_message_front' => $e->getMessage(),
                'exception_message_line' => $e->getLine(),
                'exception_message_file' => $e->getFile(),
                'success' => 'false'
            ];
            return response()->json($result, 400);
        }
    }
}
