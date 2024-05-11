<?php  

enum ProjectStatusEnum:string
{
    const AWAITING_START='awaiting-start';
    const IN_PROGRESS='in-progress';
    const ON_HOLD='on-hold';
    const COMPLETE='complete';

    public static function checkValue($val):bool
    {
        return match($val){
            ProjectStatusEnum::AWAITING_START=>true,
            ProjectStatusEnum::IN_PROGRESS=>true,
            ProjectStatusEnum::ON_HOLD=>true,
            ProjectStatusEnum::COMPLETE=>true,
            default=>false
        };
        
    }
}