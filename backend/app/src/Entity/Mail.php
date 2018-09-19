<?php
namespace App\Entity;
class Mail {
    private $email;
    
	public function __construct (string $email){
        $this->email = $email;
    }
}
?>