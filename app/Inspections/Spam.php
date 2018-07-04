<?php

namespace App\Inspections;

use App\Contact;
use Carbon\Carbon;

class Spam
{

    protected $remaining;

    /**
     * [detect]
     * @param  String $client_ip
     * @return boolean
     */
    public function detect(string $client_ip)
    {

        $contact = Contact::where(['client_ip' => $client_ip])->latest()->first();

        if(!$contact) return false;

        $this->remaining = $contact->created_at->timestamp - (new Carbon())->subSeconds(30)->timestamp;

        return $this->remaining >= 0;
    }


    /**
     * [remaining description]
     * @return integer $this->remaining
     */
    public function remaining()
    {
        return $this->remaining;
    }

}
