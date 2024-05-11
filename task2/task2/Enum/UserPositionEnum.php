<?php  

enum UserPositionEnum:string
{
    const DEVELOPER='developer';
    const PROJECT_MANAGER='project manager';
    const ADMIN='admin';

    public static function checkValue($val):bool
    {
        return match($val){
            UserPositionEnum::DEVELOPER=>true,
            UserPositionEnum::PROJECT_MANAGER=>true,
            UserPositionEnum::ADMIN=>true,
            default=>false
        };
        
    }
}
