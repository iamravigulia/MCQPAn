<?php

namespace edgewizz\mcqpan\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Mcqpan\Models\McqpanAns;
use Edgewizz\Mcqpan\Models\McqpanQues;
use Illuminate\Http\Request;

class McqpanController extends Controller
{
    //
    public function test(){
        dd('hello');
    }
    public function store(Request $request){
        $pmQ = new McqpanQues();
        $pmQ->question = $request->question;
        $pmQ->difficulty_level_id = $request->difficulty_level_id;
        $pmQ->save();
        /* answer1 */
        if($request->answer_1_media){
            $answer_1 = new McqpanAns();
            $answer_1->question_id = $pmQ->id;
            // $answer_1->answer = $request->answer_1;
                $answer_1_media = new Media();
                $request->answer_1_media->storeAs('public/answers', time().$request->answer_1_media->getClientOriginalName());
                $answer_1_media->url = 'answers/'.time().$request->answer_1_media->getClientOriginalName();
                $answer_1_media->save();
            $answer_1->media_id = $answer_1_media->id;
            if ($request->ans_correct_1) {
                $answer_1->arrange = 1;
            }
            $answer_1->save();
        }
        /* //answer1 */
        /* answer2 */
        if($request->answer_2_media){
            $answer_2 = new McqpanAns();
            $answer_2->question_id = $pmQ->id;
            // $answer_2->answer = $request->answer_2;
                $answer_2_media = new Media();
                $request->answer_2_media->storeAs('public/answers', time().$request->answer_2_media->getClientOriginalName());
                $answer_2_media->url = 'answers/'.time().$request->answer_2_media->getClientOriginalName();
                $answer_2_media->save();
            $answer_2->media_id = $answer_2_media->id;
            if ($request->ans_correct_2) {
                $answer_2->arrange = 1;
            }
            $answer_2->save();
        }
        /* //answer2 */
        /* answer3 */
        if($request->answer_3_media){
            $answer_3 = new McqpanAns();
            $answer_3->question_id = $pmQ->id;
            // $answer_3->answer = $request->answer_3;
                $answer_3_media = new Media();
                $request->answer_3_media->storeAs('public/answers', time().$request->answer_3_media->getClientOriginalName());
                $answer_3_media->url = 'answers/'.time().$request->answer_3_media->getClientOriginalName();
                $answer_3_media->save();
            $answer_3->media_id = $answer_3_media->id;
            if ($request->ans_correct_3) {
                $answer_3->arrange = 1;
            }
            $answer_3->save();
        }
        /* //answer3 */
        /* answer4 */
        if($request->answer_4_media){
            $answer_4 = new McqpanAns();
            $answer_4->question_id = $pmQ->id;
            // $answer_4->answer = $request->answer_4;
                $answer_4_media = new Media();
                $request->answer_4_media->storeAs('public/answers', time().$request->answer_4_media->getClientOriginalName());
                $answer_4_media->url = 'answers/'.time().$request->answer_4_media->getClientOriginalName();
                $answer_4_media->save();
            $answer_4->media_id = $answer_4_media->id;
            if ($request->ans_correct_4) {
                $answer_4->arrange = 1;
            }
            $answer_4->save();
        }
        /* //answer4 */
        /* answer5 */
        if($request->answer_5_media){
            $answer_5 = new McqpanAns();
            $answer_5->question_id = $pmQ->id;
            // $answer_5->answer = $request->answer_5;
                $answer_5_media = new Media();
                $request->answer_5_media->storeAs('public/answers', time().$request->answer_5_media->getClientOriginalName());
                $answer_5_media->url = 'answers/'.time().$request->answer_5_media->getClientOriginalName();
                $answer_5_media->save();
            $answer_5->media_id = $answer_5_media->id;
            if ($request->ans_correct_5) {
                $answer_5->arrange = 1;
            }
            $answer_5->save();
        }
        /* //answer5 */
        /* answer6 */
        if($request->answer_6_media){
            $answer_6 = new McqpanAns();
            $answer_6->question_id = $pmQ->id;
            // $answer_6->answer = $request->answer_6;
                $answer_6_media = new Media();
                $request->answer_6_media->storeAs('public/answers', time().$request->answer_6_media->getClientOriginalName());
                $answer_6_media->url = 'answers/'.time().$request->answer_6_media->getClientOriginalName();
                $answer_6_media->save();
            $answer_6->media_id = $answer_6_media->id;
            if ($request->ans_correct_6) {
                $answer_6->arrange = 1;
            }
            $answer_6->save();
        }
        /* //answer6 */
        if($request->problem_set_id && $request->format_type_id){
            $pbq = new ProblemSetQues();
            $pbq->problem_set_id = $request->problem_set_id;
            $pbq->question_id = $pmQ->id;
            $pbq->format_type_id = $request->format_type_id;
            $pbq->save();
        }
        return back();
    }
    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $media = new Media();
                $valueImage->storeAs('public/question_images', time() . $valueImage->getClientOriginalName());
                $media->url = 'question_images/' . time() . $valueImage->getClientOriginalName();
                $media->save();
                return $media->id;
            }
        }
    }
    public function csv(Request $request){
        $file = $request->file('file');
        $images = $request->file('images');
        // dd($file);
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        "question" => $importData[1],
                        "answer1" => $importData[2],
                        "arrange1" => $importData[3],
                        "answer2" => $importData[4],
                        "arrange2" => $importData[5],
                        "answer3" => $importData[6],
                        "arrange3" => $importData[7],
                        "answer4" => $importData[8],
                        "arrange4" => $importData[9],
                        "answer5" => $importData[10],
                        "arrange5" => $importData[11],
                        "answer6" => $importData[12],
                        "arrange6" => $importData[13],
                        "level" => $importData[14],
                    );
                    // var_dump($insertData['answer1']);
                    /*  */
                    if ($insertData['question']) {
                        $fill_Q = new McqpanQues();
                        $fill_Q->question = $insertData['question'];
                        if(!empty($insertData['level'])){
                            if($insertData['level'] == 'easy'){
                                $fill_Q->difficulty_level_id = 1;
                            }else if($insertData['level'] == 'medium'){
                                $fill_Q->difficulty_level_id = 2;
                            }else if($insertData['level'] == 'hard'){
                                $fill_Q->difficulty_level_id = 3;
                            }
                        }
                        $fill_Q->save();
                        if($request->problem_set_id && $request->format_type_id){
                            $pbq = new ProblemSetQues();
                            $pbq->problem_set_id = $request->problem_set_id;
                            $pbq->question_id = $fill_Q->id;
                            $pbq->format_type_id = $request->format_type_id;
                            $pbq->save();
                        }

                        if ($insertData['answer1'] == '-') {
                        } else {
                            $f_Ans1 = new McqpanAns();
                            $f_Ans1->question_id = $fill_Q->id;
                            // $m1 = new Media();
                            // $m1->url  = $insertData['answer1'];
                            // $m1->save();
                            // $f_Ans1->media_id = $m1->id;
                            if (!empty($insertData['answer1']) && $insertData['answer1'] != '') {
                                $media_id = $this->imagecsv($insertData['answer1'], $images);
                                $f_Ans1->media_id = $media_id;
                            }
                            $f_Ans1->arrange = $insertData['arrange1'];
                            $f_Ans1->save();
                        }
                        if ($insertData['answer2'] == '-') {
                        } else {
                            $f_Ans2 = new McqpanAns();
                            $f_Ans2->question_id = $fill_Q->id;
                            // $m2 = new Media();
                            // $m2->url  = $insertData['answer2'];
                            // $m2->save();
                            // $f_Ans2->media_id = $m2->id;
                            if (!empty($insertData['answer2']) && $insertData['answer2'] != '') {
                                $media_id = $this->imagecsv($insertData['answer2'], $images);
                                $f_Ans2->media_id = $media_id;
                            }
                            $f_Ans2->arrange = $insertData['arrange2'];
                            $f_Ans2->save();
                        }
                        if ($insertData['answer3'] == '-') {
                        } else {
                            $f_Ans3 = new McqpanAns();
                            $f_Ans3->question_id = $fill_Q->id;
                            // $m3 = new Media();
                            // $m3->url  = $insertData['answer3'];
                            // $m3->save();
                            // $f_Ans3->media_id = $m3->id;
                            if (!empty($insertData['answer3']) && $insertData['answer3'] != '') {
                                $media_id = $this->imagecsv($insertData['answer3'], $images);
                                $f_Ans3->media_id = $media_id;
                            }
                            $f_Ans3->arrange = $insertData['arrange3'];
                            $f_Ans3->save();
                        }
                        if ($insertData['answer4'] == '-') {
                        } else {
                            $f_Ans4 = new McqpanAns();
                            $f_Ans4->question_id = $fill_Q->id;
                            // $m4 = new Media();
                            // $m4->url  = $insertData['answer4'];
                            // $m4->save();
                            // $f_Ans4->media_id = $m4->id;
                            if (!empty($insertData['answer4']) && $insertData['answer4'] != '') {
                                $media_id = $this->imagecsv($insertData['answer4'], $images);
                                $f_Ans4->media_id = $media_id;
                            }
                            $f_Ans4->arrange = $insertData['arrange4'];
                            $f_Ans4->save();
                        }
                        if ($insertData['answer5'] == '-') {
                        } else {
                            $f_Ans5 = new McqpanAns();
                            $f_Ans5->question_id = $fill_Q->id;
                            // $m5 = new Media();
                            // $m5->url  = $insertData['answer5'];
                            // $m5->save();
                            // $f_Ans5->media_id = $m5->id;
                            if (!empty($insertData['answer5']) && $insertData['answer5'] != '') {
                                $media_id = $this->imagecsv($insertData['answer5'], $images);
                                $f_Ans5->media_id = $media_id;
                            }
                            $f_Ans5->arrange = $insertData['arrange5'];
                            $f_Ans5->save();
                        }
                        if ($insertData['answer6'] == '-') {
                        } else {
                            $f_Ans6 = new McqpanAns();
                            $f_Ans6->question_id = $fill_Q->id;
                            // $m6 = new Media();
                            // $m6->url  = $insertData['answer6'];
                            // $m6->save();
                            // $f_Ans6->media_id = $m6->id;
                            if (!empty($insertData['answer6']) && $insertData['answer6'] != '') {
                                $media_id = $this->imagecsv($insertData['answer6'], $images);
                                $f_Ans6->media_id = $media_id;
                            }
                            $f_Ans6->arrange = $insertData['arrange6'];
                            $f_Ans6->save();
                        }
                    }
                    /*  */
                }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
        return back();
    }
    public function update($id, Request $request){
        $q = McqpanQues::where('id', $id)->first();
        // dd($q);
        $q->question = $request->question;
        $q->difficulty_level_id = $request->difficulty_level_id;
        // $q->level_id = $request->question_level;
        // $q->score = $request->question_score;
        $q->hint = $request->question_hint;
        // if($request->ques_audio){
        //     $q_media = new Media();
        //     $request->ques_audio->storeAs('public/answers', time() . $request->ques_audio->getClientOriginalName());
        //     $q_media->url = 'answers/' . time() . $request->ques_audio->getClientOriginalName();
        //     $q_media->save();
        //     $q->audio_id = $q_media->id;
        // }
        $q->save();
        $answers = McqpanAns::where('question_id', $q->id)->get();
        foreach($answers as $ans){
            $inputAnswer = 'answer'.$ans->id;
            if($request->$inputAnswer){
                $inputArrange = 'ans_correct'.$ans->id;
                // $ans->answer = $request->$inputAnswer;
                // if($request->$inputArrange){
                //     $ans->arrange = 1;
                // }else{
                //     $ans->arrange = 0;
                // }
                $q_media = new Media();
                $request->$inputAnswer->storeAs('public/answers', time() . $request->$inputAnswer->getClientOriginalName());
                $q_media->url = 'answers/' . time() . $request->$inputAnswer->getClientOriginalName();
                $q_media->save();
                $ans->media_id = $q_media->id;
                $ans->save();
            }
        }
        $answersAll = McqpanAns::where('question_id', $q->id)->get();
        foreach($answersAll as $ansD){
            $inputArrange = 'ans_correct'.$ansD->id;
            if($request->$inputArrange){
                $ansD->arrange = 1;
            }else{
                $ansD->arrange = 0;
            }
            $ansD->save();
        }
        return back();
    }

    public function delete($id){
        $f = McqpanQues::where('id', $id)->first();
        $f->delete();
        $ans = McqpanAns::where('question_id', $f->id)->pluck('id');
        if($ans){
            foreach($ans as $a){
                $f_ans = McqpanAns::where('id', $a)->first();
                $f_ans->delete();
            }
        }
        return back();
    }
    public function active($id){
        $f = McqpanQues::where('id', $id)->first();
        if($f->active == '0'){
            $f->active = '1';
            $f->save();
        }else{
            $f->active = '0';
            $f->save();
        }
        return back();
    }
}
