<?php 

class RegistrationMail {
    private $ci;
    private $content;

    public function __construct($content = []) {
        $this->ci = &get_instance();
        $this->content = $content;
        $this->ci->load->library('email');
    }

    /**
     * Set Sender Email
     *
     * @param string $from
     * @return self
     */
    private function setFrom(string $from): self {
        if(!filter_var($from, FILTER_VALIDATE_EMAIL))
            throw new Exception('Sender Email not valid !!!');
        
        $this->ci->email->from($from);
        return $this;
    }

    /**
     * Set Recipient Email
     *
     * @param string $to
     * @return self
     */
    private function setTo(string $to): self {
        if(!filter_var($to, FILTER_VALIDATE_EMAIL))
            throw new Exception('Recipients Email not valid !!!');

        $this->ci->email->to($to);
        return $this;
    }

    public function sendEmail() {

    }
}