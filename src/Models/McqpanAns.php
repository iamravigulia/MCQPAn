<?php
namespace Edgewizz\Mcqpan\Models;

use Illuminate\Database\Eloquent\Model;

class McqpanAns extends Model
{
    public function match(){
        return $this->belongsTo('Edgewizz\Mcqpan\Models\McqpanAns', 'match_id');
    }
    protected $table = 'fmt_mcqpan_ans';
}
