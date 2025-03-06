<?php

namespace App\Console\Commands;

use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correo de bienvenida a un usuario especifico.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $user = User::find($userId);

        if (!$user) {
            $this->error('Usuario no encontrado.');
            return;
        }

        dispatch(new SendWelcomeEmail($user));
        $this->info('Correo de bienvenida encolado para el usuario: ' . $user->email);
    }
}
