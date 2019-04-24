<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;


$max=User::max('id');
echo $max;
