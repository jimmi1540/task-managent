<?php

namespace App\Jobs;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
$ch = curl_init();
$url = 'https://jsonplaceholder.typicode.com/todos';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}
curl_close($ch);
if ($response) {
    $res = json_decode($response, true);
     foreach($res as $data)
     {
        $status = '';
        if($data["completed"] == true){
            $status = 'completed';  
        }
        else{
            $status = 'pending';
        }
    $user = Task::updateOrCreate(
        ['api_id' => $data["id"]],
        ['title' =>  $data["title"],'description' => $data["title"],'api_id'=>$data["id"],'status'=>$status]
    );

     }
} else {
    echo 'No response from the API';
}

    }
}
