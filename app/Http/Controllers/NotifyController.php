<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\PatientResearh;
use PDF;
use Mail;

class NotifyController extends Controller
{
    public function sendNotify(Request $request)
    {
        $alert_type = $request->alert_type;
        $patient_research = PatientResearh::findOrFail($request->patient_research_id);
        $pdf = PDF::loadView('pdf.research', compact('patient_research'));
        $pdf->save(public_path().'/notify-pdf/research_'.$patient_research->id.'.pdf');


        switch($alert_type)
        {
            case '1':
                 return $this->sendEmail($patient_research);
            break;

            case '2':
                return response('sms');
            break;

            case '3':
                return response('sms+email');
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

            return response(['status' => true, 'msg' => 'Сообщение успешно отправлено.', 200]);
        }
        else
        {
            return response(['status' => false, 'msg' => 'Не заполнено поле email', 200]);
        }
    }

    protected function sendSMS($patient_research)
    {
        return 'send sms';
    }
}
