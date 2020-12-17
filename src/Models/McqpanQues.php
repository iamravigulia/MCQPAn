<?php
namespace Edgewizz\Mcqpan\Models;

use Illuminate\Database\Eloquent\Model;

class McqpanQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Mcqpan\Models\McqpanAns', 'question_id');
    }
    protected $table = 'fmt_mcqpan_ques';
}