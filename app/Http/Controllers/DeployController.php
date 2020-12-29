<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
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
            $process = new Process(['sh', 'deploy.sh']);
            $process->setWorkingDirectory(base_path());
            $process->run();

            if (!$process->isSuccessful())
                throw new ProcessFailedException($process);

            echo $process->getOutput();
        }
    }
}
