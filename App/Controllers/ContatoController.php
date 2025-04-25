<?php
namespace App\Controllers;

use \Core\Controller;
use \Core\Mailer;
use \App\Models\MensagemContato;
use \App\Helpers\Flash;
use \App\Helpers\TemplateEngine;

class ContatoController extends Controller
{
    public function getContato():void
    {
        $this->view('contato');
    }

    public function enviar(): void
    {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $assunto = $_POST['assunto'] ?? '';
        $mensagem = $_POST['mensagem'] ?? '';

        if (empty($nome) || empty($email) || empty($mensagem)) {
            Flash::set('error', 'Preencha todos os campos obrigatórios');
            return;
        }

        $array = array(
            'nome' => htmlspecialchars($nome),
            'email' => htmlspecialchars($email),
            'mensagem' => nl2br(htmlspecialchars($mensagem))
        );
        $file = ROOT_DIR.DS.'static'.DS.'html'.DS.'email_message.html';

        $body = TemplateEngine::render($file, $array);

        $enviado = Mailer::send($_ENV['MAIL_TO'], $assunto, $body);

        if ($enviado) {
            MensagemContato::salvar([
                "nome"=>$nome,
                "email"=>$email,
                "assunto"=>$assunto,
                "mensagem"=>$mensagem
            ]);
            Flash::set('success', 'Mensagem enviada com sucesso!');
        } else {
            Flash::set('error', 'Erro ao enviar mensagem. Tente novamente mais tarde');
        }
        header('Location: /contato');
        exit();
    }
}
?>