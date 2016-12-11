<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\PatientResearh;
use App\Notifications\StatusResearch;
use PDF;
use Mail;

class NotifyController extends Controller
{
    public function sendNotify(Request $request)
    {
        define('_MPDF_TTFONTDATAPATH',$temp_dir);
        $alert_type = $request->alert_type;
        $patient_research = PatientResearh::findOrFail($request->patient_research_id);
        $pdf = PDF::loadView('pdf.research', compact('patient_research'));
        $pdf->save(public_path().'/notify-pdf/research_'.$patient_research->id.'.pdf');


        switch($alert_type)
        {
            case '1':
                if($this->sendEmail($patient_research))
                    return response(['status' => true, 'msg' => 'Уведомление успешно отправлено по email.', 200]);
                else
                    return response(['status' => false, 'msg' => 'Не заполнено поле email', 200]);
            break;

            case '2':
                if($this->sendSMS($patient_research))
                    return response(['status' => true, 'msg' => 'Уведомление успешно отправлено по SMS на номер '.$patient_research->patient->phone.'.', 200]);
                else
                    return response(['status' => false, 'msg' => 'Не заполнено поле телефон', 200]);
            break;

            case '3':
                if($this->sendEmail($patient_research) && $this->sendSMS($patient_research))
                     return response(['status' => true, 'msg' => 'Уведомление успешно отправлено по Email и SMS.', 200]);
                else
                    return response(['status' => false, 'msg' => 'Ошибка отправки уведомления. Обратитесь к администратору.', 200]);
            break;
        }

        return response('ERROR NOTIFY!');
    }

    protected function sendEmail($patient_research)
    {
        $patient = $patient_research->patient;


        if(isset($patient->email))
        {
            $send_emails = array(trim($patient->email));

            Mail::send(['email.basic'], ['patient_research' => $patient_research], function($message) use($send_emails, $patient_research){
                $message->to($send_emails)->subject('Результаты исследования.');
                $message->from('lab-gp1@mail.ru', 'Лаборатория МБУЗ г. Сочи "Городская поликлиника №1"');
                $message->attach(public_path().'/notify-pdf/research_'.$patient_research->id.'.pdf');
            });

            return true;
            //return response(['status' => true, 'msg' => 'Уведомление успешно отправлено по email.', 200]);
        }
        else
        {
            return false;
            //return response(['status' => false, 'msg' => 'Не заполнено поле email', 200]);
        }
    }

    protected function sendSMS($patient_research)
    {
        $patient = $patient_research->patient;

        if(isset($patient->phone))
        {
            $patient->notify(new StatusResearch($patient_research));

            //return response(['status' => true, 'msg' => 'Уведомление успешно отправлено по SMS на номер '.$patient->phone.'.', 200]);
            return true;
        }
        else
        {
            return false;
            //return response(['status' => false, 'msg' => 'Не заполнено поле телефон', 200]);
        }
    }
}
