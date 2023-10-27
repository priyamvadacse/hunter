<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use Carbon\Exceptions\Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendMail($toEmail, $msg, $subject)
    {
        // ********** API EMAIL START **************
                
        $data = array(
            "sender" => array(
                "email" =>  getenv('MAIL_FROM_ADDRESS'),
                "name" => getenv('MAIL_FROM_NAME')
            ),
            "to" => array(
                array(
                    "email" => $toEmail,
                    // "name" => "ranjan"
                )
            ),
            "name" => "hunttrapikey", // Add the campaign name here
            "subject" => $subject,
            "htmlContent" => '<html><head></head><body'.$msg.'</body></html>'
        );
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $headers = array(
            'Accept: application/json',
            'api-key: ' .getenv('MAIL_PASSWORD'), // Replace YOUR_API_KEY with your actual API key from Sendinblue
            'Content-Type: application/json'
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
        // dd($result);
        }

        public function sendNotification($userId,$title,$message,$type,$data=[])
        {
            $token = User::where('id', $userId)->first(['f_token']);

        //    $token = User::where('id', $userId)->first();
         
            // dd($userId);
        if (empty($token)) {
            return true;
        }

        try {
            $post = array(
                "registration_ids" => [$token->f_token],
                "notification" => array(
                    "title" => $title,
                    "body" => $message
                ),
                "data" => array(
                    "title" => $title,
                    "body" => $message,
                    'extra' => json_encode($data)
                )
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($post),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: KEY=AAAAr-dy8SY:APA91bE_Xe93O3ZtWC7grxU_uXX8FdkeDhB32UuUyOlW7I2d27HIUBOPz5znZE-qP0IhXDwLJ8wNCvY8h8azlu3p7q156AGKlGWekab9U9gAwfIhIYH1mOM80YdTwbaCG_SDcNLKQs21',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            // dd($response);
            curl_close($curl);
        } catch (Exception $e) {
            return true;
        }

        }
}
