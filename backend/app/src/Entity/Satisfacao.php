<?php
namespace App\Entity;
abstract class Satisfacao {
    const MUITO_SATISFEITO = 2;
    const SATISFEITO = 1;
    const REGULAR = 0;
    const INSATISFEITO = -1;
    const MUITO_INSATISFEITO = -2;
}
?>