<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function deploy(Request $request)
    {
        $data = $request->all();
        $payload = json_decode($data['payload'])->ref;

        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');

        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if (hash_equals($githubHash, $localHash) && $payload == 'refs/heads/master') {

            $root_path = base_path();
            echo shell_exec('cd ' . $root_path . ' && sh ./deploy.sh'); // Executa Script de Deploy
            /*$process = new Process(['sh', $root_path . '/deploy.sh']);
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });*/

        }
    }
}
