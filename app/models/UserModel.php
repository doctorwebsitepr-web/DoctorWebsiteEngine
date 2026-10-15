<?php

require_once 'Model.php';

class UserModel extends Model
{
    protected static $table = 'usuarios';
    protected static $primary_key = 'id';

}
