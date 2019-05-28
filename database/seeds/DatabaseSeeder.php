 <?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sor;
use App\Models\Particip;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

    public function run()
    {
DB::table('users')->delete();
DB::table('sors')->delete();
DB::table('particips')->delete();
$array = array("normale","montagne","encadrée","1500","accompagnée","sunset","sunset");
$faker = Faker\Factory::create('fr_FR');
$date = date('d-m-Y');
    /** comment
     * créer 20 users
     */
        for ($i = 0; $i < 40; $i++) {
            $user = new User;
            $user->name = $faker->lastName;
            $user->firstname = $faker->firstName;
            $user->email = $faker->unique()->email;
            $user->password = bcrypt('12345678');
            $user->tel= $faker->phoneNumber;
            $user->statut = rand(1,3);
        $user->role = 'membre';
        $user->ajour = true;

            $user->save();
        }
    /** comment
     *
     * créer un user superadmin
     *
     */
            $user = new User;
            $user->name = 'a';
            $user->firstname = 'a';
            $user->email = 'a@a.fr';
            $user->password = bcrypt('aaaaaaaa');
            $user->tel = '0692 000 000';
        $user->role = 'superadmin';
        $user->statut = rand(1,3);
        $user->ajour = true;
        $user->save();
    /** comment
     *
     * créer un user admin
     *
     */
            $user = new User;
            $user->name = 'b';
            $user->firstname = 'b';
            $user->email = 'b@b.fr';
            $user->password = bcrypt('bbbbbbbb');
            $user->tel = '0692 000 000';
        $user->role = 'admin';
        $user->statut = rand(1,3);
        $user->ajour = true;
        $user->save();
    /** comment
     * créer un user membre
     *
     */
            $user = new User;
            $user->name = 'c';
            $user->firstname = 'c';
            $user->email = 'c@c.fr';
            $user->password = bcrypt('cccccccc');
            $user->tel = '0692 000 000';
        $user->role = 'membre';
        $user->statut = rand(1,3);
        $user->ajour = true;
        $user->save();



 for ($i = 0; $i < 10; $i++)
         {
            //
            $date = date('d-m-Y');
            $delai=rand(-20,40);
            $date2= strftime('%Y-%m-%d',strtotime($date .'+'.$delai.' day'));
        Sor::create([

            'dat' => $date2,
            'typ' => $array[rand(0,6)],
            'comment_sor' => $faker->text,
                    ]);
         }



        for ($i = 0; $i < 30; $i++) {
            $particip = new Particip;
            $particip-> comment_particip = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $particip-> sor_id =  rand( Sor::min('id'),Sor::max('id'));
            $particip-> user_id =  rand ( User::min('id'),User::max('id'));
            $particip-> typ = 'typ';
             $delai=rand(-20,40);
            $particip-> inscription = strftime('%Y-%m-%d',strtotime($date .'-'.$delai.' day'));
            $particip->save();
        }


    }
}
