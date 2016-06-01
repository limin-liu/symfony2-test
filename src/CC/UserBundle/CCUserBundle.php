<?php

namespace CC\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CCUserBundle extends Bundle
{
    public function getParent(){
    return "FOSUserBundle" ;           
    }
}
